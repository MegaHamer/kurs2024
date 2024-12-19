<?php

namespace app\controllers;

use app\models\Product;
use app\models\Catalog;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;


use yii\filters\AccessControl;

use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;

use Yii;
/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends RestController
{
    public $modelClass = 'app\models\Product';
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
            'except' => ['view', 'index'],
        ];
        $behaviors['access'] = [
            'class' => AccessControl::class,
            'only' => ['create', 'delete', 'update'],
            'rules' => [
                [
                    'actions' => ['create', 'delete', 'update'],
                    'allow' => true,
                    'matchCallback' => function ($rule, $action) {
                        return Yii::$app->user->identity->isAdmin();
                    },
                    // 'denyCallback' => function ($rule, $action) {
                    //     // throw new \Exception('У вас нет доступа');
                    //     return $this->send(403,"не админ");
                    // }
                ],
            ],
        ];

        return $behaviors;
    }


    public function actionCreate($type)
    {
        if (!Catalog::find()->where(["code" => $type])->one())
            return $this->send(404, [
                "message" => "Not found",
                "error" => "Product type is not found"
            ]);

        $classname = \yii\helpers\BaseInflector::classify($type);
        $classnamePath = "\app\models\products\\" . $classname;

        $data = Yii::$app->request->post();

        $model = new $classnamePath();
        $model->load($data, '');

        if (!$model->validate())
            return $this->sendErrorValidation($model->errors);

        $model->save();

        return $this->send(204, "");
    }
    public function actionDelete($id)
    {
        $product = Product::find()->where(['id' => $id])->one();
        if (!$product)
            return $this->send(404, [
                "message" => "Product is not found"
            ]);

        $product_valtable = $product->value_table;

        $classname = \yii\helpers\BaseInflector::classify($product_valtable);
        $classnamePath = "\app\models\products\\" . $classname;

        $product_valid = $product->value_id;

        $model = $classnamePath::findOne($product_valid);
        $model->delete();

        return $this->send(204, "");
    }
    public function actionUpdate($id)
    {
        $product = Product::find()->where(['id' => $id])->one();
        if (!$product)
            return $this->send(404, [
                "message" => "Product is not found"
            ]);

        $params = Yii::$app->requestput->getParams();
        unset($params["id"]);

        $product_valtable = $product->value_table;

        $classname = \yii\helpers\BaseInflector::classify($product_valtable);
        $classnamePath = "\app\models\products\\" . $classname;

        $product_valid = $product->value_id;

        $model = $classnamePath::findOne($product_valid);
        $model->load($params, '');

        if (!$model->validate())
            return $this->sendErrorValidation($model->errors);

        $model->save();

        return $this->send(204, "");
    }

    public function actionView($id)
    {
        $product = Product::getProduct($id);
        if (is_null($product)) {
            return $this->send(404, [
                'message' => 'Not found'
            ]);
        }
        $array = ArrayHelper::toArray($product);
        $array["id"] = $id;

        return $this->send(200, $array);
    }

    protected function findModel($id)
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
