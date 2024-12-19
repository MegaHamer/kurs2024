<?php

namespace app\models\products;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\products\ComputerCase;

/**
 * ComputerCaseSearch represents the model behind the search form of `app\models\products\ComputerCase`.
 */
class ComputerCaseSearch extends ComputerCase
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'manufacturer', 'motherboard_form_factor', 'power_supply_form_factor', 'case_size', 'price'], 'integer'],
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
        $query = ComputerCase::find();

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
        $query->joinWith(["manufacturer0","motherboardFormFactor mother","powerSupplyFormFactor power"]);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'manufacturer.name' => $this->manufacturer,
            'mother.name' => $this->motherboard_form_factor,
            'power.name' => $this->power_supply_form_factor,
            'case_size' => $this->case_size,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
