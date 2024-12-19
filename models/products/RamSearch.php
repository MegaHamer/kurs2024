<?php

namespace app\models\products;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\products\Ram;

/**
 * RamSearch represents the model behind the search form of `app\models\products\Ram`.
 */
class RamSearch extends Ram
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'manufacturer', 'memory_type', 'memory_capacity', 'frequency', 'number_modules', 'price'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Ram::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params,"");

        // if (!$this->validate()) {
        //     // uncomment the following line if you do not want to return any records when validation fails
        //     // $query->where('0=1');
        //     return $dataProvider;
        // }
        $query->joinWith(["memoryType","manufacturer0"]);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'manufacturer.name' => $this->manufacturer,
            'memory.name' => $this->memory_type,
            'memory_capacity' => $this->memory_capacity,
            'frequency' => $this->frequency,
            'number_modules' => $this->number_modules,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
