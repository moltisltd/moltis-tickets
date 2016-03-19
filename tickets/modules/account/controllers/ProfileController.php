<?php

namespace app\modules\account\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;

class ProfileController extends Controller {

    /**
     * Displays a single User model.
     * @return mixed
     */
    public function actionIndex() {
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $user = \Yii::$app->user->identity;
        $id = $user->getId();
        $model = $this->findModel($id);
        return $this->render('index', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionUpdate() {
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $user = \Yii::$app->user->identity;
        $id = $user->getId();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
