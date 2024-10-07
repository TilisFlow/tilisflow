<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%project}}".
 *
 * @property int $id
 * @property int $idCategory
 * @property string $title
 * @property int $state
 * @property int $archive
 * @property int $deleted
 * @property int $owner
 * @property float $budget
 * @property string $description
 * @property string $color
 *
 * @property ProjectTask[] $projectTasks
 * @property integer $projectTotal
 * @property ProjectCategory $category
 */
class Project extends CustomActiveRecord
{

    const STATE_ACTIVE = 0;
    const STATE_FINISH = 1;
    const STATE_INVOICED = 2;
    const STATE_WAIT = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%project}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idCategory', 'title', 'state', 'archive', 'deleted', 'owner'], 'required'],
            [['state', 'archive', 'deleted', 'owner', 'createdFrom', 'updatedFrom'], 'integer'],
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
            'idCategory' => 'Category',
            'title' => 'Project title',
            'state' => 'State',
            'archive' => 'Archive',
            'deleted' => 'Deleted',
            'owner' => 'Owner',
            'budget' => 'Budget',
            'description' => 'Description',
            'color' => 'Color',
            'createdAt' => 'Created At',
            'createdFrom' => 'Created From',
            'updatedAt' => 'Updated At',
            'updatedFrom' => 'Updated From',
        ];
    }

    /**
     * Gets query for [[ProjectTasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjectTasks()
    {
        return $this->hasMany(ProjectTask::class, ['idProject' => 'id']);
    }

    public function getProjectTotal()
    {
        $total = 0;
        $tasks = ProjectTask::find()->where(['idProject' => $this->id])->all();
        if(!empty($tasks)){
            foreach($tasks as $task){
                $total += $task->getTaskTotal();
            }
        }
        return $total;
    }

    public function getCategory()
    {
        return $this->hasOne(ProjectCategory::class, ['id' => 'idCategory']);
    }
}
