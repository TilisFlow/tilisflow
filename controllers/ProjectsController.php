<?php

namespace app\controllers;

use app\components\HashHelper;
use app\models\Project;
use app\models\ProjectSearch;
use yii\filters\AccessControl;
use yii\web\Controller;

class ProjectsController extends Controller
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
     * Displays Dashboard.
     *
     * @return string
     */
    public function actionIndex()
    {
        /** @var ProjectSearch $searchModel */
        $searchModel = new ProjectSearch();
        $searchModel->deleted = 0;
        $searchModel->state = Project::STATE_ACTIVE;

        /** @var \yii\data\ActiveDataProvider $dataProvider */
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * creates a new project
     *
     * @return string|\yii\web\Response
     * @throws \yii\db\Exception
     */
    public function actionCreate()
    {
        /** @var Project $project */
        $project = new Project();
        $project->archive = 0;
        $project->deleted = 0;
        $project->state = 0;
        $project->budget = 0;
        $project->owner = \Yii::$app->user->id;
        if(!empty($project->idCategory))
            $project->idCategory = HashHelper::encode($project->idCategory);

        if (isset($_POST['Project'])) {
            $project->load($_POST);
            $project->description = $_POST['Project']['description'];
            $project->color = $_POST['Project']['color'];
            $project->budget = $_POST['Project']['budget'];
            $project->idCategory = HashHelper::decode($_POST['Project']['idCategory']);
            if ($project->save()) {
                \Yii::$app->session->setFlash('success', 'Projekt wurde erfolgreich erstellt.');
                return $this->redirect(['project/view', 'id' => HashHelper::encode($project->id)]);
            } else {
                \Yii::$app->session->setFlash('error', 'Projekt konnte nicht erstellt werden.');
            }
        }

        return $this->render('create', [
            'project' => $project,
        ]);
    }
}
