<?php
require_once('stripe/vendor/autoload.php');
$stripe = array(
	'secret_key'      => 'sk_test_cMq9z8KOc87Zr3O96pvCR2Kb',
	'publishable_key' => 'pk_test_CDUtyzNqEmQ1fE7DsLIcp9qh'
);
\Stripe\Stripe::setApiKey($stripe['secret_key']);