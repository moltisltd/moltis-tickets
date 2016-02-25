<?php

namespace app\controllers;

use Yii;
use app\models\OrganisationMembers;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrganisationMembersController implements the CRUD actions for OrganisationMembers model.
 */
class OrganisationMembersController extends Controller
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
     * Lists all OrganisationMembers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => OrganisationMembers::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrganisationMembers model.
     * @param integer $organisation_id
     * @param integer $user_id
     * @return mixed
     */
    public function actionView($organisation_id, $user_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($organisation_id, $user_id),
        ]);
    }

    /**
     * Creates a new OrganisationMembers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OrganisationMembers();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'organisation_id' => $model->organisation_id, 'user_id' => $model->user_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing OrganisationMembers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $organisation_id
     * @param integer $user_id
     * @return mixed
     */
    public function actionUpdate($organisation_id, $user_id)
    {
        $model = $this->findModel($organisation_id, $user_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'organisation_id' => $model->organisation_id, 'user_id' => $model->user_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing OrganisationMembers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $organisation_id
     * @param integer $user_id
     * @return mixed
     */
    public function actionDelete($organisation_id, $user_id)
    {
        $this->findModel($organisation_id, $user_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the OrganisationMembers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $organisation_id
     * @param integer $user_id
     * @return OrganisationMembers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($organisation_id, $user_id)
    {
        if (($model = OrganisationMembers::findOne(['organisation_id' => $organisation_id, 'user_id' => $user_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
