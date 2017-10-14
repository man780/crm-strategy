<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SubEvent;

/**
 * SubEventSearch represents the model behind the search form about `app\models\SubEvent`.
 */
class SubEventSearch extends SubEvent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'event_id', 'direction_id', 'sub_dir_id', 'deadline', 'percentage', 'status'], 'integer'],
            [['event', 'mechanism', 'details', 'deadline_other'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = SubEvent::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'event_id' => $this->event_id,
            'direction_id' => $this->direction_id,
            'sub_dir_id' => $this->sub_dir_id,
            'deadline' => $this->deadline,
            'percentage' => $this->percentage,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'event', $this->event])
            ->andFilterWhere(['like', 'mechanism', $this->mechanism])
            ->andFilterWhere(['like', 'details', $this->details])
            ->andFilterWhere(['like', 'deadline_other', $this->deadline_other]);

        return $dataProvider;
    }
}
