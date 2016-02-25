<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Organisation;
use app\models\User;

class CartController extends \yii\web\Controller {

    public function actionAdd($id) {
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

    public function actionRemove() {
        return $this->render('remove');
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
            $charge = \Stripe\Charge::create(array(
                        "amount" => floor($cart->total * 100),
                        "application_fee" => floor($cart->fees  * 100),
                        "currency" => "gbp",
                        "customer" => $customer->id,
                        "description" => $cart->quantity . ' tickets',
                        "destination" => Organisation::findOne(1)->stripe_user_id));
            $cart->status = Cart::CART_SOLD;
            $cart->save();
        } catch (\Stripe\Error\Card $e) {
            //card declined
        }

        return $this->redirect('index');
    }

}
