<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Product;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

use Yii;

use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;

use yii\db\Query;
/**
 * CartController implements the CRUD actions for Cart model.
 */
class CartController extends RestController
{
    public $modelClass = 'app\models\User';
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
        $cart = Cart::find()->where(['user' => $user_id])->all();

        $products = array();
        foreach ($cart as $car) {
            $pr = Product::getProduct($car->product);
            $cs = ArrayHelper::toArray($pr);
            // var_dump(\yii\helpers\ArrayHelper::toArray($cs));
            $cs["id"] = $car->product;
            $count = $car->count;
            $products[] = array_merge(
                $cs,
                ["count" => $count]
            );
        }

        return $this->send(
            200,
            [
                'products'=>$products
            ]
        );
    }

    public function actionCreate()
    {
        $user_id = Yii::$app->user->identity->id;
        $data = Yii::$app->request->post();

        if(empty(Product::findOne(@$data["product"]))){
            return $this->send(
                404,
                [
                    "message"=> "Not found" 
                ]
            );
        }

        $cart = new Cart();
        $cart->load($data, '');
        $cart->user = $user_id;

        if (!$cart->validate())
            return $this->sendErrorValidation($cart->errors);

        $cart->save();

        return $this->send(204, null);
    }

    public function actionUpdate($id = null)
    {
        $params = Yii::$app->requestput->getParams();
        $user_id = Yii::$app->user->identity->id;

        if (!is_null($id))
            $params['product'] = $id;

        $find = Cart::find()->where(['user' => $user_id, 'product' => $params['product']])->one();
        if (!is_null($find)) {
            $find->count = $params["count"];
            if (!$find->validate())
                return $this->sendErrorValidation($find->errors);
            $find->update();
        } else {
            return $this->send(
                404,
                [
                    "message"=> "Not found" 
                ]
            );
        }
        return $this->send(204, null);
    }

    public function actionDelete($id = null)
    {
        $user_id = Yii::$app->user->identity->id;
        if ($id) {
            $find = Cart::find()->where(['user' => $user_id, 'product' => $id])->one();
            if (!is_null($find)) {
                $find->delete();
            } else {
                return $this->send(
                    404,
                    [
                        "message"=> "Not found" 
                    ]
                );
            }
        } else {
            Cart::deleteAll(['user' => $user_id]);
        }
        // $data = Yii::$app->request->get();
        // $product = $this->findModel($id);

        // $cart = new Cart();
        // $cart->load($data, '');

        return $this->send(204, null);
    }

    protected function findModel($id)
    {
        if (($model = Cart::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
