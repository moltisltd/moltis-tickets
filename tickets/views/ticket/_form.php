<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\TicketGroup;
use app\models\TicketType;

/* @var $this yii\web\View */
/* @var $model app\models\Ticket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'group_id')->dropDownList(TicketGroup::getList()) ?>

    <?= $form->field($model, 'type_id')->dropDownList(TicketType::getList()) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ticket_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ticket_fee')->hiddenInput(['value' => Yii::$app->params['ticketFee']])->label(false) ?>
    <div class="form-group">
        <label class="control-label"><?= Yii::t('app', 'Ticket Fee') ?></label>
        <div class="form-control-static"><?= \Yii::$app->formatter->asCurrency(Yii::$app->params['ticketFee']) ?></div>
    </div>

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
