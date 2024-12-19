<?php

namespace app\models\products;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\products\Processor;

/**
 * ProcessorSearch represents the model behind the search form of `app\models\products\Processor`.
 */
class ProcessorSearch extends Processor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'manufacturer', 'socket', 'count_productive_cores', 'memory_type', 'thermal_design_power', 'price'], 'integer'],
            [['model'], 'safe'],
            [['base_frequency'], 'number'],
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
        $query = Processor::find();

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
        $query->joinWith(["manufacturer0","socket0","memoryType"]);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'manufacturer.name' => $this->manufacturer,
            'processor_socket.name' => $this->socket,
            'count_productive_cores' => $this->count_productive_cores,
            'memory.name' => $this->memory_type,
            'base_frequency' => $this->base_frequency,
            'thermal_design_power' => $this->thermal_design_power,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'model', $this->model]);

        return $dataProvider;
    }
}
