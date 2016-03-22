<?php

namespace app\modules\account\controllers;

use app\models\User;
use app\models\Cart;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class OrdersController extends Controller {

    public function actionIndex() {
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $user = \Yii::$app->user->identity;
        $user = User::findOne($user->getId());
        $query = $user->getCarts();
        $query->where(['status' => [Cart::CART_SOLD, Cart::CART_REFUNDED]]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id = null) {
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if (($model = $this->findModel($id))) {
            return $this->render('view', [
                        'model' => $model,
            ]);
        } else {
            return $this->redirect('/site/denied/');
        }
    }

    /**
     * Finds the Cart model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cart the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        $where = ['id' => $id, 'status' => [Cart::CART_SOLD, Cart::CART_REFUNDED]];
        $user = \Yii::$app->user->identity;
        if (!$user->admin) {
            $where['customer_id'] = $user->getId();
        }
        return Cart::findOne($where);
    }

}
