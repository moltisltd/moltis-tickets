<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Yii::t('app', 'My Account');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-default-index">
    <h1><?= Yii::t('app', 'My Account')?></h1>
    <ul>
        <li><?= Html::a('View your information', ['/account/profile']) ?></li>
        <li><?= Html::a('View your orders', ['/account/orders']) ?></li>
    </ul>
</div>
