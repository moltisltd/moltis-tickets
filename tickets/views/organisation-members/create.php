<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OrganisationMembers */

$this->title = 'Create Organisation Members';
$this->params['breadcrumbs'][] = ['label' => 'Organisation Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organisation-members-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
