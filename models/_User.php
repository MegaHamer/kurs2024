<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username почта
 * @property string $password
 * @property string $token
 *
 * @property ListOrder[] $listOrders
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    const SCENARIO_LOGIN = 'login';
    const SCENARIO_REGISTER = 'register';
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_LOGIN] = ['username', 'password'];
        $scenarios[self::SCENARIO_REGISTER] = ['username', 'profileImage', 'password'];
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['username', 'password'],
                'required',
                'on' => [self::SCENARIO_REGISTER, self::SCENARIO_LOGIN]
            ],
            [['username', 'password', 'token'], 'string', 'max' => 255],
            [
                ['username'],
                'unique',
                'except' => self::SCENARIO_LOGIN
            ],
            ['username', 'email'],
            ['password', 'match', 'pattern' => '/[а-яёa-z\d\+\-\&\$\!\^\*\?]{6,20}/ui']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'token' => 'Token',
        ];
    }

    /**
     * Gets query for [[ListOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getListOrders()
    {
        return $this->hasMany(ListOrder::class, ['user' => 'id']);
    }

    /*
    пишу тут \/
    */
    /**
     * Summary of fields
     * если вызвать $model->toArray()
     * @return string[]
     */
    public function fields()
    {
        return [
            'id',
            'username' => 'username',
        ];
    }

    /*
    IdentityInterface ) 
    */

    public static function findIdentity($id)
    {
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['token' => $token]);
    }
    public function getId()
    {
        return $this->id;
    }
    public function getAuthKey()
    {
    }
    public function validateAuthKey($authKey)
    {
    }

    /*
    
    */

    public function init()
    {
        parent::init();
        \Yii::$app->user->enableSession = false;
    }



}
