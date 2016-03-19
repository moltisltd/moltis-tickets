<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'My Orders');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My Account'), 'url' => ['/account']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-orders-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'attribute' => 'updated',
                'format' => 'dateTime',
                ],
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return $data->displayStatus();
                }
            ],
            [
                'attribute' => 'quantity',
                'value' => function($data) {
                    $data->processCart();
                    return $data->quantity;
                },
            ],
                    [
                        'attribute' => 'total',
                'value' => function($data) {
                    $data->processCart();
                    return $data->total;
                },
                    ],
            [
                'content' => function($data) {
                    return Html::a(Yii::t('app', 'View'), ['view', 'id' => $data->id], ['class' => 'btn btn-primary']);
                },
                    ],
                ],
            ]);
            ?>

</div>
