<?php

use app\models\Event;
use app\models\Cart;

$_event = Event::findOne(11);
$this->title = Yii::t('app', 'Player Summary');
?>
<div class="foxden-default-index">
    <h1><?= $this->title ?></h1>
    <?php
    foreach ($_event->ticketGroups as $group) {
        if (sizeof($_event->ticketGroups) > 1) {
            ?><h2><?= $group->name ?></h2><?php
        }
        foreach ($group->tickets as $ticket) {
            $cartItems = $ticket->cartItems;
            if (!$cartItems) {
                continue;
            }
            ?><h3><?= $ticket->name ?></h3><?php
            foreach ($cartItems as $row) {
                $quantity_sold = $row->quantity;
                $cart = $row->cart;
                if ($cart->status != Cart::CART_SOLD) {
                    continue;
                }
                $customer = $cart->customer;
                ?>
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <strong><?= $customer->name ?></strong>
                    </div>
                    <div class="col-md-4 col-xs-5">
                        <?= $customer->email ?>
                    </div>
                    <div class="col-md-2 col-xs-1">
                        <?= $quantity_sold ?>
                    </div>
                </div>
                <?php
            }
        }
    }
    ?>
</div>
