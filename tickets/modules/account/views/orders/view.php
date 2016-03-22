<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Cart */

$formatter = \Yii::$app->formatter;

$dataProvider = new ActiveDataProvider([
    'query' => $model->getItems(),
        ]);
$model->processCart();

$this->title = Yii::t('app', 'My Order: #{cartid}', ['cartid' => str_pad($model->id, 5, '0', STR_PAD_LEFT)]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My Account'), 'url' => ['/account']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My Orders'), 'url' => ['/account/orders']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'ticket_id',
                'label' => Yii::t('app', 'Ticket'),
                'value' => function($data) {
                    return $data->getTicket()->one()->name;
                },
            ],
            [
                'attribute' => 'quantity',
                'label' => Yii::t('app', 'Quantity'),
            ],
            [
                'attribute' => 'ticket_price',
                'label' => Yii::t('app', 'Price'),
                'value' => function($data) {
                    return $data->getTicket()->one()->ticket_price;
                },
                'format' => 'currency',
            ],
        ],
    ]);
    ?>

    <div class="alert alert-info">
        <h3>
            Total: <?= $model->quantity ?> tickets totalling <?= $formatter->asCurrency($model->subtotal) ?> <small>(+ card processing fee of <?= $formatter->asCurrency($model->stripe_fee) ?>)</small>
        </h3>
    </div>
</div>
