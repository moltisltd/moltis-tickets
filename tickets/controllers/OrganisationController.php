<?php

namespace app\controllers;

use Yii;
use app\models\Organisation;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrganisationController implements the CRUD actions for Organisation model.
 */
class OrganisationController extends Controller {

    public function behaviors() {
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
     * Lists all Organisation models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Organisation::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Organisation model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Organisation model.
     * @param string $id
     * @return mixed
     */
    public function actionConnect($code, $state) {
        $sql = "SELECT * FROM organisation WHERE SHA1(CONCAT(`id`, :salt, `name`)) = :state";
        $organisation = Organisation::findBySql($sql, [':salt' => 'jiejieugs9837', ':state' => $state])->one();
        if (!empty($code)) {
            $token_request_body = array(
                'grant_type' => 'authorization_code',
                'client_id' => Yii::$app->params['stripeClientID'],
                'code' => $code,
                'client_secret' => Yii::$app->params['stripeSecretKey'],
            );
            $req = curl_init('https://connect.stripe.com/oauth/token');
            curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($req, CURLOPT_POST, true);
            curl_setopt($req, CURLOPT_POSTFIELDS, http_build_query($token_request_body));
            curl_setopt($req, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($req, CURLOPT_CAINFO, "E:\doc\moltis-tickets\cacert.pem");
            $respCode = curl_getinfo($req, CURLINFO_HTTP_CODE);
            $resp = json_decode(curl_exec($req), true);
            curl_close($req);

            $organisation = $this->findModel($organisation->id);
            $organisation->stripe_access_token = $resp['access_token'];
            $organisation->stripe_public_key = $resp['stripe_publishable_key'];
            $organisation->stripe_user_id = $resp['stripe_user_id'];
            $organisation->stripe_refresh_token = $resp['refresh_token'];
            $organisation->save();
        }
        return $this->render('connect', [
                    'model' => $organisation,
        ]);
    }

    /**
     * Creates a new Organisation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Organisation();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Organisation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
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
     * Deletes an existing Organisation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Organisation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Organisation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Organisation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
