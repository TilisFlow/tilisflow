<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%project_task}}".
 *
 * @property int $id
 * @property int $idProject
 * @property string $title
 * @property string $description
 * @property int $state
 * @property int $deleted
 * @property int $owner
 * @property string $deadline
 * @property string $expiration
 * @property float $estimate
 *
 * @property Project $project
 * @property ProjectTaskComment[] $projectTaskComments
 * @property ProjectTaskTime[] $projectTaskTimes
 * @property integer $projectTotal
 */
class ProjectTask extends CustomActiveRecord
{

    const STATE_OPEN = 0;
    const STATE_IN_PROGRESS = 1;
    const STATE_DONE = 2;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%project_task}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idProject', 'title', 'state', 'deleted', 'owner'], 'required'],
            [['idProject', 'state', 'deleted', 'owner', 'createdFrom', 'updatedFrom'], 'integer'],
            [['description', 'deadline', 'expiration'], 'string'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['idProject'], 'exist', 'skipOnError' => true, 'targetClass' => Project::class, 'targetAttribute' => ['idProject' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idProject' => 'Projekt',
            'title' => 'Titel',
            'description' => 'Beschreibung',
            'state' => 'Status',
            'deleted' => 'Deleted',
            'owner' => 'Owner',
            'estimate' => 'Geschätzte Zeit',
            'expiration' => 'Ablaufdatum',
            'createdAt' => 'Created At',
            'createdFrom' => 'Created From',
            'updatedAt' => 'Updated At',
            'updatedFrom' => 'Updated From',
        ];
    }

    public function beforeSave($insert)
    {
        if(empty($this->expiration)){
            $this->expiration = "3333-00-00 00:00:00";
        }

        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        if($this->expiration == "3333-00-00 00:00:00"){
            $this->expiration = "";
        }

        parent::afterFind();
    }

    /**
     * Gets query for [[IdProject0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::class, ['id' => 'idProject']);
    }

    /**
     * Gets query for [[ProjectTaskComments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjectTaskComments()
    {
        return $this->hasMany(ProjectTaskComment::class, ['idProjectTask' => 'id']);
    }

    /**
     * Gets query for [[ProjectTaskTime]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjectTaskTimes()
    {
        return $this->hasMany(ProjectTaskTime::class, ['idProjectTask' => 'id']);
    }

    public function getTaskTotal()
    {
        return $this->hasMany(ProjectTaskTime::class, ['idProjectTask' => 'id'])->sum('duration');
    }
}
