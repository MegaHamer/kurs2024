<?php

namespace app\models\products;

use Yii;

/**
 * This is the model class for table "80plus_certificate".
 *
 * @property int $id
 * @property string $name
 *
 * @property PowerSupply[] $powerSupplies
 */
class PlusCertificate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '80plus_certificate';
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
     * Gets query for [[PowerSupplies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPowerSupplies()
    {
        return $this->hasMany(PowerSupply::class, ['80plus' => 'id']);
    }
}
