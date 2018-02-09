<?php

namespace app\controllers;

use Yii;
use app\models\AccessCode;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccessCodeController implements the CRUD actions for AccessCode model.
 */
class AccessCodeController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all AccessCode models.
     * @return mixed
     */
    public function actionIndex()
    {
		if (\Yii::$app->user->isGuest) {
			return $this->goHome();
		}
        $user = \Yii::$app->user->identity;
        if (!$user->admin && count($user->organisations) == 0) {
            return $this->redirect('/site/denied/');
        }
        $dataProvider = new ActiveDataProvider([
            'query' => AccessCode::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AccessCode model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		if (\Yii::$app->user->isGuest) {
			return $this->goHome();
		}
        $user = \Yii::$app->user->identity;
        if (!$user->admin && count($user->organisations) == 0) {
            return $this->redirect('/site/denied/');
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AccessCode model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		if (\Yii::$app->user->isGuest) {
			return $this->goHome();
		}
        $user = \Yii::$app->user->identity;
        if (!$user->admin && count($user->organisations) == 0) {
            return $this->redirect('/site/denied/');
        }
        $model = new AccessCode();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AccessCode model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		if (\Yii::$app->user->isGuest) {
			return $this->goHome();
		}
        $user = \Yii::$app->user->identity;
        if (!$user->admin && count($user->organisations) == 0) {
            return $this->redirect('/site/denied/');
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AccessCode model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		if (\Yii::$app->user->isGuest) {
			return $this->goHome();
		}
        $user = \Yii::$app->user->identity;
        if (!$user->admin && count($user->organisations) == 0) {
            return $this->redirect('/site/denied/');
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AccessCode model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AccessCode the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AccessCode::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
