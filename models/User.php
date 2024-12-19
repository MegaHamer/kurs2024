<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username логин
 * @property string $name
 * @property string $phone
 * @property string $email почта
 * @property string $password
 * @property string|null $profileImage
 * @property string|null $token
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
        $scenarios[self::SCENARIO_LOGIN] = ['email', 'password'];
        $scenarios[self::SCENARIO_REGISTER] = ['email', 'profileImage', 'password', 'username','name','phone'];
        return $scenarios;
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['email', 'password'],
                'required',
                'on' => [self::SCENARIO_LOGIN]
            ],
            [
                ['username','email', 'password','name','phone'],
                'required',
                'on' => [self::SCENARIO_REGISTER]
            ],
            [['username', 'email', 'password', 'token','name','phone'], 'string', 'max' => 255],
            [
                ['email','username','phone'],
                'unique',
                'except' => self::SCENARIO_LOGIN
            ],
            ['email', 'email'],
            // ["profileImage", "required"],
            ['password', 'match', 'pattern' => '/^[а-яёa-z\d\w\+\-\&\$\!\^\*\?]{6,20}$/ui','message'=>'пароль длинной от 6 до 20 символов'],
            ['username', 'match', 'pattern' => '/^[а-яёa-z\d\+\-\&\$\!\^\*\?\s]{6,20}$/ui','message'=>'Логин длинной от 6 до 20 символов'],
            ['name', 'match', 'pattern' => '/^([а-яё\s]{1,30})|([a-z\s]{1,30})$/ui','message'=>'Имя состоит из кирилических или латинских букв длинной до 30 символов'],
            ['phone', 'match', 'pattern' => '/^\+?\d{11}$/ui','message'=>'телефон состоит из 11 цифр'],
            [
                'profileImage',
                'myImageValidate',
                'params' => [
                    'extensions' => 'png, jpg',
                ],
                'when' => function () {
                    return Yii::$app->request->method == "PUT";
                }
                // 'minWidth' => 100,
                // 'maxWidth' => 1000,
                // 'minHeight' => 100,
                // 'maxHeight' => 1000,
            ],
            [
                'profileImage',
                'file',
                'extensions' => 'png, jpg',
                'when' => function () {
                    return Yii::$app->request->method == "POST";
                }
                // 'minWidth' => 100,
                // 'maxWidth' => 1000,
                // 'minHeight' => 100,
                // 'maxHeight' => 1000,
            ]
        ];
    }

    public function myImageValidate($attribute, $params)
    {
        $file = $this->{$attribute};
        if (is_string($file)) {
            $this->addError($attribute, 'this is not a file');
            return;
        }

        $filepath = @$file['tmp_name'];
        if (is_null($filepath)) {
            return;
        }

        $fileSize = filesize($filepath);

        if ($fileSize === 0) {
            $this->addError($attribute, 'The file is empty.');
        }
        $maxSize = @$params['maxSize'];
        if (!is_null($maxSize)) {
            if ($maxSize < 0) {
                $this->addError($attribute, 'Max size must be above 0');
            }
            if ($fileSize > $maxSize) {
                $this->addError($attribute, 'The file is too large. Max size is ' . $maxSize);
            }
        }
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        if (!is_null(@$params['extensions'])) {
            $extensions = explode(",", str_replace(' ', '', $params['extensions']));
            if (!in_array($extension, $extensions)) {
                $this->addError($attribute, 'invalid file extension. Allowed extensions: ' . implode(", ", $extensions));
            }
        }

    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'password' => 'Password',
            'profileImage' => 'Profile Image',
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
        // $id = @Yii::$app->user->identity->id;
        // if (is_null($id) ){
        //     return [
        //         'id',
        //         'username' => 'username',
        //         'profileImage'
        //     ];
        // }
        // else{
            return [
                'id',
                'username' => 'username',
                'name',
                'phone',
                'email',
                'profileImage'
            ];
        // }
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

    public function isAdmin(){

        return boolval($this->admin == 1);
    }

    public function init()
    {
        parent::init();
        \Yii::$app->user->enableSession = false;
    }

}
