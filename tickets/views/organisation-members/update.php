<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrganisationMembers */

$this->title = 'Update Organisation Members: ' . ' ' . $model->organisation_id;
$this->params['breadcrumbs'][] = ['label' => 'Organisation Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->organisation_id, 'url' => ['view', 'organisation_id' => $model->organisation_id, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="organisation-members-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
