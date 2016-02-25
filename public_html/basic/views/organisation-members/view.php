<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OrganisationMembers */

$this->title = $model->organisation->name . ': ' . $model->user->name;
$this->params['breadcrumbs'][] = ['label' => 'Organisation Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organisation-members-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'organisation_id' => $model->organisation_id, 'user_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'organisation_id' => $model->organisation_id, 'user_id' => $model->user_id], [
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
            [
                'label' => 'Organisation',
                'value' => $model->organisation->name,
            ],
            [
                'label' => 'User',
                'value' => $model->user->name,
            ],
            'founder:boolean',
        ],
    ]) ?>

</div>
