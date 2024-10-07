<?php

namespace app\controllers;

use yii\web\Controller;

class BaseController extends Controller
{

    public function beforeAction($action)
    {
        \Yii::$app->language = \Yii::$app->session->get('language', 'en');
        return parent::beforeAction($action);
    }

}