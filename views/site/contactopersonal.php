<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\contactoPersonal $model
 * @var ActiveForm $form
 */
?>
<div class="site-contactopersonal">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'to') ?>
        <?= $form->field($model, 'subject') ?>
        <?= $form->field($model, 'body') ?>
        
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Enviar Correo'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-contactopersonal -->
