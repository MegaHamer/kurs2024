<?php

namespace app\models\products;

use app\models\Product;
use Yii;

use yii\db\Query;
/**
 * This is the model class for table "computer_case".
 *
 * @property int $id
 * @property int|null $manufacturer Производитель
 * @property int|null $motherboard_form_factor Форм-фактор совместимых плат
 * @property int|null $power_supply_form_factor Форм-фактор совместимых блоков питания
 * @property int|null $case_size Типоразмер корпуса
 * @property string $name полное наименование
 * @property int $price цена
 *
 * @property CaseSize $caseSize
 * @property Manufacturer $manufacturer0
 * @property FormFactor $motherboardFormFactor
 * @property FormFactor $powerSupplyFormFactor
 */
class ComputerCase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'computer_case';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['manufacturer', 'motherboard_form_factor', 'power_supply_form_factor', 'case_size', 'price'], 'integer'],
            [['manufacturer', 'motherboard_form_factor', 'power_supply_form_factor', 'case_size', 'name', 'price'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['case_size'], 'exist', 'skipOnError' => true, 'targetClass' => CaseSize::class, 'targetAttribute' => ['case_size' => 'id']],
            [['manufacturer'], 'exist', 'skipOnError' => true, 'targetClass' => Manufacturer::class, 'targetAttribute' => ['manufacturer' => 'id']],
            [['motherboard_form_factor'], 'exist', 'skipOnError' => true, 'targetClass' => FormFactor::class, 'targetAttribute' => ['motherboard_form_factor' => 'id']],
            [['power_supply_form_factor'], 'exist', 'skipOnError' => true, 'targetClass' => FormFactor::class, 'targetAttribute' => ['power_supply_form_factor' => 'id']],
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
            'motherboard_form_factor' => 'Motherboard Form Factor',
            'power_supply_form_factor' => 'Power Supply Form Factor',
            'case_size' => 'Case Size',
            'name' => 'Name',
            'price' => 'Price',
        ];
    }

    /**
     * Gets query for [[CaseSize]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCaseSize()
    {
        return $this->hasOne(CaseSize::class, ['id' => 'case_size']);
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
     * Gets query for [[MotherboardFormFactor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMotherboardFormFactor()
    {
        return $this->hasOne(FormFactor::class, ['id' => 'motherboard_form_factor']);
    }

    /**
     * Gets query for [[PowerSupplyFormFactor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPowerSupplyFormFactor()
    {
        return $this->hasOne(FormFactor::class, ['id' => 'power_supply_form_factor']);
    }

    // public static function getComputerCase($id)
    // {
    //     $data = self::find()->where(['id' => $id])->one();
    //     $query = (new Query())
    //         ->select([
    //             "manufacturer" => "m.name",
    //             "case_size" => "cs.name",
    //             "motherboard_form_factor" => "mb.name",
    //             "power_supply_form_factor" => "ps.name"
    //         ])
    //         ->from([
    //             "c" => "computer_case",
    //         ])
    //         ->innerJoin(
    //             ["mb" => 'form_factor'], "mb.id = c.motherboard_form_factor"
    //         )->innerJoin(
    //             ['ps' => "form_factor"], "ps.id = c.power_supply_form_factor"
    //         )->innerJoin(
    //             ["m" => 'manufacturer',], "m.id = c.manufacturer"
    //         )->innerJoin(
    //             ["cs" => 'case_size',], "cs.id = c.case_size"
    //         )
    //         ->where([
    //             "c.id" => $id,
    //         ])
    //         ->one();
    //     $data->manufacturer = $query["manufacturer"];
    //     $data->case_size = $query["case_size"];
    //     $data->motherboard_form_factor = $query["motherboard_form_factor"];
    //     $data->power_supply_form_factor = $query["power_supply_form_factor"];

    //     return $data;
    // }
    public function fields()
    {
        $fields = parent::fields();

        $fields["manufacturer"] = function ($model) {
            return $model->manufacturer0->name;
        };
        $fields["motherboard_form_factor"] = function ($model) {
            return $model->motherboardFormFactor->name;
        };
        $fields["power_supply_form_factor"] = function ($model) {
            return $model->powerSupplyFormFactor->name;
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
