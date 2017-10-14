<?php

namespace app\controllers;

use app\models\MeetingGuests;
use app\models\MeetingsMeetingGuests;
use app\models\MeetingsStaff;
use app\models\Staff;
use Yii;
use app\models\Meetings;
use app\models\MeetingsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MeetingsController implements the CRUD actions for Meetings model.
 */
class MeetingsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Meetings models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MeetingsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Meetings model.
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
     * Creates a new Meetings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Meetings();

        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();
            $model->time = strtotime($post['time'])+3600*3;
            if($model->save()){
                foreach ($post['staff'] as $key => $employee){
                    $meetingStaff = new MeetingsStaff();
                    $meetingStaff->meetings_id = $model->id;
                    $meetingStaff->staff_id = $employee;
                    if (!$meetingStaff->save()){
                        vd($meetingStaff->errors);
                    }
                }
                foreach ($post['meeting_guests'] as $key => $guest){
                    $meetingGuest = new MeetingsMeetingGuests();
                    $meetingGuest->meetings_id = $model->id;
                    $meetingGuest->meeting_guests_id = $guest;
                    if (!$meetingGuest->save()){
                        vd($meetingGuest->errors);
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {
            $model->time = time();
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Meetings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $post = Yii::$app->request->post();
        if ($model->load(Yii::$app->request->post())) {
            $model->time = strtotime($post['time']);
            if($model->save()){
                $model->unlinkAll('meetingsStaff', true);
                foreach ($post['staff'] as $key => $employee){
                    $meetingStaff = new MeetingsStaff();
                    $meetingStaff->meetings_id = $model->id;
                    $meetingStaff->staff_id = $employee;
                    if (!$meetingStaff->save()){
                        vd($meetingStaff->errors);
                    }
                }
                $model->unlinkAll('meetingsMeetingGuests', true);
                foreach ($post['meeting_guests'] as $key => $guest){
                    $meetingGuest = new MeetingsMeetingGuests();
                    $meetingGuest->meetings_id = $model->id;
                    $meetingGuest->meeting_guests_id = $guest;
                    if (!$meetingGuest->save()){
                        vd($meetingGuest->errors);
                    }
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Meetings model.
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
     * Finds the Meetings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Meetings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Meetings::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
