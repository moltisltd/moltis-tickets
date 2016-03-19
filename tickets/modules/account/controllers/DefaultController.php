<?php

namespace app\modules\account\controllers;

use yii\web\Controller;

class DefaultController extends Controller {

    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionProfile() {
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $user = \Yii::$app->user->identity;
        $id = $user->getId();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('profile', [
                        'model' => $model,
            ]);
        }
    }

}
