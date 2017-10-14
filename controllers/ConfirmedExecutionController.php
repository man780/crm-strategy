<?php

namespace app\controllers;

use app\models\BroadcastingInternet;
use app\models\BroadcastingPress;
use app\models\BroadcastingRadio;
use app\models\BroadcastingTv;
use app\models\Event;
use app\models\Execution;
use app\models\ExecutorAuthority;
use app\models\ExecutorStaff;
use Yii;
use app\models\ConfirmedExecution;
use app\models\ConfirmedExecutionSearch;
use yii\web\Controller;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
/**
 * ConfirmedExecutionController implements the CRUD actions for ConfirmedExecution model.
 */
class ConfirmedExecutionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create', 'update', 'view', 'index', 'execution', 'card', 'delete'],
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action) {

        if(is_null(Yii::$app->user->id) || Yii::$app->user->id > 11){
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        }
        return true;
    }

    /**
     * Lists all ConfirmedExecution models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ConfirmedExecutionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ConfirmedExecution model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * $id => execution id
     * Creates a new ConfirmedExecution model.
     * If creation is successful, the browser will be redirected to the 'event/card' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        if(Yii::$app->user->id > 8){
            throw new MethodNotAllowedHttpException('Тасдиқлашга имкониятингиз йўқ!');
        }
        $model = new ConfirmedExecution();
        if (isset($_POST['Execution'])) {
            $post = Yii::$app->request->post();
//vd($post);
            $execution = Execution::findOne($id);
            $event = Event::findOne($execution->event_id);
            $model->user_id = Yii::$app->user->id;
            $model->execution_id = $id;
            $model->event_id = $event->id;
            $model->dcreated = time();
            $model->new_execution_information = trim($post['Execution']['execution_information']);
            $model->note = trim($post['ConfirmedExecution']['note']);

            $event->percentage = (int) $post['Execution']['persentage'];
            $event->status = $post['Execution']['status'];

            if($model->save() && $event->save()){
                return $this->redirect(['event/card', 'id' => $execution->id]);
            }else{
                throw new MethodNotAllowedHttpException('Тараққиёт Стратегияси марказига мурожаат қилинг!');
                vd($model->errors, false);
                vd($event->errors);
            }
        } else {
            $execution = Execution::findOne($id);
            $staff = ExecutorStaff::findOne($execution->exec_staff_id);
            $authority = ExecutorAuthority::findOne($execution->exec_id);
            $event = Event::findOne($execution->event_id);
            $broadcasting_tv = BroadcastingTv::findAll(['execution_id' => $execution->id]);
            //vd($broadcasting_tv);
            $broadcasting_radio = BroadcastingRadio::findAll(['execution_id' => $execution->id]);
            $broadcasting_press = BroadcastingPress::findAll(['execution_id' => $execution->id]);
            $broadcasting_internet = BroadcastingInternet::findAll(['execution_id' => $execution->id]);
            return $this->render('create', [
                'model' => $model,
                'execution' => $execution,
                'event' => $event,
                'staff' => $staff,
                'authority' => $authority,
                'broadcasting_tvs' => $broadcasting_tv,
                'broadcasting_radios' => $broadcasting_radio,
                'broadcasting_presss' => $broadcasting_press,
                'broadcasting_internets' => $broadcasting_internet,
            ]);
        }
    }

    /**
     * Updates an existing ConfirmedExecution model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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
     * Deletes an existing ConfirmedExecution model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ConfirmedExecution model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ConfirmedExecution the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ConfirmedExecution::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
