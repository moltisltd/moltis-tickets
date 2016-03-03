<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AccessCode */

$this->title = Yii::t('app', 'Create Access Code');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Access Codes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="access-code-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
