<?php

use app\models\Event;
use app\models\Cart;
use yii\helpers\Html;

/* @var $this yii\web\View */

$_event = Event::findOne(2);
$location = $_event->getLocation()->one();
$formatter = Yii::$app->formatter;

$this->title = Yii::t('app', '{owner} - {event}', ['owner' => $_event->owner->name, 'event' => $_event->name]);
?>
<div class="site-index">

    <h1><?= $this->title; ?></h1>
    <h2><?= $formatter->asDate($_event->start_time) ?> - <?= $formatter->asDate($_event->end_time) ?></h2>
    <h3><?= Yii::t('app', '{name}, {address}, {postcode}', ['name' => $location->name, 'address' => $location->address, 'postcode' => $location->postcode]) ?></h3>

    <p><?= nl2br( $_event->description ) ?></p>
    <hr>
    <div class="body-content">
        <?php if (Yii::$app->user->isGuest) : ?>
            <p>
                <?=
                Yii::t('app', "If you're not registered, do so now or login: {register} {login}", [
                    'register' => Html::a(Yii::t('app', 'Register'), ['/register'], ['class' => 'btn btn-warning']),
                    'login' => Html::a(Yii::t('app', 'Login'), ['/login'], ['class' => 'btn btn-success'])
                ]);
                ?>
            </p>
        <?php else : ?>
            <p><?= Yii::t('app', "You're logged in! Add tickets to {cartbtn}!", ['cartbtn' => Html::a(Yii::t('app', 'your cart'), ['/cart'])]) ?></p>
        <?php endif; ?>

        <?php
        foreach ($_event->ticketGroups as $group) {
            if (sizeof($_event->ticketGroups) > 1 && sizeof($group->tickets) > 0) {
                ?><h2><?= $group->name ?></h2><?php
            }
            $group_sold_out = false;
            if ($group->ticket_limit > 0) { // limited sales
                $sold_count_all = 0;
                $sold_count = [];
                foreach ($group->tickets as $ticket) {
                    $sold_count[$ticket->id] = 0;
                    foreach ($ticket->cartItems as $cartItems) {
                        if ($cartItems->cart->status == Cart::CART_SOLD) {
                            $sold_count_all += $cartItems->quantity;
                            $sold_count[$ticket->id] += $cartItems->quantity;
                        }
                    }
                }
                if ($sold_count_all >= $group->ticket_limit) {
                    $group_sold_out = true;
                }
            }

            foreach ($group->tickets as $ticket) {
                ?>
                <div class="row">
                    <div class="col-md-3 col-xs-12">
                        <strong><?= $ticket->name ?></strong>
                    </div>
                    <div class="col-md-5 col-xs-12">
                        <?= $ticket->description ?>
                    </div>
                    <div class="col-md-1 col-xs-5 text-right">
                        <?= Yii::$app->formatter->asCurrency($ticket->ticket_price) ?><small>*</small>
                    </div>
                    <div class="col-md-3 col-xs-7 text-right">
                        <?php if ($ticket->sell_from > date('Y-m-d H:i:s')) : ?>
                            <?= Yii::t('app', 'Available from {sellfrom}', ['sellfrom' => $formatter->asDateTime($ticket->sell_from)]); ?>
                        <?php elseif ($ticket->sell_until < date('Y-m-d H:i:s')) : ?>
                            <?= Yii::t('app', 'No longer available'); ?>
                        <?php elseif (Yii::$app->user->isGuest) : ?>
                            <a href="<?= \yii\helpers\Url::to('site/login') ?>" class="btn btn-success">Login</a>
                        <?php elseif ($group_sold_out || ($ticket->ticket_limit > 0 && $sold_count[$ticket->id] >= $ticket->ticket_limit)) : ?>
                            <?= Yii::t('app', 'Sold out'); ?>
                        <?php else : ?>
                            <form class="form-inline" style="display:inline-block" action="<?= \yii\helpers\Url::to('cart/add') ?>" method="GET">
                                <?php if ($ticket->requires_access_code) : ?>
                                    <input class="form-control input-sm" type="text" name="access_code" placeholder="<?= Yii::t('app', 'Access Code') ?>">
                                <?php endif; ?>
                                <input type="hidden" name="id" value="<?= $ticket->id ?>">
                                <button class="btn btn-sm btn-info" type="submit">Add to cart</button>
                            </form>
                        <?php endif; ?>
                        <br><br>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        <small>* <?= Yii::t('app', 'You will be also be charged a card processing fee depending on your card type') ?></small>
        <br><br>
        <small><?= Yii::t('app', 'Kaspersky Anti-Virus may block your ability to use the cart system. If this happens, you may need to use an alternate device (Tixty is mobile-friendly) or temporarily disable Kaspersky.') ?></small>
    </div>
</div>
</div>
