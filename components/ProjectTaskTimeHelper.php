<?php

namespace app\components;

use app\models\ProjectTaskTime;

class ProjectTaskTimeHelper
{

    /**
     * checks if the current task has an open time tracker entry
     *
     * @param $idProjectTask
     *
     * @return bool
     */
    public static function getTaskOpenTimerState($idProjectTask)
    {
        /** @var ProjectTaskTime $openTime */
        $openTime = self::getTaskOpenTimer($idProjectTask);

        return $openTime !== null;
    }

    /**
     * gets the open time tracker entry for the current task
     *
     * @param $idProjectTask
     *
     * @return ProjectTaskTime
     */
    public static function getTaskOpenTimer($idProjectTask)
    {
        /** @var ProjectTaskTime $openTime */
        $openTime = ProjectTaskTime::find()
            ->where(['idProjectTask' => $idProjectTask])
            ->andWhere(['end' => '0000-00-00 00:00:00'])
            ->andWhere(['owner' => \Yii::$app->user->id])
            ->one();

        return $openTime;
    }

    /**
     * Gets the open time tracker entry for the current user
     *
     * @return ProjectTaskTime
     */
    public static function getCurrentOpenTimer()
    {
        /** @var ProjectTaskTime $openTime */
        $openTime = ProjectTaskTime::find()
            ->where(['end' => '0000-00-00 00:00:00'])
            ->andWhere(['owner' => \Yii::$app->user->id])
            ->one();

        return $openTime;
    }

    /**
     * Gets info about any open timer for the current user
     *
     * @return bool
     */
    public static function getCurrentOpenTimerState()
    {
        /** @var ProjectTaskTime $openTime */
        $openTime = self::getCurrentOpenTimer();

        if ($openTime !== null) {
            return true;
        }

        return false;
    }

    /**
     * returns the duration of the current task as string
     *
     * @param $idProjectTask
     *
     * @return int
     */
    public static function secondsToString($duration)
    {
        $seconds = (int)$duration % 60;
        $minutes = ((int)($duration - $seconds) % 3600) / 60;
        $hours = round(($duration - $seconds - $minutes * 60) / 3600);
        return str_pad($hours, 2, '0', STR_PAD_LEFT).':'.str_pad($minutes, 2, '0', STR_PAD_LEFT);
    }

    /**
     * Gets the last Task there was a time tracker entry for
     *
     * @return ProjectTaskTime|null
     */
    public static function getLastTask()
    {
        /** @var ProjectTaskTime $openTime */
        $openTime = ProjectTaskTime::find()
            ->where(['owner' => \Yii::$app->user->id])
            ->where(['deleted' => 0])
            ->orderBy(['end' => SORT_DESC])
            ->one();

        if ($openTime !== null) {
            return $openTime;
        }

        return null;
    }
}
