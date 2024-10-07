<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProjectTaskTime;

/**
 * ProjectTaskTimeSearch represents the model behind the search form of `app\models\ProjectTaskTime`.
 */
class ProjectTaskTimeSearch extends ProjectTaskTime
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idProjectTask', 'duration', 'owner', 'deleted', 'createdFrom', 'updatedFrom'], 'integer'],
            [['start', 'end', 'createdAt', 'updatedAt'], 'safe'],
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
        $query = ProjectTaskTime::find();

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
            'idProjectTask' => $this->idProjectTask,
            'start' => $this->start,
            'end' => $this->end,
            'duration' => $this->duration,
            'owner' => $this->owner,
            'deleted' => $this->deleted,
            'createdAt' => $this->createdAt,
            'createdFrom' => $this->createdFrom,
            'updatedAt' => $this->updatedAt,
            'updatedFrom' => $this->updatedFrom,
        ]);

        return $dataProvider;
    }
}
