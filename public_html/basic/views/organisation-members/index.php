<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Organisation Members';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organisation-members-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Organisation Members', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'organisation_id',
            'user_id',
            'founder',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
