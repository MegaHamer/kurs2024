<?php

namespace app\controllers;

use app\models\WhishList;
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
 * WhishListController implements the CRUD actions for WhishList model.
 */
class WhishListController extends RestController
{
    public $modelClass = 'app\models\WhishList';
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
        $list = WhishList::find()->where(['user' => $user_id])->all();

        $products = array();
        foreach ($list as $item) {
            $pr = Product::getProduct($item->product);
            $cs = ArrayHelper::toArray($pr);
            // var_dump(\yii\helpers\ArrayHelper::toArray($cs));
            $cs["id"] = $item->product;
            $products[] = $cs;
        }

        return $this->send(
            200,
            [
                'products' => $products

            ]
        );
    }

    public function actionCreate()
    {
        $user_id = Yii::$app->user->identity->id;
        $data = Yii::$app->request->post();

        $list = new WhishList();
        $list->load($data, ''); //product
        $list->user = $user_id;

        if (!$list->validate())
            return $this->sendErrorValidation($list->errors);

        $list->save();

        return $this->send(204, null);
    }

    public function actionDelete($id = null)
    {
        $user_id = Yii::$app->user->identity->id;
        if ($id) {
            $find = WhishList::find()->where(['user' => $user_id, 'product' => $id])->one();
            if (!is_null($find)) {
                $find->delete();
            } else {
                return $this->send(
                    404,
                    [
                        "error" => "Товар не найден"
                    ]
                );
            }
        } else {
            WhishList::deleteAll(['user' => $user_id]);
        }

        return $this->send(204, null);
    }

    /**
     * Finds the WhishList model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return WhishList the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WhishList::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
