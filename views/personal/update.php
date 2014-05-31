<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\personal $model
 */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
  'modelClass' => 'Personal',
]) . $model->id_personal;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Personals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_personal, 'url' => ['view', 'id' => $model->id_personal]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="personal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
