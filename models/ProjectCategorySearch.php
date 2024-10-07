<?php

namespace app\models;


use yii\data\ActiveDataProvider;

/**
 * ProjectSearch model
 */
class ProjectCategorySearch extends ProjectCategory
{

    public function rules()
    {
        return [
            [['id', 'deleted'], 'integer'],
            [['title'], 'string'],
        ];
    }

    public function search($params)
    {
        $query = ProjectCategory::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['sort' => SORT_ASC]],
            'pagination'=>['pageSize'=>100]
        ]);
        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        if (!empty($this->deleted) && $this->deleted !== 0)
            $query->andFilterWhere(['deleted' => $this->deleted]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
