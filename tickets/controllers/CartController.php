<?php

namespace app\controllers;

use app\models\Cart;
use app\models\User;
use app\models\Ticket;
use app\models\Email;
use app\models\Session;

class CartController extends \yii\web\Controller {

    public function actionAdd($id, $access_code = null) {
        $session = new Session();
        if (!($ticket = Ticket::findOne($id))) {
            $session->addError('Ticket does not exist');
            return $this->redirect('index');
        }
        if ($ticket->requires_access_code && (count($ticket->accessCodes) == 0 || $access_code == null)) {
            $session->addError('Access code required');
            return $this->redirect('index');
        } else if ($ticket->requires_access_code) {
            $code_match = false;
            foreach ($ticket->accessCodes as $code) {
                if ($code->access_code == $access_code) {
                    $code_match = true;
                    break;
                }
            }
            if (!$code_match) {
                $session->addError('Valid access code required');
                return $this->redirect('index');
            }
        }
        $cart = Cart::getCurrentCart();
        $cart->addItem($id);
        return $this->redirect('index');
    }

    public function actionIndex() {
        \Stripe\Stripe::setApiKey(\Yii::$app->params['stripeSecretKey']);
        $cart = Cart::getCurrentCart();
        return $this->render('index', [
                    'cart' => $cart,
        ]);
    }

    public function actionRemove($id) {
        $cart = Cart::getCurrentCart();
        $cart->removeItem($id);
        return $this->redirect('index');
    }

    public function actionReduce($id) {
        $cart = Cart::getCurrentCart();
        $cart->reduceItem($id);
        return $this->redirect('index');
    }

    public function actionCharge() {
        \Stripe\Stripe::setApiKey(\Yii::$app->params['stripeSecretKey']);
        $get = \Yii::$app->request->get();
        $token = $get['stripeToken'];
        $email = $get['stripeEmail'];
        $user = User::findByEmail($email);
        $customer = \Stripe\Customer::create(array(
                    "source" => $token,
                    "description" => $email,
                    "email" => $email)
        );
        if ($user->customer_token != $customer->id) {
            $user->customer_token = $customer->id;
            $user->save();
        }

        $cart = Cart::getCurrentCart();
        $cart->processCart();
        try {
            $stripe_user_id = $cart->items[0]->ticket->group->event->owner->stripe_user_id;
            if ($stripe_user_id) {
                $charge = \Stripe\Charge::create(array(
                            "amount" => floor($cart->total * 100),
                            "application_fee" => floor($cart->fees * 100),
                            "currency" => "gbp",
                            "customer" => $customer->id,
                            "description" => $cart->quantity . ' tickets',
                            "destination" => $stripe_user_id));
                $cart->status = Cart::CART_SOLD;
                $cart->save();

                $cart_lines = [];
                foreach ($cart->items as $item) {
                    $cart_lines[] = $item->ticket->group->event->name . ': ' . $item->ticket->name . ' x' . $item->quantity . ' @ ' . $item->ticket->ticket_price . ' each';
                }
                $cart_lines[] = 'Card fees @ ' . $cart->stripe_fee;
                $cart_details = implode("\n", $cart_lines);

                $email = new Email();
                $email->to_name = $user->name;
                $email->to_email = $user->email;
                $email->subject = "Your Tixty Purchase";
                $message = <<<EOT
Hi {$user->name}!!

You just bought {$cart->quantity} tickets for a total of {$cart->total} - details below.

Thanks,

Tixty

---
{$cart_details}
EOT;
                $email->body = nl2br($message);
                $email->save();
                $email->send();

                $email = new Email();
                $email->to_name = "Tixty";
                $email->to_email = \Yii::$app->params['adminEmail'];
                $email->subject = "Tixty Purchase #{$cart->id}";
                $message = <<<EOT
{$user->name} just bought {$cart->quantity} tickets for a total of {$cart->total} - details below.

Tixty

---
{$cart_details}
EOT;
                $email->body = nl2br($message);
                $email->save();
                $email->send();
            }
        } catch (\Stripe\Error\Card $e) {
            //card declined
        }

        return $this->redirect('index');
    }

}
