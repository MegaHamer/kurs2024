<?php

namespace app\models\products;

use app\models\Product;
use Yii;

/**
 * This is the model class for table "motherboard".
 *
 * @property int $id
 * @property int|null $manufacturer производитель (ASUS, GIGABYTE etc)
 * @property int|null $socket сокет
 * @property int|null $memory_type тип поддерживаемой памяти
 * @property int|null $form_factor форм-фактор
 * @property int $memory_slots Количество слотов памяти
 * @property int $m2_slots Количество разъемов M.2
 * @property string $name полное наименование
 * @property int $price цена
 *
 * @property FormFactor $formFactor
 * @property Manufacturer $manufacturer0
 * @property Memory $memoryType
 * @property ProcessorSocket $socket0
 */
class Motherboard extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'motherboard';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['manufacturer', 'socket', 'memory_type', 'form_factor', 'memory_slots', 'm2_slots', 'price'], 'integer'],
            [['manufacturer', 'socket', 'memory_type', 'form_factor', 'memory_slots', 'm2_slots', 'name', 'price'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['manufacturer'], 'exist', 'skipOnError' => true, 'targetClass' => Manufacturer::class, 'targetAttribute' => ['manufacturer' => 'id']],
            [['memory_type'], 'exist', 'skipOnError' => true, 'targetClass' => Memory::class, 'targetAttribute' => ['memory_type' => 'id']],
            [['form_factor'], 'exist', 'skipOnError' => true, 'targetClass' => FormFactor::class, 'targetAttribute' => ['form_factor' => 'id']],
            [['socket'], 'exist', 'skipOnError' => true, 'targetClass' => ProcessorSocket::class, 'targetAttribute' => ['socket' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'manufacturer' => 'Manufacturer',
            'socket' => 'Socket',
            'memory_type' => 'Memory Type',
            'form_factor' => 'Form Factor',
            'memory_slots' => 'Memory Slots',
            'm2_slots' => 'M2 Slots',
            'name' => 'Name',
            'price' => 'Price',
        ];
    }

    /**
     * Gets query for [[FormFactor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFormFactor()
    {
        return $this->hasOne(FormFactor::class, ['id' => 'form_factor']);
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
     * Gets query for [[MemoryType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMemoryType()
    {
        return $this->hasOne(Memory::class, ['id' => 'memory_type']);
    }

    /**
     * Gets query for [[Socket0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSocket0()
    {
        return $this->hasOne(ProcessorSocket::class, ['id' => 'socket']);
    }

    // public static function getMotherBoard($id)
    // {
    //     $data = self::find()->where(['id' => $id])->one();
    //     $query = (new \yii\db\Query())
    //         ->select([
    //             "manufacturer" => "m.name",
    //             "memory_type" => "mt.name",
    //             "form_factor" => "f.name",
    //             "socket" => "s.name"
    //         ])
    //         ->from([
    //             "mb" => "motherboard",
    //         ])->innerJoin(
    //             ["m" => 'manufacturer'],
    //             "m.id = mb.manufacturer"
    //         )->innerJoin(
    //             ["s" => "processor_socket",],
    //             "s.id = mb.socket"
    //         )->innerJoin(
    //             ["mt" => 'memory'],
    //             "mt.id = mb.memory_type"
    //         )->innerJoin(
    //             ["f" => "form_factor",],
    //             "f.id = mb.form_factor"
    //         )
    //         ->where([
    //             "mb.id" => $id,
    //         ])
    //         ->one();
    //     $data->manufacturer = $query["manufacturer"];
    //     $data->memory_type = $query["memory_type"];
    //     $data->form_factor = $query["form_factor"];
    //     $data->socket = $query["socket"];

    //     return $data;
    // }

    public function fields()
    {
        $fields = parent::fields();

        $fields["manufacturer"] = function ($model) {
            return $model->manufacturer0->name;
        };
        $fields["socket"] = function ($model) {
            return $model->socket0->name;
        };
        $fields["memory_type"] = function ($model) {
            return $model->memoryType->name;
        };
        $fields["form_factor"] = function ($model) {
            return $model->formFactor->name;
        };

        $fields['id'] = function ($model) {
            return Product::find()->where([
                "value_table" => self::tableName(),
                'value_id' => $model->id
            ])->one()->id;
        };

        return $fields;
    }
}
