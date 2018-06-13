<?php

use app\models\Event;
use app\models\Cart;

$_event = Event::findOne(10);

$carts = Cart::findAll(['status' => Cart::CART_SOLD]);
$sold_tickets = [];
foreach ($carts as $cart) {
    $items = $cart->items;
    foreach ($items as $i) {
        if (!isset($sold_tickets[$i->ticket_id])) {
            $sold_tickets[$i->ticket_id] = 0;
        }
        $sold_tickets[$i->ticket_id] += $i->quantity;
    }
}
$sold_total = 0;
$total_tickets_sold = 0;
$this->title = Yii::t('app', 'Event Summary');
?>
<div class="foxden-default-index">
    <h1><?= $this->title ?></h1>
    <?php
    foreach ($_event->ticketGroups as $group) {
        if (sizeof($_event->ticketGroups) > 1) {
            ?><h2><?= $group->name ?></h2><?php
        }
        foreach ($group->tickets as $ticket) {
            $quantity_sold = isset($sold_tickets[$ticket->id]) ? $sold_tickets[$ticket->id] : 0;
            $total_tickets_sold += $quantity_sold;
            $sold_total += $quantity_sold * ($ticket->ticket_price - $ticket->ticket_fee);
            ?>
            <div class="row">
                <div class="col-md-8 col-xs-6">
                    <strong><?= $ticket->name ?></strong>
                </div>
                <div class="col-md-2 col-xs-1">
                    <?= $quantity_sold ?>
                </div>
                <div class="col-md-2 col-xs-5 text-right">
                    <?= Yii::$app->formatter->asCurrency($ticket->ticket_price - $ticket->ticket_fee) ?>
                </div>
            </div>
            <?php
        }
    }
    ?>
    <h2><?= Yii::t('app', 'Total') ?></h2>
    <div class="row">
        <div class="col-md-8 col-xs-6">
            <strong><?= Yii::t('app', 'Sales Total') ?></strong>
        </div>
        <div class="col-md-2 col-xs-1">
            <?= $total_tickets_sold ?>
        </div>
        <div class="col-md-2 col-xs-5 text-right">
            <?= Yii::$app->formatter->asCurrency($sold_total) ?>
        </div>
    </div>
</div>
