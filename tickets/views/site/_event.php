<?php
use yii\helpers\Html;

/** @var \app\models\Event $model */
$formatter = Yii::$app->formatter;
?>
<div>
<strong><?= Html::a($model->name, ['/events/viewslug', 'slug' => $model->slug]); ?></strong> <?= $formatter->asDateTime($model->start_time); ?>
</div>
