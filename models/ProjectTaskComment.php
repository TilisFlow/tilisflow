<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%project_task_comment}}".
 *
 * @property int $id
 * @property int $idProjectTask
 * @property string $comment
 * @property string $attachment
 * @property int $deleted
 * @property string $createdAt
 * @property int $createdFrom
 * @property string $updatedAt
 * @property int $updatedFrom
 *
 * @property ProjectTask $projectTask
 */
class ProjectTaskComment extends CustomActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%project_task_comment}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idProjectTask', 'comment', 'attachment', 'deleted', 'createdAt', 'createdFrom', 'updatedAt', 'updatedFrom'], 'required'],
            [['idProjectTask', 'deleted', 'createdFrom', 'updatedFrom'], 'integer'],
            [['comment', 'attachment'], 'string'],
            [['createdAt', 'updatedAt'], 'safe'],
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
            'comment' => 'Comment',
            'attachment' => 'Attachment',
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
     * @return \yii\db\ActiveQuery
     */
    public function getProjectTask()
    {
        return $this->hasOne(ProjectTask::class, ['id' => 'idProjectTask']);
    }
}
