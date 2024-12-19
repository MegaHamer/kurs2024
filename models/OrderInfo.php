<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_info".
 *
 * @property int $code id заказа из list_order
 * @property int $product товар
 * @property int $count количество
 *
 * @property ListOrder $code0
 * @property Product $product0
 */
class OrderInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'product', 'count'], 'required'],
            [['code', 'product', 'count'], 'integer'],
            [['code'], 'exist', 'skipOnError' => true, 'targetClass' => ListOrder::class, 'targetAttribute' => ['code' => 'id']],
            [['product'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'product' => 'Product',
            'count' => 'Count',
        ];
    }

    /**
     * Gets query for [[Code0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCode0()
    {
        return $this->hasOne(ListOrder::class, ['id' => 'code']);
    }

    /**
     * Gets query for [[Product0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct0()
    {
        return $this->hasOne(Product::class, ['id' => 'product']);
    }
}
