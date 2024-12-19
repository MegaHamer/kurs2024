<?php

namespace app\models\products;

use Yii;

/**
 * This is the model class for table "manufacturer".
 *
 * @property int $id
 * @property string $name
 *
 * @property ComputerCase[] $computerCases
 * @property GraphicsProcessor[] $graphicsProcessors
 * @property Motherboard[] $motherboards
 * @property PowerSupply[] $powerSupplies
 * @property Processor[] $processors
 * @property Ram[] $rams
 * @property VideoCard[] $videoCards
 */
class Manufacturer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'manufacturer';
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
     * Gets query for [[ComputerCases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComputerCases()
    {
        return $this->hasMany(ComputerCase::class, ['manufacturer' => 'id']);
    }

    /**
     * Gets query for [[GraphicsProcessors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGraphicsProcessors()
    {
        return $this->hasMany(GraphicsProcessor::class, ['manufacturer' => 'id']);
    }

    /**
     * Gets query for [[Motherboards]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMotherboards()
    {
        return $this->hasMany(Motherboard::class, ['manufacturer' => 'id']);
    }

    /**
     * Gets query for [[PowerSupplies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPowerSupplies()
    {
        return $this->hasMany(PowerSupply::class, ['manufacturer' => 'id']);
    }

    /**
     * Gets query for [[Processors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProcessors()
    {
        return $this->hasMany(Processor::class, ['manufacturer' => 'id']);
    }

    /**
     * Gets query for [[Rams]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRams()
    {
        return $this->hasMany(Ram::class, ['manufacturer' => 'id']);
    }

    /**
     * Gets query for [[VideoCards]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVideoCards()
    {
        return $this->hasMany(VideoCard::class, ['manufacturer' => 'id']);
    }
}
