<h3>Player Ticket - &pound;70</h3>
<form action="charge.php" method="POST">
	<input type="hidden" name="ticket_type" value="player_ticket" />
    <? if (isset($stripe_customer) AND $stripe_customer) : ?>
        <input type="hidden" name="customer_id" value="<?php echo $stripe_customer->id ?>" />
    <? else : ?>
	<input type="password" name="password" placeholder="Password" />
    <? endif; ?>
	<script
	src="https://checkout.stripe.com/checkout.js" class="stripe-button"
	data-key="<?php echo $stripe['publishable_key']; ?>"
	data-description="One Player Ticket"
	data-amount="7000"
    data-currency="gbp">
	</script>
</form>
<h3>Crew Ticket - &pound;17</h3>
<form action="charge.php" method="POST">
	<input type="hidden" name="ticket_type" value="crew_ticket" />
    <? if (isset($stripe_customer) AND $stripe_customer) : ?>
        <input type="hidden" name="customer_id" value="<?php echo $stripe_customer->id ?>" />
    <? else : ?>
	<input type="password" name="password" placeholder="Password" />
    <? endif; ?>
	<script
	src="https://checkout.stripe.com/checkout.js" class="stripe-button"
	data-key="<?php echo $stripe['publishable_key']; ?>"
	data-description="One Crew Ticket"
	data-amount="1700"
    data-currency="gbp">
	</script>
</form>
<hr />
<?php 
if (!isset($stripe_customer) OR !$stripe_customer) {
    require_once('./login_form.php');
}
