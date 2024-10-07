<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProjectTask;

/**
 * ProjectTaskSearch represents the model behind the search form of `app\models\ProjectTask`.
 */
class ProjectTaskSearch extends ProjectTask
{
    public $projecttitle;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string'],
            [['id', 'idProject', 'state', 'deleted', 'owner', 'createdFrom', 'updatedFrom'], 'integer'],
            [['title', 'description', 'createdAt', 'updatedAt', 'projecttitle'], 'safe'],
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
        $query = ProjectTask::find();

        $query->joinWith(['project']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'title' => [
                        'asc' => ['project.title' => SORT_ASC],
                        'desc' => ['project.title' => SORT_DESC],
                    ],
                ],
            ]
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
            'idProject' => $this->idProject,
            'project_task.state' => $this->state,
            'deleted' => $this->deleted,
            'owner' => $this->owner,
            'createdAt' => $this->createdAt,
            'createdFrom' => $this->createdFrom,
            'updatedAt' => $this->updatedAt,
            'updatedFrom' => $this->updatedFrom,
        ]);

        $query->andFilterWhere(['like', 'project.title', $this->projecttitle]);

        $query->andFilterWhere(['like', 'project_task.title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchOpen($params)
    {
        $query = ProjectTask::find();

        $query->joinWith(['project']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'expiration' => SORT_ASC,
                    'title' => SORT_ASC,
                ],
                'attributes' => [
                    'expiration' => [
                        'asc' => ['project_task.expiration' => SORT_ASC],
                        'desc' => ['project_task.expiration' => SORT_DESC],
                    ],
                    'title' => [
                        'asc' => ['project_task.title' => SORT_ASC],
                        'desc' => ['project_task.title' => SORT_DESC],
                    ],
                    'projecttitle' => [
                        'asc' => ['project.title' => SORT_ASC],
                        'desc' => ['project.title' => SORT_DESC],
                    ],
                ],
            ],
            'pagination' => [
                'pageSize' => 100,
            ]
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
            'idProject' => $this->idProject,
            'deleted' => $this->deleted,
            'owner' => $this->owner,
            'createdAt' => $this->createdAt,
            'createdFrom' => $this->createdFrom,
            'updatedAt' => $this->updatedAt,
            'updatedFrom' => $this->updatedFrom,
        ]);

        $query->andFilterWhere([
            'and',
            ['in', 'project_task.state', [ProjectTask::STATE_IN_PROGRESS, ProjectTask::STATE_OPEN]],
        ]);

        $query->andFilterWhere(['like', 'project.title', $this->projecttitle]);

        $query->andFilterWhere(['like', 'project_task.title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
