<?php

namespace app\models\products;

use app\models\Product;
use Yii;

/**
 * This is the model class for table "power_supply".
 *
 * @property int $id
 * @property int|null $manufacturer Производитель
 * @property int $power Мощность (номинал) (Вт)
 * @property int|null $80plus Сертификат 80 PLUS
 * @property int|null $form_factor Форм-фактор
 * @property string $name полное наименование
 * @property int $price цена
 *
 * @property 80plusCertificate $80plus0
 * @property FormFactor $formFactor
 * @property Manufacturer $manufacturer0
 */
class PowerSupply extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'power_supply';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['manufacturer', 'power', '80plus', 'form_factor', 'price'], 'integer'],
            [['manufacturer', '80plus', 'form_factor','power', 'name', 'price'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['manufacturer'], 'exist', 'skipOnError' => true, 'targetClass' => Manufacturer::class, 'targetAttribute' => ['manufacturer' => 'id']],
            [['80plus'], 'exist', 'skipOnError' => true, 'targetClass' => PlusCertificate::class, 'targetAttribute' => ['80plus' => 'id']],
            [['form_factor'], 'exist', 'skipOnError' => true, 'targetClass' => FormFactor::class, 'targetAttribute' => ['form_factor' => 'id']],
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
            'power' => 'Power',
            '80plus' => '80plus',
            'form_factor' => 'Form Factor',
            'name' => 'Name',
            'price' => 'Price',
        ];
    }

    /**
     * Gets query for [[80plus0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlus0()
    {
        return $this->hasOne(PlusCertificate::class, ['id' => 'plus80']);
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

    // public static function getPowerSupply($id)
    // {
    //     $data = self::find()->where(['id' => $id])->one();
    //     $query = (new \yii\db\Query())
    //         ->select([
    //             "manufacturer" => "m.name",
    //             "plus80" => "p.name",
    //             "form_factor" => "f.name"
    //         ])
    //         ->from([
    //             "ps" => "power_supply",
    //         ])->innerJoin(
    //             ["m" => 'manufacturer'],
    //             "m.id = ps.manufacturer"
    //         )->innerJoin(
    //             ["p" => "80plus_certificate",],
    //             "p.id = ps.plus80"
    //         )->innerJoin(
    //             ["f" => "form_factor",],
    //             "f.id = ps.form_factor"
    //         )
    //         ->where([
    //             "ps.id" => $id,
    //         ])
    //         ->one();
    //     $data->manufacturer = $query["manufacturer"];
    //     $data->plus80 = $query["plus80"];
    //     $data->form_factor = $query["form_factor"];

    //     return $data;
    // }
    public function fields()
    {
        $fields = parent::fields();

        $fields["manufacturer"] = function ($model) {
            return $model->manufacturer0->name;
        };
        $fields["plus80"] = function ($model) {
            return $model->plus0->name;
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
