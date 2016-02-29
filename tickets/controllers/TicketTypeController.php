<?php

namespace app\controllers;

use Yii;
use app\models\TicketType;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TicketTypeController implements the CRUD actions for TicketType model.
 */
class TicketTypeController extends Controller
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
     * Lists all TicketType models.
     * @return mixed
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
        $dataProvider = new ActiveDataProvider([
            'query' => TicketType::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TicketType model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (\Yii::$app->user->isGuest) {
            return $this->redirect('/site/denied/');
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
     * Creates a new TicketType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (\Yii::$app->user->isGuest) {
            return $this->redirect('/site/denied/');
        }
        $user = \Yii::$app->user->identity;
        if (!$user->admin && count($user->organisations) == 0) {
            return $this->redirect('/site/denied/');
        }
        $model = new TicketType();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TicketType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (\Yii::$app->user->isGuest) {
            return $this->redirect('/site/denied/');
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
     * Deletes an existing TicketType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (\Yii::$app->user->isGuest) {
            return $this->redirect('/site/denied/');
        }
        $user = \Yii::$app->user->identity;
        if (!$user->admin && count($user->organisations) == 0) {
            return $this->redirect('/site/denied/');
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TicketType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TicketType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (\Yii::$app->user->isGuest) {
            return $this->redirect('/site/denied/');
        }
        $user = \Yii::$app->user->identity;
        if (!$user->admin && count($user->organisations) == 0) {
            return $this->redirect('/site/denied/');
        }
        if (($model = TicketType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
