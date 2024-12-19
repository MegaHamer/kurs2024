<?php

namespace app\models\products;

use Yii;

/**
 * This is the model class for table "form_factor".
 *
 * @property int $id
 * @property string $name
 *
 * @property ComputerCase[] $computerCases
 * @property ComputerCase[] $computerCases0
 * @property Motherboard[] $motherboards
 * @property PowerSupply[] $powerSupplies
 */
class FormFactor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'form_factor';
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
        return $this->hasMany(ComputerCase::class, ['motherboard_form_factor' => 'id']);
    }

    /**
     * Gets query for [[ComputerCases0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComputerCases0()
    {
        return $this->hasMany(ComputerCase::class, ['power_supply_form_factor' => 'id']);
    }

    /**
     * Gets query for [[Motherboards]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMotherboards()
    {
        return $this->hasMany(Motherboard::class, ['form_factor' => 'id']);
    }

    /**
     * Gets query for [[PowerSupplies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPowerSupplies()
    {
        return $this->hasMany(PowerSupply::class, ['form_factor' => 'id']);
    }
}
