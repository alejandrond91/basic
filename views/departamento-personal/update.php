<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\departamento_personal $model
 */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
  'modelClass' => 'Departamento Personal',
]) . $model->id_dep_personal;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Departamento Personals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_dep_personal, 'url' => ['view', 'id' => $model->id_dep_personal]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="departamento-personal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
