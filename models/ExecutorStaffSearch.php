<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ExecutorStaff;

/**
 * ExecutorStaffSearch represents the model behind the search form about `app\models\ExecutorStaff`.
 */
class ExecutorStaffSearch extends ExecutorStaff
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'exec_id', 'user_id'], 'integer'],
            [['fio', 'details', 'phones', 'emails'], 'safe'],
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
        $query = ExecutorStaff::find();

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
            'exec_id' => $this->exec_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'fio', $this->fio])
            ->andFilterWhere(['like', 'details', $this->details])
            ->andFilterWhere(['like', 'phones', $this->phones])
            ->andFilterWhere(['like', 'emails', $this->emails]);

        return $dataProvider;
    }
}
