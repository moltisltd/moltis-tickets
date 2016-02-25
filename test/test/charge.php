<?php
require_once('./header.php');
require_once('./db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $error = false;

  try {

    if (isset($_POST['customer_id'])) {
      $charge = \Stripe\Charge::create(array(
        'customer'    => $_POST['customer_id'],
        'amount'      => 53500,
        'currency'    => 'usd',
        'description' => 'Single quote purchase after login'));
    }
    else if (isset($_POST['stripeToken'])) {
      // Simple uniqueness check on the email address
      $existing_customer = get_customer($_POST['stripeEmail']);

      if ($existing_customer) {
        throw new Exception("That e-mail address already exists");
      }

      if (isset($_POST['ticket_type'])) {
        $customer = \Stripe\Customer::create(array(
          'source'     => $_POST['stripeToken'],
          'email'    => $_POST['stripeEmail']
          ));
        if ($_POST['ticket_type'] == 'player_ticket') {
            $charge = \Stripe\Charge::create(array(
              'customer'    => $customer->id,
              'amount'      => 7000,
              'currency'    => 'gbp',
              'description' => 'Player Ticket'));
        } else {
            $charge = \Stripe\Charge::create(array(
              'customer'    => $customer->id,
              'amount'      => 1700,
              'currency'    => 'gbp',
              'description' => 'Crew Ticket'));
        }
      } else {
          throw new Exception("No ticket type supplied");
      }
      create_customer($_POST['stripeEmail'], $_POST['password'], $customer->id);

    }
    else {
      throw new Exception("The Stripe Token or customer was not generated correctly");
    }
  }
  catch (Exception $e) {
    $error = $e->getMessage();
  }

  if (!$error) {
    if ($_POST['ticket_type'] == 'player_ticket') {
        echo "<h3>You're signed up as a player</h3>";
    } else {
        echo "<h3>You're signed up as crew</h3>";
    }
  }
  else {
    echo "<div class=\"error\">".$error."</div>";
    require_once('./payment_form.php');
  }
}
require_once('./footer.php');