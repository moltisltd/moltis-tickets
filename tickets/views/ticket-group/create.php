<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TicketGroup */

$this->title = 'Create Ticket Group';
$this->params['breadcrumbs'][] = ['label' => 'Ticket Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
