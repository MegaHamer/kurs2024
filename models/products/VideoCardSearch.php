<?php

namespace app\models\products;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\products\VideoCard;

/**
 * VideoCardSearch represents the model behind the search form of `app\models\products\VideoCard`.
 */
class VideoCardSearch extends VideoCard
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'manufacturer', 'graphics_processor', 'memory_capacity', 'count_fans', 'memory_type', 'video_outputs', 'price'], 'integer'],
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
        $query = VideoCard::find();

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
        $query->joinWith(["graphicsProcessor","memoryType","manufacturer0"]);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'manufacturer.name' => $this->manufacturer,
            'graphics_processor.name' => $this->graphics_processor,
            'memory_capacity' => $this->memory_capacity,
            'count_fans' => $this->count_fans,
            'memory.name' => $this->memory_type,
            'video_outputs' => $this->video_outputs,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
