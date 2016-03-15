<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tickets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ticket', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'group_id',
                'value' => function($data) {
                    return app\models\TicketGroup::findOne($data->group_id)->name;
                }
            ],
            [
                'attribute' => 'type_id',
                'value' => function($data) {
                    return app\models\TicketType::findOne($data->type_id)->name;
                }
            ],
            'name',
            'ticket_price',
            // 'ticket_fee',
            // 'fee_included',
            // 'ticket_limit',
            // 'description',
            // 'sell_from',
            // 'sell_until',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
