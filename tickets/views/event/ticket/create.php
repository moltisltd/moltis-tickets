<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ticket */
/* @var $form ActiveForm */
?>
<div class="event-ticket-create">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'group_id') ?>
        <?= $form->field($model, 'type_id') ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'ticket_price') ?>
        <?= $form->field($model, 'ticket_fee') ?>
        <?= $form->field($model, 'fee_included') ?>
        <?= $form->field($model, 'ticket_limit') ?>
        <?= $form->field($model, 'description') ?>
        <?= $form->field($model, 'sell_from') ?>
        <?= $form->field($model, 'sell_until') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- event-ticket-create -->
