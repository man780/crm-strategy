<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Execution;

/**
 * ExecutionSearch represents the model behind the search form about `app\models\Execution`.
 */
class ExecutionSearch extends Execution
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'exec_id', 'exec_staff_id', 'direction_id', 'sub_dir_id', 'event_id', 'actual_mastering_finance', 'timely_financial_security', 'persentage', 'bycreated', 'dcreated', 'bydeleted', 'ddeleted'], 'integer'],
            [['execution_information', 'factors_preventing_implementation'], 'safe'],
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
        $query = Execution::find();

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
            'exec_staff_id' => $this->exec_staff_id,
            'direction_id' => $this->direction_id,
            'sub_dir_id' => $this->sub_dir_id,
            'event_id' => $this->event_id,
            'actual_mastering_finance' => $this->actual_mastering_finance,
            'timely_financial_security' => $this->timely_financial_security,
            'persentage' => $this->persentage,
            'bycreated' => $this->bycreated,
            'dcreated' => $this->dcreated,
            'bydeleted' => $this->bydeleted,
            'ddeleted' => $this->ddeleted,
        ]);

        $query->andFilterWhere(['like', 'execution_information', $this->execution_information])
            ->andFilterWhere(['like', 'factors_preventing_implementation', $this->factors_preventing_implementation]);

        return $dataProvider;
    }
}
