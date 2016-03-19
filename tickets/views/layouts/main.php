<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Cart;

AppAsset::register($this);

$navItems[] = ['label' => 'Home', 'url' => ['/']];
if (Yii::$app->user->isGuest) {
    $navItems[] = ['label' => 'Login', 'url' => ['/site/login']];
} else {
    $cart = Cart::getCurrentCart();
    $cart->processCart();
    $navItems[] = ['label' => 'Cart' . ($cart->quantity ? ' (' . $cart->quantity . ')' : ''), 'url' => ['/cart']];
    $navItems[] = ['label' => 'My Account', 'url' => ['/account']];
    $navItems[] = [
        'label' => 'Logout (' . Yii::$app->user->identity->name . ')',
        'url' => ['/site/logout'],
        'linkOptions' => ['data-method' => 'post']
    ];
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'Tixty',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $navItems,
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">
                    &copy; <a href="http://www.moltis.co.uk/">moltis</a> <?= date('Y') ?>.
                    <?= Yii::t('app', 'If you encounter any problems, {email}.', ['email' => Html::a(Yii::t('app', 'email us'), 'mailto:' . \Yii::$app->params['adminEmail'])]); ?>
                </p>

                <p class="pull-right">
                    <span id="siteseal"><script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=uZwMgPMRvYrjlxEriv2bg9OlaWnsLfb9gBi8nxGdi2E4GZ5zUmHm18EA4tPB"></script></span>
                </p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
