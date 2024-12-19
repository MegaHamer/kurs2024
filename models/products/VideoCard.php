<?php

namespace app\models\products;

use app\models\Product;
use Yii;

/**
 * This is the model class for table "video_card".
 *
 * @property int $id
 * @property int|null $manufacturer производитель
 * @property int|null $graphics_processor Графический процессор
 * @property int $memory_capacity Объем видеопамяти (ГБ)
 * @property int $count_fans количество установленных вентиляторов
 * @property int|null $memory_type Тип памяти
 * @property int $video_outputs Количество видеовыходов
 * @property string $name полное наименование
 * @property int $price цена
 *
 * @property GraphicsProcessor $graphicsProcessor
 * @property Manufacturer $manufacturer0
 * @property Memory $memoryType
 */
class VideoCard extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'video_card';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['manufacturer', 'graphics_processor', 'memory_capacity', 'count_fans', 'memory_type', 'video_outputs', 'price'], 'integer'],
            [['manufacturer', 'graphics_processor', 'memory_capacity', 'count_fans', 'memory_type', 'video_outputs', 'name', 'price'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['graphics_processor'], 'exist', 'skipOnError' => true, 'targetClass' => GraphicsProcessor::class, 'targetAttribute' => ['graphics_processor' => 'id']],
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
            'graphics_processor' => 'Graphics Processor',
            'memory_capacity' => 'Memory Capacity',
            'count_fans' => 'Count Fans',
            'memory_type' => 'Memory Type',
            'video_outputs' => 'Video Outputs',
            'name' => 'Name',
            'price' => 'Price',
        ];
    }

    /**
     * Gets query for [[GraphicsProcessor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGraphicsProcessor()
    {
        return $this->hasOne(GraphicsProcessor::class, ['id' => 'graphics_processor']);
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

    // public static function getVideoCard($id)
    // {
    //     $data = self::find()->where(['id' => $id])->one();
    //     $query = (new \yii\db\Query())
    //         ->select([
    //             "manufacturer" => "m.name",
    //             "memory_type" => "mt.name",
    //             "graphics_processor" => "gp.name"
    //         ])
    //         ->from([
    //             "ps" => "video_card",
    //         ])->innerJoin(
    //             ["m" => 'manufacturer'],
    //             "m.id = ps.manufacturer"
    //         )->innerJoin(
    //             ["mt" => "memory",],
    //             "mt.id = ps.memory_type"
    //         )->innerJoin(
    //             ["gp" => "graphics_processor",],
    //             "gp.id = ps.graphics_processor "
    //         )
    //         ->where([
    //             "ps.id" => $id,
    //         ])
    //         ->one();
    //     $data->manufacturer = $query["manufacturer"];
    //     $data->memory_type = $query["memory_type"];
    //     $data->graphics_processor = $query["graphics_processor"];

    //     return $data;
    // }
    public function fields()
    {
        $fields = parent::fields();

        $fields["manufacturer"] = function ($model) {
            return $model->manufacturer0->name;
        };
        $fields["graphics_processor"] = function ($model) {
            return $model->graphicsProcessor->name;
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
