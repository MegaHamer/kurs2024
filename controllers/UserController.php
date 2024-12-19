<?php

namespace app\controllers;

use app\models\User;
use Yii;
//файлы
use yii\web\NotFoundHttpException;

//токены
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;

class UserController extends RestController
{
    public $modelClass = 'app\models\User';
    public function actions()
    {
        $actions = parent::actions();

        // disable the "delete" and "create" actions
        unset($actions['create']);

        return [];
    }

    /*
    для тебования токена
    */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::class,
            'authMethods' => [
                HttpBasicAuth::class,
                HttpBearerAuth::class,
            ],
            'except' => ['create', 'login', 'viewbyid',"view"],
        ];

        return $behaviors;
    }
    public function actionCreate()
    {
        $data = Yii::$app->request->post();
        unset($data["token"]);

        $user = new User();
        $user->scenario = User::SCENARIO_REGISTER;
        $user->load($data, '');

        if (!$user->validate())
            return $this->sendErrorValidation($user->errors);

        $user->password = Yii::$app->getSecurity()->generatePasswordHash($user->password);
        $user->save(false);

        return $this->send(201, null);
    }
    public function actionLogin()
    {
        $data = Yii::$app->request->post();

        $user = new User();
        $user->scenario = User::SCENARIO_LOGIN;
        $user->load($data, '');

        if (!$user->validate())
            return $this->sendErrorValidation($user->errors);

        $user = User::find()->where(['email' => $data['email']])->one();
        if (!is_null($user))
            if (Yii::$app->getSecurity()->validatePassword($data['password'], $user->password)) {
                //generate token
                $newToken = Yii::$app->getSecurity()->generateRandomString();
                $user->token = $newToken;
                $user->save(false);

                return $this->send(
                    200,
                    [
                        'token' => $newToken,
                    ],
                );
            }
        return $this->send(
            404,
            [
                'message' => 'Not found',
                'error' => 'Неверный логин или пароль'
            ]
        );

    }
    public function actionView()
    {
        return $this->send(200, User::find()->all());
    }
    public function actionProfile(){
        return $this->send(200, $this->findModel(Yii::$app->user->identity->id));
    }
    public function actionViewbyid($id)
    {
        return $this->send(200, $this->findModel($id));
    }
    public function actionChange()
    {
        $params = Yii::$app->requestput->getParams();
        $file = Yii::$app->requestput->getFiles();
        $identity = Yii::$app->user->identity;
        $user = User::findOne($identity->id);

        $validateModel = new User();

        $validateModel->load($params, '');
        if (!empty($file))
            $validateModel->load($file, '');

        if (!$validateModel->validate())
            return $this->sendErrorValidation($validateModel->errors);

        if (!is_null(@$params["password"])) {
            $params['password'] = Yii::$app->getSecurity()->generatePasswordHash($params['password']);
        }

        $user->load($params, '');
        if (!empty($file)) {
            $user->load($file, '');
            $savePath = 'uploads/' . $user->profileImage->name;
            if ($user->profileImage->saveAs($savePath)) {
                $user->profileImage = $savePath;
            }
        }

        $user->update(false);

        return $this->send(204, null);
    }

    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
