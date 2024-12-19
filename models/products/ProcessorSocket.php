<?php

namespace app\models\products;

use Yii;

/**
 * This is the model class for table "processor_socket".
 *
 * @property int $id
 * @property string $name
 *
 * @property Motherboard[] $motherboards
 * @property Processor[] $processors
 */
class ProcessorSocket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'processor_socket';
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
        return $this->hasMany(Motherboard::class, ['socket' => 'id']);
    }

    /**
     * Gets query for [[Processors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProcessors()
    {
        return $this->hasMany(Processor::class, ['socket' => 'id']);
    }
}
