<?php

namespace app\controllers;

use app\models\Direction;
use app\models\Event;
use app\models\EventSearch;
use app\models\ExecutorAuthority;
use app\models\ExecutorStaff;
use app\models\FindForm;
use app\models\SubDirection;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Login;
use app\models\Signup;
use yii\filters\RateLimiter;
//use IpLimiter;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],

            'rateLimiter' => [
                'class' => RateLimiter::className(),
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionFilter(){
        $post = Yii::$app->request->post();
        
        if(isset($post['Filter'])){
            $direction_id = $post['Filter']['direction'];

            $query = Event::find();
            $query->joinWith('executorAuthorities');
            $query->orderBy('id');

            if(isset($post['Filter']['from_date']) && isset($post['Filter']['to_date'])){
                $from_date = strtotime($post['Filter']['from_date']);
                $to_date = strtotime($post['Filter']['to_date']);
                $query->orWhere(['BETWEEN', 'deadline', $from_date, $to_date]);
            }

            $deadline_other = ['checked' => true];
            if(isset($post['Filter']['deadline_other'])){
                $query->orWhere(['deadline' => null]);
            }else{
                $deadline_other = null;
            }

            $first_executor = null;
            if(isset($post['Filter']['first_executor'])){
                $query->andWhere(['sequence_exec' => 0]);
                $first_executor = ['checked' => true];
            }

            if($post['Filter']['direction'] != ''){
                $query->andWhere(['=', 'direction_id', $direction_id]);
            }

            $selectedAuthorities = null;
            if(isset($post['Filter']['authority'])){
                $selectedAuthorities = $post['Filter']['authority'];
                $query->andWhere(['IN', 'executor_authority_id', $post['Filter']['authority']]);
            }

            $events = $query->all();

            $directions = Direction::find()->asArray()->all();
            $directions2 = new Direction();
            $sub_directions = SubDirection::find()->asArray()->all();

            $dirArr = [];
            foreach ($directions as $direction){
                $dirArr[$direction['id']] = $direction['title'];
            }
            $sub_dirArr = [];
            foreach ($sub_directions as $sub_direction){
                $sub_dirArr[$sub_direction['id']] = $sub_direction['title'];
            }
            $dArr = [];
            $sdArr = [];
            if (!is_null($events))
                foreach ($events as $event){
                    if(!in_array($event['direction_id'], $dArr)){
                        $dArr[] = $event['direction_id'];
                    }
                    if(!in_array($event['sub_dir_id'], $sdArr)){
                        $sdArr[] = $event['sub_dir_id'];
                    }
                }

            $authorities = new ExecutorAuthority();
            $data = $authorities->getAutoritiesMap();
            return $this->render('filter', [
                'selectedDir' => $direction_id,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'deadline_other' => $deadline_other,
                'first_executor' => $first_executor,
                'selectedAuthorities' => $selectedAuthorities,
                'directionsMap' => $directions2->getDirectionsMap(),
                'directions' => $directions,
                'dArr' => $dArr,
                'sub_directions' => $sub_directions,
                'sdArr' => $sdArr,
                'events' => $events,
                'authorities' => $data,
            ]);
        }else{
            
            $events = Event::find()->all();
            $directions = Direction::find()->asArray()->all();
            $directions2 = new Direction();
            $sub_directions = SubDirection::find()->asArray()->all();

            $dirArr = [];
            foreach ($directions as $direction){
                $dirArr[$direction['id']] = $direction['title'];
            }
            $sub_dirArr = [];
            foreach ($sub_directions as $sub_direction){
                $sub_dirArr[$sub_direction['id']] = $sub_direction['title'];
            }
            $dArr = [];
            $sdArr = [];
            if (!is_null($events))
                foreach ($events as $event){
                    if(!in_array($event['direction_id'], $dArr)){
                        $dArr[] = $event['direction_id'];
                    }
                    if(!in_array($event['sub_dir_id'], $sdArr)){
                        $sdArr[] = $event['sub_dir_id'];
                    }
                }

            $authorities = new ExecutorAuthority();
            $data = $authorities->getAutoritiesMap();
            return $this->render('filter', [
                'selectedDir' => null,
                'from_date' => '01.01.2017',
                'to_date' => date('d.m.Y'),
                'directionsMap' => $directions2->getDirectionsMap(),
                'directions' => $directions,
                'dArr' => $dArr,
                'sub_directions' => $sub_directions,
                'sdArr' => $sdArr,
                'events' => $events,
                'authorities' => $data,
            ]);
        }

    }

    public function actionIndex()
    {

        $authority_id = \Yii::$app->session->get('user.authority_id');
        $authority = ExecutorAuthority::findOne($authority_id);
        if(\Yii::$app->user->id > 11){
            $events = $authority->events;
        }else{
            $events = Event::find()->all();
        }
        $directions = Direction::find()->asArray()->all();
        $sub_directions = SubDirection::find()->asArray()->all();

        $dirArr = [];
        foreach ($directions as $direction){
            $dirArr[$direction['id']] = $direction['title'];
        }
        $sub_dirArr = [];
        foreach ($sub_directions as $sub_direction){
            $sub_dirArr[$sub_direction['id']] = $sub_direction['title'];
        }
        $dArr = [];
        $sdArr = [];
        if (!is_null($events))
        foreach ($events as $event){
            if(!in_array($event['direction_id'], $dArr)){
                $dArr[] = $event['direction_id'];
            }
            if(!in_array($event['sub_dir_id'], $sdArr)){
                $sdArr[] = $event['sub_dir_id'];
            }
        }

        return $this->render('index', [
            'directions' => $directions,
            'dArr' => $dArr,
            'sub_directions' => $sub_directions,
            'sdArr' => $sdArr,
            'events' => $events,
            'authority' => $authority,
        ]);
    }

    public function actionLogout()
    {
        if(!Yii::$app->user->isGuest)
        {
            Yii::$app->user->logout();
            return $this->redirect(['login']);
        }
    }

    public function actionSignup()
    {
        $model = new Signup();
        if(isset($_POST['Signup']))
        {
            $model->attributes = Yii::$app->request->post('Signup');
            if($model->validate() && $model->signup())
            {
                return $this->redirect(['index']);
            }
        }
        return $this->render('signup',['model'=>$model]);
    }
    //1. Проверить существует ли пользователь?
    //2. "Внести" пользователя в систему(в сессию)
    public function actionLogin()
    {
        if(!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }
        $login_model = new Login();
        if( Yii::$app->request->post('Login'))
        {
            $login_model->attributes = Yii::$app->request->post('Login');
            if($login_model->validate())
            {
                Yii::$app->user->login($login_model->getUser());
                return $this->goHome();
            }
        }
        return $this->render('login',['login_model'=>$login_model]);
    }

    /*public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }*/

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionFind()
    {
        $model = new FindForm();
        $post = Yii::$app->request->post('FindForm');
        if ($model->load(Yii::$app->request->post())/* && $model->contact()*/) {
            $model->ingredients = $post['ing_id'];
            $ing_ids = join(',', $post['ing_id']);
            $count = count($post['ing_id']);
            if($count<2){
                Yii::$app->session->setFlash('less2', 'Выберти минимум 2 ингридиента!');
                return $this->refresh();
            }

            $sql = "SELECT di.dish_id, d.dishname,
                        GROUP_CONCAT(i.ingname SEPARATOR '</span><span class=\"badge\">') AS ings,
                        COUNT(di.ing_id) AS ing_count
                    FROM {{%dishes}} d
                    INNER JOIN {{%dish_ing}} di ON di.dish_id = d.id
                    INNER JOIN {{%ingredients}} i ON
                        i.id = di.ing_id AND
                        i.id IN ($ing_ids)
                        GROUP BY d.id
                        HAVING ing_count>1
                        ORDER BY ing_count DESC";
            $connection = Yii::$app->getDb();
            $list = $connection->createCommand($sql)->queryAll();
            if(count($list)>0){
                Yii::$app->session->setFlash('finding', '');
            }else{
                Yii::$app->session->setFlash('finding', 'Не найдено не одного блюда по этим ингредиентам!');
            }
            //return $this->refresh();
            return $this->render('find', [
                'model' => $model,
                'list' => $list,
                'count' => $count,
            ]);
        } else {
            return $this->render('find', [
                'model' => $model,
            ]);
        }
    }



    public function actionAbout()
    {
        return $this->render('about');
    }

}
