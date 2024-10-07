<?php

/** @var yii\web\View $this */
/** @var ProjectCategory $category */

use app\models\ProjectCategory;
use yii\helpers\Url;

$this->title = 'Create Category';
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
        <?= $this->render('_form_category-create', [
            'category'=>$category,
        ]) ?>
    </div>
</div>
