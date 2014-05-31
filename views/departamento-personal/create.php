<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\departamento_personal $model
 */

$this->title = Yii::t('app', 'Create {modelClass}', [
  'modelClass' => 'Departamento Personal',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Departamento Personals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departamento-personal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
