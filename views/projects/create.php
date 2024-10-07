<?php

/** @var yii\web\View $this */

$this->title = 'New project';
?>
<div class="projects-index">
    <div class="bg-light py-3 border-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h1><?= $this->title ?></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container pt-5">
        <?= $this->render('_form', [
                'project'=>$project,
        ]) ?>
    </div>
</div>
