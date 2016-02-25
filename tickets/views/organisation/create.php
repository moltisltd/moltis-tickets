<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Organisation */

$this->title = 'Create Organisation';
$this->params['breadcrumbs'][] = ['label' => 'Organisations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organisation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
