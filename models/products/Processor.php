<?php

namespace app\models\products;

use app\models\Product;
use Yii;

/**
 * This is the model class for table "processor".
 *
 * @property int $id
 * @property int|null $manufacturer производитель (AMD, Intel)
 * @property int|null $socket сокет (LGA 1700, AM5 и тд.)
 * @property int $count_productive_cores количество производительных ядер (2, 4, 6 и тд.)
 * @property int|null $memory_type Тип памяти (DDR4, DDR3 и тд.)
 * @property string $model Полное название модели (Intel Core i5-12400F, AMD Ryzen 9 3900XT и тд.)
 * @property float $base_frequency Базовая частота процессора (ГГц)
 * @property int $thermal_design_power Тепловыделение (Вт)
 * @property int $price Цена
 *
 * @property Manufacturer $manufacturer0
 * @property Memory $memoryType
 * @property ProcessorSocket $socket0
 */
class Processor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'processor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['manufacturer', 'socket', 'count_productive_cores', 'memory_type', 'thermal_design_power', 'price'], 'integer'],
            [['manufacturer', 'socket', 'count_productive_cores', 'memory_type','model', 'base_frequency', 'thermal_design_power', 'price'], 'required'],
            [['base_frequency'], 'number'],
            [['model'], 'string', 'max' => 255],
            [['manufacturer'], 'exist', 'skipOnError' => true, 'targetClass' => Manufacturer::class, 'targetAttribute' => ['manufacturer' => 'id']],
            [['memory_type'], 'exist', 'skipOnError' => true, 'targetClass' => Memory::class, 'targetAttribute' => ['memory_type' => 'id']],
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
            'count_productive_cores' => 'Count Productive Cores',
            'memory_type' => 'Memory Type',
            'model' => 'Model',
            'base_frequency' => 'Base Frequency',
            'thermal_design_power' => 'Thermal Design Power',
            'price' => 'Price',
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
    // public static function getProcessor($id)
    // {
    //     $data = self::find()->where(['id' => $id])->one();
    //     $query = (new \yii\db\Query())
    //         ->select([
    //             "manufacturer" => "m.name",
    //             "memory_type" => "mt.name",
    //             "socket" => "s.name"
    //         ])
    //         ->from([
    //             "ps" => "processor",
    //         ])->innerJoin(
    //             ["m" => 'manufacturer'],
    //             "m.id = ps.manufacturer"
    //         )->innerJoin(
    //             ["s" => "processor_socket",],
    //             "s.id = ps.socket "
    //         )->innerJoin(
    //             ["mt" => "memory",],
    //             "mt.id = ps.memory_type"
    //         )
    //         ->where([
    //             "ps.id" => $id,
    //         ])
    //         ->one();
    //     $data->manufacturer = $query["manufacturer"];
    //     $data->memory_type = $query["memory_type"];
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
        $fields['id'] = function ($model) {
            return Product::find()->where([
                "value_table" => self::tableName(),
                'value_id' => $model->id
            ])->one()->id;
        };

        return $fields;
    }
}
