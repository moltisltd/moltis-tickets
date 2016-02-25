<?php
/* @var $this yii\web\View */
/* @var $cart app\models\Cart */

use app\models\CartItems;

$cartItems = CartItems::find()->where(['cart_id' => $cart->id]);
$cart->processCart();

$dataProvider = new yii\data\ActiveDataProvider([
    'query' => $cartItems,
        ]);
?>
<h1>Your cart</h1>

<?=
yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => ['class' => 'table table-striped'],
    'columns' => [
        [
            'attribute' => 'ticket_id',
            'content' => function($model, $index, $widget, $grid) {
                return $model->ticket->group->name . ': ' . $model->ticket->name;
            },
            'label' => 'Ticket',
        ],
        [
            'attribute' => 'quantity',
        ],
        [
            'content' => function($model, $index, $widget, $grid) {
                return $model->ticket->ticket_price;
            },
            'label' => 'Price',
            'format' => ['decimal', 2],
        ],
        [
            'content' => function($model, $index, $widget, $grid) {
                return $model->ticket->ticket_price * $model->quantity;
            },
            'label' => 'Total',
            'format' => ['decimal', 2],
            'contentOptions' => ['class' => 'text-right'],
            'headerOptions' => ['class' => 'text-right'],
        ],
    ],
]);
?>
<div class="alert alert-info">
    <h3>
        <?php if ($cart->quantity > 0) : ?>
            Your total: <?= $cart->quantity ?> tickets totalling <?= number_format($cart->subtotal, 2) ?> <small>(+ card fee of <?= number_format($cart->stripe_fee, 2) ?>)</small>
            <form style="display:inline-block;vertical-align:middle;margin-left:50px;" action="<?= \yii\helpers\Url::to('charge') ?>" method="GET">
                <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="<?php echo Yii::$app->params['stripePublicKey']; ?>"
                    data-email="<?php echo Yii::$app->user->identity->email ?>"
                    data-description="<?= $cart->quantity ?> tickets"
                    data-amount="<?= floor($cart->total * 100) ?>"
                    data-currency="gbp">
                </script>
            </form>
        <?php else : ?>
            Nothing in here! <a href="<?= \yii\helpers\Url::to('/') ?>">Go pick some tickets</a>
        <?php endif; ?>
    </h3>
</div>