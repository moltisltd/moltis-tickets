<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TicketGroup */

$this->title = 'Update Ticket Group: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ticket Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ticket-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
