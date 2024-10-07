<?php

namespace app\controllers;

use app\components\HashHelper;
use app\models\Project;
use app\models\ProjectCategory;
use app\models\ProjectCategorySearch;
use yii\filters\AccessControl;
use yii\web\Controller;

class SettingsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Displays project settings page.
     *
     * @return string
     */
    public function actionProjects()
    {
        return $this->render('index');
    }

    /**
     * Displays categories settings page.
     *
     * @return string
     */
    public function actionCategories()
    {
        /** @var ProjectCategorySearch $searchModel */
        $searchModel = new ProjectCategorySearch();
        $searchModel->deleted = 0;

        /** @var \yii\data\ActiveDataProvider $dataProvider */
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('categories', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * add category page
     *
     * @return string
     */
    public function actionCategoryCreate()
    {
        /** @var ProjectCategory $category */
        $category = new ProjectCategory();
        $category->deleted = 0;
        $category->color = '#000000';

        if(isset($_POST['ProjectCategory'])){
            $category->title = $_POST['ProjectCategory']['title'];
            $category->description = $_POST['ProjectCategory']['description'];
            $category->color = $_POST['ProjectCategory']['color'];
            $category->sort = $_POST['ProjectCategory']['sort'];
            if($category->save()){
                \Yii::$app->session->setFlash('success', 'Projektkategorie wurde erfolgreich erstellt.');
                $this->redirect(['settings/categories']);
            }else{
                \Yii::$app->session->setFlash('error', 'Projektkategorie konnte nicht erstellt werden.');
            }
        }

        return $this->render('category-create', [
            'category' => $category,
        ]);
    }
}
