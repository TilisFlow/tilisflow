<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%project_task_time}}".
 *
 * @property int $id
 * @property int $idProjectTask
 * @property string $start
 * @property string $end
 * @property int $duration
 * @property int $owner
 * @property int $deleted
 * @property string $createdAt
 * @property int $createdFrom
 * @property string $updatedAt
 * @property int $updatedFrom
 *
 * @property ProjectTask $projectTask
 */
class ProjectTaskTime extends CustomActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%project_task_time}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idProjectTask', 'start'], 'required'],
            [['idProjectTask', 'duration', 'owner', 'deleted', 'createdFrom', 'updatedFrom'], 'integer'],
            [['start', 'end', 'createdAt', 'updatedAt'], 'safe'],
            [['idProjectTask'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectTask::class, 'targetAttribute' => ['idProjectTask' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idProjectTask' => 'Id Project Task',
            'start' => 'Start',
            'end' => 'End',
            'duration' => 'Duration',
            'owner' => 'Owner',
            'deleted' => 'Deleted',
            'createdAt' => 'Created At',
            'createdFrom' => 'Created From',
            'updatedAt' => 'Updated At',
            'updatedFrom' => 'Updated From',
        ];
    }

    /**
     * Gets query for [[IdProjectTask0]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getProjectTask()
    {
        return $this->hasOne(ProjectTask::class, ['id' => 'idProjectTask']);
    }
}
