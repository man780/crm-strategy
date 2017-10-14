<?php

namespace app\controllers;

use app\models\ExecutorStaff;
use Yii;
use app\models\ExecutorAuthority;
use app\models\ExecutorAuthoritySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExecutorAuthorityController implements the CRUD actions for ExecutorAuthority model.
 */
class ExecutorAuthorityController extends Controller
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
     * Lists all ExecutorAuthority models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExecutorAuthoritySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ExecutorAuthority model.
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
     * Creates a new ExecutorAuthority model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ExecutorAuthority();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ExecutorAuthority model.
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

    public function actionCreateStaff(){
        $authorities = ExecutorAuthority::find()->all();
        //vd($authorities->staff);
        foreach ($authorities as $authority){
            if (empty($authority->executorStaff)){
                $staff = new ExecutorStaff();
                $staff->exec_id = $authority->id;
                $staff->fio = $authority->mini_name;
                $staff->details = $authority->name;
                //vd($staff->attributes, false);
                if (!$staff->save()){
                    vd($staff->errors);
                }
                //vd($authority->attributes, false);

            }
            //vd($authority->executorStaff, false);
        }
    }

    /**
     * Deletes an existing ExecutorAuthority model.
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
     * Finds the ExecutorAuthority model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ExecutorAuthority the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ExecutorAuthority::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
