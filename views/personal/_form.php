<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\personal $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="personal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nif_personal')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'rendimiento_personal')->textInput(['maxlength' => 2]) ?>

    <?= $form->field($model, 'nombre_personal')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'direccion_personal')->textInput(['maxlength' => 200]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
