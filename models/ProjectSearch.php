<?php

namespace app\models;

use yii\data\ActiveDataProvider;

/**
 * ProjectSearch model
 */
class ProjectSearch extends Project
{

    public function rules()
    {
        return [
            [['id', 'state', 'archive', 'deleted'], 'integer'],
            [['title'], 'string'],
        ];
    }

    public function search($params)
    {
        $query = Project::find();

        $query->leftJoin(ProjectCategory::tableName(), Project::tableName().'.idCategory = '.ProjectCategory::tableName().'.id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['category.sort'=>SORT_ASC, 'createdAt' => SORT_DESC]],
            'pagination'=>['pageSize'=>100]
        ]);
        $this->load($params);

        $dataProvider->sort->attributes['category.sort'] = [
            'asc' => [ProjectCategory::tableName().'.sort' => SORT_ASC],
            'desc' => [ProjectCategory::tableName().'.sort' => SORT_DESC],
        ];

        if (!$this->validate()) {
            return $dataProvider;
        }

        if (!empty($this->archive) || (int)$this->state === Project::STATE_ACTIVE)
            $query->andFilterWhere([Project::tableName().'.archive' => $this->archive]);

        if (!empty($this->deleted) || (int)$this->state === Project::STATE_ACTIVE)
            $query->andFilterWhere([Project::tableName().'.deleted' => $this->deleted]);

        if (!empty($this->state) || (int)$this->state === Project::STATE_ACTIVE){
            $query->andFilterWhere([Project::tableName().'.state' => $this->state]);
        }

        $query->andFilterWhere(['like', Project::tableName().'.title', $this->title]);

        return $dataProvider;
    }
}
