<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ticket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'group_id')->dropDownList(\app\models\TicketGroup::getList()) ?>

    <?= $form->field($model, 'type_id')->dropDownList(app\models\TicketType::getList()) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ticket_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ticket_fee')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fee_included')->radioList(['0' => 'No', '1' => 'Yes']) ?>

    <?= $form->field($model, 'ticket_limit')->textInput() ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sell_from')->textInput() ?>

    <?= $form->field($model, 'sell_until')->textInput() ?>

    <?= $form->field($model, 'requires_access_code')->radioList(['0' => 'No', '1' => 'Yes']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
