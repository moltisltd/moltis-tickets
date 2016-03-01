<?php

use app\models\Event;
use app\models\Cart;
use yii\helpers\Url;
/* @var $this yii\web\View */

$_event = Event::findOne(1);

$this->title = $_event->owner->name . ' - ' . $_event->name;
?>
<div class="site-index">

        <h1><?=$this->title;?></h1>

        <p><?=$_event->description?></p>

    <div class="body-content">
        <?php if (Yii::$app->user->isGuest) : ?>
        <p>
            If you're not registered, do so now or login:
            <a href="<?= Url::to('/user/create')?>" class="btn btn-warning">Register</a>
            <a href="<?= Url::to('/site/login')?>" class="btn btn-success">Login</a>
        </p>
        <?php else : ?>
        <p>You're logged in! Add tickets to <a href="<?= Url::to('/cart')?>">your cart</a>!</p>
        <?php endif; ?>
        
        <?php
        foreach ($_event->ticketGroups as $group) {
            if (sizeof($_event->ticketGroups) > 1) {
                ?><h2><?=$group->name?></h2><?php
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
                <div class="col-lg-3">
                    <strong><?=$ticket->name?></strong>
                </div>
                <div class="col-lg-6">
                    <?=$ticket->description?>
                </div>
                <div class="col-lg-3 text-right">
                    &pound;<?=number_format($ticket->ticket_price)?>
                    <?php if (Yii::$app->user->isGuest) : ?>
                    <a href="<?= \yii\helpers\Url::to('site/login')?>" class="btn btn-success">Login</a>
                    <?php elseif ($group_sold_out || ($ticket->ticket_limit > 0 && $sold_count[$ticket->id] >= $ticket->ticket_limit)) : ?>
                    Sold out
                    <?php else : ?>
                    <form style="display:inline-block" action="<?= \yii\helpers\Url::to('cart/add')?>" method="GET">
                        <input type="hidden" name="id" value="<?=$ticket->id?>">
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
        </div>

    </div>
</div>
