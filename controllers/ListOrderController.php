<?php

namespace app\controllers;

use app\models\ListOrder;
use app\models\Cart;
use app\models\OrderInfo;
use app\models\Product;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;

use Yii;
/**
 * ListOrderController implements the CRUD actions for ListOrder model.
 */
class ListOrderController extends RestController
{
    public $modelClass = 'app\models\ListOrder';
    public function actions()
    {
        return [];
    }
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::class,
            'authMethods' => [
                HttpBasicAuth::class,
                HttpBearerAuth::class,
            ],
        ];

        return $behaviors;
    }

    public function actionView()
    {
        $user_id = Yii::$app->user->identity->id;
        $list = ListOrder::find()->where(['user' => $user_id])->all();

        $orders = array();
        foreach ($list as $item) {
            $order_id = $item->id;
            $order_info = OrderInfo::find()->where(["code" => $order_id])->all();

            foreach ($order_info as $order) {
                $product_id = $order->product;
                $count = $order->count;

                $product = Product::getProduct($product_id);
                $array = ArrayHelper::toArray($product);
                $array["id"] = $product_id;

                $orders[$order_id][] = array_merge(
                    $array,
                    ["count" => $count]
                );
            }
            // var_dump(\yii\helpers\ArrayHelper::toArray($cs));
        }

        return $this->send(
            200,
            [
                'orders' => $orders

            ]
        );
    }

    public function actionCreate()
    {
        $user_id = Yii::$app->user->identity->id;

        $products_in_cart = Cart::find()->where(['user' => $user_id])->all();
        if (empty($products_in_cart)) {
            return $this->send(
                404,
                [
                    "error" => "Нет товаров в корзине"
                ]
            );
        }

        $list = new ListOrder();
        $list->user = $user_id;
        $list->save();

        $new_list_id = $list->id;

        foreach ($products_in_cart as $product_and_count) {
            $order_info = new OrderInfo();

            $order_info->code = $new_list_id;
            $order_info->product = $product_and_count->product;
            $order_info->count = $product_and_count->count;

            $answ = $order_info->save();
        }
        Cart::deleteAll(['user' => $user_id]);

        return $this->send(204, null);
    }

    protected function findModel($id)
    {
        if (($model = ListOrder::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
