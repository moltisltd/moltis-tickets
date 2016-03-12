<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrganisationMembers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organisation-members-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'organisation_id')->dropDownList(Organisation::getList()) ?>

    <?= $form->field($model, 'user_id')->dropDownList(User::getList()) ?>

    <?= $form->field($model, 'founder')->radioList(['0' => 'No', '1' => 'Yes']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
