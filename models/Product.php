<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $value_table
 * @property int $value_id
 *
 * @property Application[] $applications
 * @property Cart[] $carts
 * @property User[] $users
 * @property User[] $users0
 * @property WhishList[] $whishLists
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value_table', 'value_id'], 'required'],
            [['value_id'], 'integer'],
            [['value_table'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value_table' => 'Value Table',
            'value_id' => 'Value ID',
        ];
    }

    /**
     * Gets query for [[Applications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplications()
    {
        return $this->hasMany(Application::class, ['product' => 'id']);
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::class, ['product' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['id' => 'user'])->viaTable('cart', ['product' => 'id']);
    }

    /**
     * Gets query for [[Users0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers0()
    {
        return $this->hasMany(User::class, ['id' => 'user'])->viaTable('whish_list', ['product' => 'id']);
    }

    /**
     * Gets query for [[WhishLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWhishLists()
    {
        return $this->hasMany(WhishList::class, ['product' => 'id']);
    }

    public static function getProduct($id)
    {
        $product = Product::find()->where(['id' => $id])->one();
        if (is_null($product)){
            return null;
        }
        $product_valtable = $product->value_table;
        
        $classname = \yii\helpers\BaseInflector::classify($product_valtable);
        $classnamePath = "\app\models\products\\" . $classname;
        
        $product_valid = $product->value_id;
        // $cs = $classnamePath::{"get" . $classname}($product_valid) ;
        $cs = $classnamePath::findOne($product_valid);

        return $cs;
    }
    public static function getProducts()
    {
        // $product = Product::find()->where(['id' => $id])->one();
        // $product_valtable = $product->value_table;
        
        // $classname = \yii\helpers\BaseInflector::classify($product_valtable);
        // $classnamePath = "\app\models\products\\" . $classname;
        
        // $product_valid = $product->value_id;
        // $cs = $classnamePath::{"get" . $classname}($product_valid) ;

        // return $cs;
    }
}
