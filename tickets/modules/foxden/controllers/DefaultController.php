<?php

namespace app\modules\foxden\controllers;

use Yii;
use yii\web\Controller;

/**
 * Default controller for the `foxden` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->isGuest) {
            return $this->redirect('/site/denied/');
        }
        $user = \Yii::$app->user->identity;
        if (!$user->admin && count($user->organisations) == 0) {
            return $this->redirect('/site/denied/');
        }
        
        return $this->render('index');
    }
    public function actionPlayers()
    {
        if (\Yii::$app->user->isGuest) {
            return $this->redirect('/site/denied/');
        }
        $user = \Yii::$app->user->identity;
        if (!$user->admin && count($user->organisations) == 0) {
            return $this->redirect('/site/denied/');
        }
        
        return $this->render('players');
    }
}
