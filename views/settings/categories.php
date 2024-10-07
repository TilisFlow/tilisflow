<?php

/** @var yii\web\View $this */
/** @var ProjectCategorySearch $searchModel */
/** @var \yii\data\ActiveDataProvider $dataProvider */

use app\components\HashHelper;
use app\models\Project;
use app\models\ProjectCategory;
use app\models\ProjectCategorySearch;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Category settings';
?>
<div class="projects-index">
    <div class="bg-light py-3 border-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1><?= $this->title ?></h1>
                </div>
                <div class="col-md-6 pt-2 text-end">
                    <a href="<?= Url::to(['settings/category-create']) ?>" class="btn btn-outline-primary">New</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container pt-5">
        <?= GridView::widget(
            [
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table table-flush'],
                'columns' => [
                    'sort',
                    'color',
                    [
                        'attribute' => 'title',
                        'format' => 'raw',
                        'value' => function ($project) {
                            /** @var ProjectCategory $project */
                            return $project->title;
                        },
                    ],
                    [
                        'header'=>'Aktion',
                        'format'=>'raw',
                        'value'=>function($project){
                            /** @var ProjectCategory $project */
                            return Html::a('<i class="fa fa-pencil"></i>',['update','id'=>HashHelper::encode($project->id)],['class'=>'btn btn-sm btn-warning']);
                        }
                    ]
                ],
            ]
        ) ?>
    </div>
</div>
