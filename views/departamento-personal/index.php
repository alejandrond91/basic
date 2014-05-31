<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\departamento_personalSearch $searchModel
 */

$this->title = Yii::t('app', 'Departamento Personals');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departamento-personal-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
  'modelClass' => 'Departamento Personal',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_dep_personal',
            'id_dep',
            'id_personal',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
