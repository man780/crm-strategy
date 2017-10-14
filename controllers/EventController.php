<?php

namespace app\controllers;

use app\models\BroadcastingTv;
use app\models\BroadcastingRadio;
use app\models\BroadcastingPress;
use app\models\BroadcastingInternet;
use app\models\EventExecutorAuthority;
use app\models\Execution;
use app\models\ExecutorAuthority;
use app\models\ExecutorStaff;
use app\models\Financing;
use app\models\Internet;
use app\models\Press;
use app\models\Radio;
use app\models\Tv;
use Yii;
use app\models\Event;
use app\models\EventSearch;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\db\Query;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends Controller
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

        if (is_null(Yii::$app->user->id)){
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        }
        if(Yii::$app->user->id > 11){
            if($action->id == 'view' || $action->id == 'execution' || $action->id == 'card'){
                return true;
            }
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        }
        return true;
    }

    /**
     * Lists all Event models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Event model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $flag = false;
        foreach ($model->executorAuthorities as $executorAuthority){
            foreach ($executorAuthority->executorStaff as $staff){
                if($staff->user_id == Yii::$app->user->id)$flag = true;
            }
        }
        if(Yii::$app->user->id <= 11)$flag = true;

        if($flag){
            /*$query = new Query;
            $query->select(['{{%event_executor_authority}}.executor_authority_id', '{{%executor_authority}}.name', '{{%event_executor_authority}}.sequence_exec'])
                ->from('{{%event}}')
                ->leftJoin('{{%event_executor_authority}}', '{{%event}}.`id` = {{%event_executor_authority}}.`event_id`')
                ->leftJoin('{{%executor_authority}}', '{{%event_executor_authority}}.`event_id` = {{%executor_authority}}.`id`')
                ->where(['{{%event}}.id'=>$id]);
            ///vd($query->query);
            $executors = $query->all();*/
            //vd($executors);
            return $this->render('view', [
                'model' => $model,
                //'executors' => $executors,
            ]);
        }else{;
            return $this->redirect(['/']);
        }

    }

    /**
     * Displays a single Event model.
     * @param integer $id
     * @return mixed
     */
    public function actionExecution($id)
    {
        $event = $this->findModel($id);
        //vd(Yii::$app->user->identity);
        $post = Yii::$app->request->post();
        if(isset($_POST['Execution'])){
            $execution_post = $_POST['Execution'];
            $financing_post = $_POST['Financing'];
            $execution = new Execution();
            $execution->exec_id = \Yii::$app->session->get('user.authority_id');
            $execution->exec_staff_id = \Yii::$app->session->get('user.staff_id');
            $execution->event_id = $id;
            $execution->direction_id = $event->direction_id;
            $execution->sub_dir_id = $event->sub_dir_id;
            $execution->persentage = $execution_post['persentage'];
            $execution->actual_mastering_finance = $financing_post['actual_mastering_finance'];
            $execution->timely_financial_security = $financing_post['timely_financial_security'];
            $execution->execution_information = $execution_post['execution_information'];
            $execution->factors_preventing_implementation = $execution_post['factors_preventing_implementation'];
            $execution->bycreated = Yii::$app->user->id;
            $execution->dcreated = time();
            //vd([$execution, $post]);
            if($execution->save()){
                $execution_id = $execution->id;
                if(isset($post['Broadcasting_tv']) && trim($post['Broadcasting_tv']) != ''){
                    $tvArr = json_decode($post['Broadcasting_tv']);
                    foreach ($tvArr as $tv){
                        $broadcasting_tv = new BroadcastingTv();
                        $broadcasting_tv->event_id = $id;
                        $broadcasting_tv->execution_id = $execution_id;
                        $broadcasting_tv->date = strtotime($tv[0]);
                        $broadcasting_tv->title = $tv[1];
                        $broadcasting_tv->tv_id = $tv[2];
                        if(!$broadcasting_tv->save()){
                            vd($broadcasting_tv->errors);
                        }
                    }
                }
                if(isset($post['Broadcasting_radio']) && trim($post['Broadcasting_radio']) != ''){
                    $radioArr = json_decode($post['Broadcasting_radio']);
                    foreach ($radioArr as $radio){
                        $broadcasting_radio = new BroadcastingRadio();
                        $broadcasting_radio->event_id = $id;
                        $broadcasting_radio->execution_id = $execution_id;
                        $broadcasting_radio->date = strtotime($radio[0]);
                        $broadcasting_radio->title = $radio[1];
                        $broadcasting_radio->radio_id = $radio[2];
                        if(!$broadcasting_radio->save()){
                            vd($broadcasting_radio->errors);
                        }
                    }
                }
                if(isset($post['Broadcasting_press']) && trim($post['Broadcasting_press']) != ''){
                    $pressArr = json_decode($post['Broadcasting_press']);
                    foreach ($pressArr as $press){
                        $broadcasting_press = new BroadcastingPress();
                        $broadcasting_press->event_id = $id;
                        $broadcasting_press->execution_id = $execution_id;
                        $broadcasting_press->date = strtotime($press[0]);
                        $broadcasting_press->num = $press[1];
                        $broadcasting_press->title = $press[2];
                        $broadcasting_press->press_id = $press[3];
                        if(!$broadcasting_press->save()){
                            vd($broadcasting_press->errors);
                        }
                    }
                }
                if(isset($post['Broadcasting_internet']) && trim($post['Broadcasting_internet']) != ''){
                    $internetArr = json_decode($post['Broadcasting_internet']);
                    foreach ($internetArr as $internet){
                        $broadcasting_internet = new BroadcastingInternet();
                        $broadcasting_internet->event_id = $id;
                        $broadcasting_internet->execution_id = $execution_id;
                        $broadcasting_internet->date = strtotime($internet[0]);
                        $broadcasting_internet->link = $internet[1];
                        $broadcasting_internet->title = $internet[2];
                        $broadcasting_internet->internet_id = $internet[3];
                        if(!$broadcasting_internet->save()){
                            vd($broadcasting_internet->errors);
                        }
                    }
                }
                return $this->redirect(['card', 'id' => $execution_id]);
            }else{
                echo '<b>Хатолик содир бўлди: </b>Тараққиёт Стратегияси марказига мурожаат қлинг!<br>';
                vd($execution->errors);
            }
        }else{
            $tvArr = ArrayHelper::map(Tv::find()->asArray()->all(), 'id','name');
            $radioArr = ArrayHelper::map(Radio::find()->asArray()->all(), 'id','name');
            $pressArr = ArrayHelper::map(Press::find()->asArray()->all(), 'id','name');
            $internetArr = ArrayHelper::map(Internet::find()->asArray()->all(), 'id','name');
            //vd($tvs);
            $staff = ExecutorStaff::findOne(\Yii::$app->session->get('user.staff_id'));
            $authority = ExecutorAuthority::findOne(\Yii::$app->session->get('user.authority_id'));
            return $this->render('execution', [
                'model' => $event,
                'staff' => $staff,
                'authority' => $authority,
                'tvs' => $tvArr,
                'radios' => $radioArr,
                'presss' => $pressArr,
                'internets' => $internetArr,
                //'financing' => $financing,
            ]);
        }

    }
    
    /**
     * Displays a single Event model.
     * @param integer $id
     * @return mixed
     */
    public function actionCard($id)
    {
        $execution = Execution::findOne($id);
        $staff = ExecutorStaff::findOne($execution->exec_staff_id);
        $authority = ExecutorAuthority::findOne($execution->exec_id);
        $event = Event::findOne($execution->event_id);
        $broadcasting_tv = BroadcastingTv::findAll(['execution_id' => $id]);
        $broadcasting_radio = BroadcastingRadio::findAll(['execution_id' => $id]);
        $broadcasting_press = BroadcastingPress::findAll(['execution_id' => $id]);
        $broadcasting_internet = BroadcastingInternet::findAll(['execution_id' => $id]);

        //----------------------------todo------------------------
        if(Yii::$app->user->id >= 4 && Yii::$app->user->id <= 8){
            $execution->seen = (is_null($execution->seen))?1:$execution->seen++;
            $execution->save();
        }
        
        return $this->render('card', [
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

    /**
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Event();

        if ($model->load(Yii::$app->request->post())) {
            if($model->deadline){
                $model->deadline = strtotime($model->deadline);
            }else{
                $model->deadline = null;
            }
            if($model->save())
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Event model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();
            if(isset($post['Event']['deadline'])){
                $model->deadline = strtotime($post['Event']['deadline']);
            }elseif(isset($post['Event']['deadline_other'])){
                $model->deadline_other = $post['Event']['deadline_other'];
            }

            if($model->save()){
                $model->unlinkAll('executorAuthorities', true);
                foreach ($post['executorAuthorities'] as $key => $pExec){
                    $eventExec = ExecutorAuthority::findOne($pExec);
                    $model->link('executorAuthorities', $eventExec, ['sequence_exec' => $key]);
                }

                if(isset($post['sourceFinancing'])){
                    $financings = $model->financings;
                    foreach ($financings as $financing){
                        $fin = Financing::findOne(['id' => $financing->id]);
                        $fin->delete();
                    }
                    foreach ($post['sourceFinancing'] as $key => $sourceFinancing){
                        if($sourceFinancing != ''){
                            $financing = new Financing();
                            $financing->event_id = $id;
                            $financing->sf_id = $sourceFinancing;
                            $financing->amount = $post['amount'][$key];
                            $financing->currency = $post['currency'][$key];
                            //print_r($financing->attributes); die;
                            if(!$financing->save()){
                                print_r($financing->errors);
                            }
                        }
                    }
                }
                /*foreach ($post['executorAuthorities'] as $key=>$execAuth) {
                    $eventExec = new  EventExecutorAuthority();
                    $eventExec->event_id = $model->id;
                    $eventExec->executor_authority_id = intval($execAuth[$key]);
                    $eventExec->sequence_exec = $key;
                    $eventExec->created_at = time();
                    //vd($eventExec);
                    //echo $execAuth[$key];
                    Yii::$app->db->createCommand()
                        ->insert('{{%event_executor_authority}}', [
                            'event_id' => $model->id,
                            'executor_authority_id' => intval($execAuth[$key]),
                            'main_exec' => $key,
                        ])->execute();
                    //vd($eventExec->attributes, false);
                    //$eventExec->save();
                    if(!$eventExec->save()){
                        //vd($post, false);
                        vd($eventExec->attributes, false);
                    }
                }*/
                
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            //$executors = $model->getExecutorAuthorities();
            //print_r($executors); die;
            $query = new Query;
            $query->select(['{{%event_executor_authority}}.executor_authority_id', '{{%executor_authority}}.name', '{{%event_executor_authority}}.sequence_exec'])
                ->from('{{%event}}')
                ->leftJoin('{{%event_executor_authority}}', '{{%event}}.`id` = {{%event_executor_authority}}.`event_id`')
                ->leftJoin('{{%executor_authority}}', '{{%event_executor_authority}}.`event_id` = {{%executor_authority}}.`id`')
                ->where(['{{%event}}.id'=>$id]);
            $executors = $query->all();
            $financing = Financing::findAll(['event_id' => $id]);
            //print_r($financing);
            return $this->render('update', [
                'model' => $model,
                'executors' => $executors,
                'financing' => $financing,
            ]);
        }
    }

    /**
     * Deletes an existing Event model.
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
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
