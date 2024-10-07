<?php

/** @var Project $project */

use app\components\HashHelper;
use app\models\Project;
use app\models\ProjectCategory;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$projectCategories = ArrayHelper::map(
    ProjectCategory::find()->where(['deleted' => 0])->all(),
    function ($data) {
        return HashHelper::encode($data->id);
    },
    'title'
);

$form = ActiveForm::begin([
]);
echo $form->field($project, 'title')->textInput();


echo $form->field($project, 'description')->textarea();

echo $form->field($project, 'budget')->textInput(['type' => 'number', 'step' => '0.01']);

echo $form->field($project, 'idCategory')->dropDownList($projectCategories, ['prompt' => 'Bitte wählen']);

echo $form->field($project, 'color')->textInput(['type' => 'color']);

echo Html::beginTag('div', ['class' => 'row']);
echo Html::beginTag('div', ['class' => 'col-12']);
echo "Aktive Farben";
echo Html::endTag('div');
$projekte = Project::find()->groupBy('color')->all();
if (!empty($projekte)) {
    foreach ($projekte as $projekt) {
        if (!empty($projekt->color)) {
            $colortag = Html::tag('div', '&nbsp;', ['style' => 'background-color:' . $projekt->color]);
            echo Html::tag('div', $colortag, ['class' => 'col-2 activecolor', 'data-color' => $projekt->color]);
        }
    }
}
echo Html::endTag('div');

echo Html::beginTag('div', ['class' => 'row']);
echo Html::beginTag('div', ['class' => 'col-12 text-end']);
echo Html::submitButton('Save', ['class' => 'btn btn-success']);
echo Html::endTag('div');
echo Html::endTag('div');
ActiveForm::end();

