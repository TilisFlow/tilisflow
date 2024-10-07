<?php

/** @var yii\web\View $this */
/** @var Project $project */

use app\components\HashHelper;
use app\components\ProjectTaskTimeHelper;
use app\models\Project;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Projects';
?>
<div class="projects-index">
    <div class="bg-light py-3 border-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h1><?= $this->title ?></h1>
                </div>
                <div class="col-md-4 pt-2 text-center">
                    <div class="dropdown">
                        <a href="" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                            Status: Open
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#" class="dropdown-item">Item</a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item">Item</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 pt-2 text-end">
                    <a href="<?= Url::to(['projects/create']) ?>" class="btn btn-outline-primary">Neues Projekt</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container pt-5">
        <?= GridView::widget(
            [
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table table-striped table-hover table-sm'],
                'summary'=>false,
                'columns' => [
                    [
                        'attribute' => 'title',
                        'format' => 'raw',
                        'value' => function ($project) {
                            /** @var Project $project */
                            $colorprefix = Html::tag('span', '&nbsp;', ['class' => 'badge rounded-pill']);
                            if (!empty($project->color))
                                $colorprefix = Html::tag('span', '&nbsp;', ['style' => 'background-color:' . $project->color, 'class' => 'badge rounded-pill']);
                            return Html::a($colorprefix .' ' . $project->title, ['projects/view', 'id' => HashHelper::encode($project->id)], ['class'=>'link-underline-opacity-0']);
                        },
                    ],
                    [
                        'attribute' => 'budget',
                        'headerOptions' => ['style' => 'width: 50px;'],
                        'format' => 'raw',
                        'value' => function ($project) {
                            /** @var Project $project */
//                                    return $project->budget*60*60;
                            return ProjectTaskTimeHelper::secondsToString($project->budget * 60 * 60);
                        },
                    ],
                    [
                        'header' => 'Zeit',
                        'attribute' => 'projectTotal',
                        'headerOptions' => ['style' => 'width: 50px;'],
                        'format' => 'raw',
                        'value' => function ($project) {
                            /** @var Project $project */
                            if ($project->budget * 60 * 60 < $project->projectTotal && $project->budget > 0) {
                                return '<span class="text-danger">' . ProjectTaskTimeHelper::secondsToString($project->projectTotal) . '</span>';
                            } else {
                                return ProjectTaskTimeHelper::secondsToString($project->projectTotal);
                            }
                        },
                    ],
                ],
            ]
        ) ?>
    </div>
</div>
