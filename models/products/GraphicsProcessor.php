<?php

namespace app\models\products;

use Yii;

/**
 * This is the model class for table "graphics_processor".
 *
 * @property int $id
 * @property string $name
 * @property int|null $manufacturer
 *
 * @property Manufacturer $manufacturer0
 * @property VideoCard[] $videoCards
 */
class GraphicsProcessor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'graphics_processor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['manufacturer'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['manufacturer'], 'exist', 'skipOnError' => true, 'targetClass' => Manufacturer::class, 'targetAttribute' => ['manufacturer' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'manufacturer' => 'Manufacturer',
        ];
    }

    /**
     * Gets query for [[Manufacturer0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getManufacturer0()
    {
        return $this->hasOne(Manufacturer::class, ['id' => 'manufacturer']);
    }

    /**
     * Gets query for [[VideoCards]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVideoCards()
    {
        return $this->hasMany(VideoCard::class, ['graphics_processor' => 'id']);
    }
}
