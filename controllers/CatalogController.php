<?php

namespace app\controllers;

use app\models\Catalog;
use app\models\Product;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;

/**
 * CatalogController implements the CRUD actions for Catalog model.
 */
class CatalogController extends RestController
{
    public $modelClass = 'app\models\Catalog';
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

        return $behaviors;
    }


    public function actionIndex()
    {
        $catalog = Catalog::find()->all();
        return $this->send(200, $catalog);
    }


    public function actionView($type)
    {
        $search = \Yii::$app->request->get();
        unset(
            $search["id"],
            $search["type"]
        );

        $catalog = Catalog::find()->where(["code" => $type])->all();
        
        if (empty($catalog)) {
            return $this->send(404, [
                'error' => 'такого каталога нет'
            ]);
        }

        $catalog_products = Product::find()->where(["value_table" => $type])->all();

        
        $classname = \yii\helpers\BaseInflector::classify($type);
        $classnamePath = "\app\models\products\\" . $classname . "Search";
        
        // $model = $classnamePath::find();
        $model = new $classnamePath();
        $ans = $model->search($search)->getModels();
       
        if(empty($ans)){
            return $this->send(204, null);
        }

        return $this->send(200, $ans);
    }

    protected function findModel($id)
    {
        if (($model = Catalog::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
