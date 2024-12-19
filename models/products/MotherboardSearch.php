<?php

namespace app\models\products;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\products\Motherboard;

/**
 * MotherboardSearch represents the model behind the search form of `app\models\products\Motherboard`.
 */
class MotherboardSearch extends Motherboard
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'manufacturer', 'socket', 'memory_type', 'form_factor', 'memory_slots', 'm2_slots', 'price'], 'integer'],
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
        $query = Motherboard::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params,'');
        // if (!$this->validate()) {
        //     // uncomment the following line if you do not want to return any records when validation fails
        //     // $query->where('0=1');
            
        //     return $dataProvider;
        // }
        $query->joinWith(["socket0","memoryType","manufacturer0","formFactor"]);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'manufacturer.name' => $this->manufacturer,
            'processor_socket.name' => $this->socket,
            'memory.name' => $this->memory_type,
            'form_factor.name' => $this->form_factor,
            'memory_slots' => $this->memory_slots,
            'm2_slots' => $this->m2_slots,
            'price' => $this->price,
        ]);
        
        $query->andFilterWhere(['like', 'name', $this->name]);
        // $dataProvider = new ActiveDataProvider([
        //     'query' => $query,
        // ]);
        // var_dump($query);

        return $dataProvider;
    }
}
