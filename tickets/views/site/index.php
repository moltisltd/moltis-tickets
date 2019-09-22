<?php

/* @var $this yii\web\View */

$this->title = 'Tixty';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome to Tixty</h1>

        <p class="lead">Tixty is a ticketing service designed by LRPers for LRPers. It's still in an alpha-state, but it's functional!</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-xs-12">
                <h2>Upcoming Events</h2>
<?php
$dataProvider = new \yii\data\ActiveDataProvider([
    'query' => \app\models\Event::find()->where('start_time > :start', ['start' => date('Y-m-d H:i:s')]),
    'pagination' => [
        'pageSize' => 20,
    ],
]);
echo \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_event',
]);
?>
            </div>
        </div>

    </div>
</div>
