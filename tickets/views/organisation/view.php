<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Organisation */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Organisations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organisation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'url:url',
            'email:email',
            'summary:ntext',
        ],
    ]) ?>

    <a class="btn btn-info" href="https://connect.stripe.com/oauth/authorize?response_type=code&client_id=<?=Yii::$app->params['stripeClientID']?>&scope=read_write&state=<?=sha1($model->id . 'jiejieugs9837' . $model->name)?>">Authorise</a>
</div>
