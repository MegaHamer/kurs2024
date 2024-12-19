<?php

namespace app\models\products;

use app\models\Product;
use Yii;

/**
 * This is the model class for table "ram".
 *
 * @property int $id
 * @property int|null $manufacturer производитель
 * @property int|null $memory_type тип памяти
 * @property int $memory_capacity Общий объем памяти (ГБ)
 * @property int $frequency Тактовая частота (МГц)
 * @property int $number_modules Количество модулей в комплекте (шт)
 * @property string $name полное наименование
 * @property int $price цена комплекта
 *
 * @property Manufacturer $manufacturer0
 * @property Memory $memoryType
 */
class Ram extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ram';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['manufacturer', 'memory_type', 'memory_capacity', 'frequency', 'number_modules', 'price'], 'integer'],
            [['manufacturer', 'memory_type', 'memory_capacity', 'frequency', 'number_modules', 'name', 'price'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['manufacturer'], 'exist', 'skipOnError' => true, 'targetClass' => Manufacturer::class, 'targetAttribute' => ['manufacturer' => 'id']],
            [['memory_type'], 'exist', 'skipOnError' => true, 'targetClass' => Memory::class, 'targetAttribute' => ['memory_type' => 'id']],
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
            'memory_type' => 'Memory Type',
            'memory_capacity' => 'Memory Capacity',
            'frequency' => 'Frequency',
            'number_modules' => 'Number Modules',
            'name' => 'Name',
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

    // public static function getRam($id)
    // {
    //     $data = self::find()->where(['id' => $id])->one();
    //     $query = (new \yii\db\Query())
    //         ->select([
    //             "manufacturer" => "m.name",
    //             "memory_type" => "mt.name",
    //         ])
    //         ->from([
    //             "r" => "ram",
    //         ])->innerJoin(
    //             ["m" => 'manufacturer'],
    //             "m.id = r.manufacturer"
    //         )->innerJoin(
    //             ["mt" => "memory",],
    //             "mt.id = r.memory_type"
    //         )
    //         ->where([
    //             "r.id" => $id,
    //         ])
    //         ->one();
    //     $data->manufacturer = $query["manufacturer"];
    //     $data->memory_type = $query["memory_type"];

    //     return $data;
    // }
    public function fields()
    {
        $fields = parent::fields();

        $fields["manufacturer"] = function ($model) {
            return $model->manufacturer0->name;
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
