<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AccessCode */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="access-code-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'access_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ticket_id')->textInput() ?>

    <?= $form->field($model, 'user_limit')->textInput() ?>

    <?= $form->field($model, 'claim_limit')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
