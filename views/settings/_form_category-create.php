<?php

/** @var ProjectCategory $category */

use app\models\ProjectCategory;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin();
echo $form->field($category, 'title')->textInput();


echo $form->field($category, 'description')->textarea();
echo $form->field($category, 'sort')->textInput();
echo $form->field($category, 'color')->textInput(['type' => 'color']);

echo Html::beginTag('div', ['class' => 'row']);
echo Html::beginTag('div', ['class' => 'col-12']);
echo "Aktive Farben";
echo Html::endTag('div');
$projectCategorys = ProjectCategory::find()->groupBy('color')->all();
if(!empty($projectCategorys)){
    foreach ($projectCategorys as $projectCategoryItem) {
        if(!empty($projectCategoryItem->color)){
            $colortag = Html::tag('div', '&nbsp;', ['style'=>'background-color:'.$projectCategoryItem->color]);
            echo Html::tag('div', $colortag, ['class' => 'col-2 activecolor', 'data-color'=>$projectCategoryItem->color]);
        }
    }
}
echo Html::endTag('div');

echo Html::beginTag('div', ['class' => 'row']);
echo Html::beginTag('div', ['class' => 'col-12 text-end']);
echo Html::submitButton('Speichern', ['class' => 'btn btn-success']);
echo Html::endTag('div');
echo Html::endTag('div');
ActiveForm::end();

