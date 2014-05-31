<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\departamento_personal $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="departamento-personal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_dep')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'id_personal')->textInput(['maxlength' => 20]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
