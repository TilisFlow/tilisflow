<?php

namespace app\models;

/**
 * This is the model class for table "{{%project_category}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $color
 * @property integer $sort
 * @property integer $deleted
 *
 * @property Project[] $projects
 */
class ProjectCategory extends CustomActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%project_category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'color', 'deleted'], 'required'],
            [['deleted', 'sort', 'createdFrom', 'updatedFrom'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Titel',
            'description' => 'Beschreibung',
            'color' => 'Farbe',
            'sort' => 'Reihenfolge',
            'deleted' => 'Gelöscht',
            'createdAt' => 'Erstellt am',
            'createdFrom' => 'Erstellt von',
            'updatedAt' => 'Geändert am',
            'updatedFrom' => 'Geändert von',
        ];
    }

    public function getProjects()
    {
        return $this->hasMany(Project::class, ['idCategory' => 'id']);
    }
}
