<?php

namespace app\models\products;

use Yii;

/**
 * This is the model class for table "case_size".
 *
 * @property int $id
 * @property string $name
 *
 * @property ComputerCase[] $computerCases
 */
class CaseSize extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'case_size';
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
        return $this->hasMany(ComputerCase::class, ['case_size' => 'id']);
    }
}
