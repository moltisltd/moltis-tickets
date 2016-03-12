<?php

use app\models\Location;
use app\models\Organisation;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Event', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'owner_id',
                'value' => function($data) {
                    return Organisation::findOne($data->owner_id)->name;
                }
            ],
            'name',
            'slug',
            [
                'attribute' => 'start_time',
                'value' => function($data) {
                    return date('jS F Y', strtotime($data->start_time));
                }
            ],
            [
                'attribute' => 'end_time',
                'value' => function($data) {
                    return date('jS F Y', strtotime($data->end_time));
                }
            ],
            [
                'attribute' => 'location_id',
                'value' => function($data) {
                    return Location::findOne($data->location_id)->name;
                }
            ],
            // 'description:ntext',
            // 'summary',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
