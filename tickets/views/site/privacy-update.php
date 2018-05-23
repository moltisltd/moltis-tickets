<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Privacy Policy Confirmation');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please confirm acceptance of the <a href="<?php echo \yii\helpers\Url::to('/site/privacy'); ?>"><?php echo Yii::t('app', 'Privacy Policy'); ?></a>.</p>
    <p>If you do not accept the privacy policy, you will no longer be able to use the Tixty services. As per the privacy policy, you can have your account information purged by contacting <a href="mailto:support@tixty.co.uk">support@tixty.co.uk</a></p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'email')->hiddenInput()->label('') ?>
    <?= $form->field($model, 'password')->hiddenInput()->label('') ?>
    <?= $form->field($model, 'rememberMe')->hiddenInput()->label('') ?>

        <?= $form->field($model, 'terms')->checkbox(['required' => true]) ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Save and Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
