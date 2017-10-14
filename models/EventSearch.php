<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Event;

/**
 * EventSearch represents the model behind the search form about `app\models\Event`.
 */
class EventSearch extends Event
{
    /**
     * @inheritdoc
     */
    public $name;

    public function rules()
    {
        return [
            [['id', 'direction_id', 'sub_dir_id', 'deadline'], 'integer'],
            [['event', 'details', 'deadline_other', 'name'], 'safe'],
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
        $query = Event::find()->orderBy('st_event.id')->innerJoinWith('executorAuthorities', true);
        //vd($query);

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
            'st_event.id' => $this->id,
            'direction_id' => $this->direction_id,
            'sub_dir_id' => $this->sub_dir_id,
            'deadline' => $this->deadline,
            //->andFilterWhere(['like', 'executor_authority_id', $this->name])
            'executor_authority_id' => $this->name,
        ]);

        $query->andFilterWhere(['like', 'event', $this->event])
            ->andFilterWhere(['like', 'st_event.details', $this->details])
            ->andFilterWhere(['like', 'deadline_other', $this->deadline_other]);
//vd($params['deadline']);
        /*$rangeArr = $params['deadline'];
        $from = strtotime($rangeArr[0]);
        $to = strtotime($rangeArr[1]);*/
        //vd($to);
        /*$query->andFilterWhere(['>=', 'deadline', $from])
            ->andFilterWhere(['<', 'deadline', $to]);*/

        return $dataProvider;
    }

}
