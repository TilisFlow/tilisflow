<?php

/** @var yii\web\View $this */
/** @var Project $project */

use app\models\Project;
use yii\helpers\Url;

$this->title = 'Project settings';
?>
<div class="projects-index">
    <div class="bg-light py-3 border-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1><?= $this->title ?></h1>
                </div>
                <div class="col-md-6 pt-2 text-end">
                    <a href="<?= Url::to(['settings/categories']) ?>" class="btn btn-outline-primary">Categories</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container pt-5">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Estimated</th>
                <th scope="col">Time</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>ID</td>
                <td>Title</td>
                <td>Estimated</td>
                <td>Time</td>
                <td>Action</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
