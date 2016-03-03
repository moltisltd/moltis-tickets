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
                <div class="col-md-3 col-xs-12">
                    <strong><?=$ticket->name?></strong>
                </div>
                <div class="col-md-5 col-xs-12">
                    <?=$ticket->description?>
                </div>
                <div class="col-md-1 col-xs-3 text-right">
                    &pound;<?=number_format($ticket->ticket_price)?>
                </div>
                <div class="col-md-3 col-xs-9 text-right">
                    <?php if ($ticket->sell_from > date('Y-m-d H:i:s')) : ?>
                    Available from <?=date('d/m/y H:i', strtotime($ticket->sell_from));?>
                    <?php elseif($ticket->sell_until < date('Y-m-d H:i:s')) : ?>
                    No longer available
                    <?php elseif (Yii::$app->user->isGuest) : ?>
                    <a href="<?= \yii\helpers\Url::to('site/login')?>" class="btn btn-success">Login</a>
                    <?php elseif ($group_sold_out || ($ticket->ticket_limit > 0 && $sold_count[$ticket->id] >= $ticket->ticket_limit)) : ?>
                    Sold out
                    <?php else : ?>
                    <form class="form-inline" style="display:inline-block" action="<?= \yii\helpers\Url::to('cart/add')?>" method="GET">
                        <?php if ($ticket->requires_access_code) : ?>
                        <input class="form-control input-sm" type="text" name="access_code" placeholder="<?=Yii::t('app', 'Access Code')?>">
                        <?php endif; ?>
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
