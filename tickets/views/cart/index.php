<?php
/* @var $this yii\web\View */
/* @var $cart app\models\Cart */

use app\models\CartItems;
use app\models\Session;
use \yii\helpers\Url;
use \yii\helpers\Html;

$this->title = Yii::t('app', 'Your cart');
$cartItems = CartItems::find()->where(['cart_id' => $cart->id]);
$cart->processCart();

$dataProvider = new yii\data\ActiveDataProvider([
    'query' => $cartItems,
        ]);
$formatter = \Yii::$app->formatter;
?>
<h1><?= Html::encode($this->title); ?></h1>
<?php
$session = new Session();
$errors = $session->getErrors();
$session->clearErrors();
foreach ($errors as $e) {
    ?><div class="alert alert-danger"><h2><?= $e ?></h2></div><?php
}
$successes = $session->getSuccesses();
$session->clearSuccesses();
foreach ($successes as $e) {
    ?><div class="alert alert-success"><h2><?= $e ?></h2></div><?php
        }
        ?>

<?=
yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => ['class' => 'table table-striped'],
    'columns' => [
        [
            'attribute' => 'ticket_id',
            'content' => function($model, $index, $widget, $grid) {
                return $model->ticket->group->event->name . ': ' . $model->ticket->name;
            },
            'label' => 'Ticket',
        ],
        [
            'attribute' => 'quantity',
            'content' => function($model, $index, $widget, $grid) {
                return (($model->ticket->getAvailableQuantity() === false || $model->ticket->getAvailableQuantity() > $model->quantity) ? '<a class="btn btn-xs btn-info" href="' . Url::to(['/cart/add/', 'id' => $model->ticket_id]) . '">+</a>' : '')
                        . $model->quantity
                        . (($model->quantity > 0) ? '<a class="btn btn-xs btn-info" href="' . Url::to(['/cart/reduce/', 'id' => $model->ticket_id]) . '">-</a>' : '');
            }
                ],
                [
                    'content' => function($model, $index, $widget, $grid) {
                        return $model->ticket->ticket_price;
                    },
                    'label' => 'Price',
                    'format' => 'currency',
                ],
                [
                    'content' => function($model, $index, $widget, $grid) {
                        return $model->ticket->ticket_price * $model->quantity;
                    },
                    'label' => 'Total',
                    'format' => 'currency',
                    'contentOptions' => ['class' => 'text-right'],
                    'headerOptions' => ['class' => 'text-right'],
                ],
            ],
        ]);
        ?>
        <div class="alert alert-info">
            <h3>
                <?php if ($cart->quantity > 0) : ?>
                    Your total: <?= $cart->quantity ?> tickets totalling <?= $formatter->asCurrency($cart->subtotal) ?> <small>(+ card processing fee of <?= $formatter->asCurrency($cart->stripe_fee) ?>)</small>
                    <?php if ($cart->total > 0 && $cartItems->one()->ticket->group->event->owner->stripe_user_id) : ?>
                        <form style="display:inline-block;vertical-align:middle;margin-left:50px;" action="<?= Url::to('charge') ?>" method="GET">
                            <script
                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="<?php echo Yii::$app->params['stripePublicKey']; ?>"
                                data-email="<?php echo Yii::$app->user->identity->email ?>"
                                data-description="<?= $cart->quantity ?> tickets"
                                data-amount="<?= floor($cart->total * 100) ?>"
                                data-currency="gbp">
                            </script>
                        </form>
                    <?php elseif ($cart->total == 0 && $cartItems->one()->ticket) : ?>
                        <form style="display:inline-block;vertical-align:middle;margin-left:50px;" action="<?= Url::to('charge') ?>" method="GET">
                            <button type="submit" class="btn btn-success"><?php echo Yii::t('app', 'Confirm tickets'); ?></button>
                        </form>
                    <?php endif; ?>
                <?php else : ?>
                    <?= Yii::t('app', 'Nothing in here! {home}', ['home' => Html::a(Yii::t('app', 'Go pick some tickets'), ['/'])]); ?>
                <?php endif; ?>
            </h3>
            <br><br>
            <small><?= Yii::t('app', 'Kaspersky Anti-Virus may block your ability to use the cart system. If this happens, you may need to use an alternate device (Tixty is mobile-friendly) or temporarily disable Kaspersky.') ?></small>
</div>