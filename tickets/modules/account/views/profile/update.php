<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = Yii::t('app', 'Update User: {name}', ['name' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My Account'), 'url' => ['/account']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profile'), 'url' => ['/account/profile']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="account-profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
