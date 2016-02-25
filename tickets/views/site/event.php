<?php

use app\models\Event;
use app\models\Cart;
/* @var $this yii\web\View */

$_event = Event::findOne(1);
\Stripe\Stripe::setApiKey(Yii::$app->params['stripeSecretKey']);

$this->title = $_event->owner->name . ' - ' . $_event->name;
?>
<div class="site-index">

        <h1><?=$this->title;?></h1>

        <p><?=$_event->description?></p>

    <div class="body-content">
        <?php if (Yii::$app->user->isGuest) : ?>
        <p>
            If you're not registered, do so now or login:
            <a href="<?= \yii\helpers\Url::to('user/create')?>" class="btn btn-warning">Register</a>
            <a href="<?= \yii\helpers\Url::to('site/login')?>" class="btn btn-success">Login</a>
        </p>
        <?php endif; ?>
        
        <?php
        foreach ($_event->ticketGroups as $group) {
            if (sizeof($_event->ticketGroups) > 1) {
                ?><h2><?=$group->name?></h2><?php
            }
            $group_sold_out = false;
            if ($group->ticket_limit > 0) { // limited sales
                $sold_count = 0;
                foreach ($group->tickets as $ticket) {
                    foreach ($ticket->cartItems as $cartItems) {
                        if ($cartItems->cart->status == Cart::CART_SOLD) {
                            $sold_count += $cartItems->quantity;
                        }
                    }
                }
                if ($sold_count >= $group->ticket_limit) {
                    $group_sold_out = true;
                }
                
                foreach ($group->tickets as $ticket) {
                ?>
                <div class="row">
                    <div class="col-lg-4">
                        <strong><?=$ticket->name?></strong>
                    </div>
                    <div class="col-lg-6">
                        <?=$ticket->description?>
                    </div>
                    <div class="col-lg-2">
                        &pound;<?=number_format($ticket->ticket_price)?>
                        <?php if (Yii::$app->user->isGuest) : ?>
                        <a href="<?= \yii\helpers\Url::to('site/login')?>" class="btn btn-success">Login</a>
                        <?php else : ?>
                        <form action="index.php" method="POST">
                            <script
                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="<?php echo Yii::$app->params['stripePublicKey']; ?>"
                                data-description="<?=$ticket->name?>"
                                data-amount="<?=floor($ticket->ticket_price * 100)?>"
                                data-currency="gbp">
                            </script>
                        </form>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
                }
            }
        }
        ?>
        </div>

    </div>
</div>
