<?php

namespace app\models\products;

use Yii;

/**
 * This is the model class for table "memory".
 *
 * @property int $id
 * @property string $name
 *
 * @property Motherboard[] $motherboards
 * @property Processor[] $processors
 * @property Ram[] $rams
 * @property VideoCard[] $videoCards
 */
class Memory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
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
        ];
    }

    /**
     * Gets query for [[Motherboards]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMotherboards()
    {
        return $this->hasMany(Motherboard::class, ['memory_type' => 'id']);
    }

    /**
     * Gets query for [[Processors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProcessors()
    {
        return $this->hasMany(Processor::class, ['memory_type' => 'id']);
    }

    /**
     * Gets query for [[Rams]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRams()
    {
        return $this->hasMany(Ram::class, ['memory_type' => 'id']);
    }

    /**
     * Gets query for [[VideoCards]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVideoCards()
    {
        return $this->hasMany(VideoCard::class, ['memory_type' => 'id']);
    }
}
