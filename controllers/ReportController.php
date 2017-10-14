<?php

namespace app\controllers;

use app\models\Direction;
use app\models\Event;
use app\models\SubDirection;

use yii\filters\AccessControl;
use Yii;
use yii\web\ForbiddenHttpException;
class ReportController extends \yii\web\Controller
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
                        'actions' => ['index'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function beforeAction($action) {
//vd(Yii::$app->user->id);
        if(is_null(Yii::$app->user->id) || Yii::$app->user->id > 11){
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        }
        return true;
    }

    public function actionIndex()
    {
        $directions = Direction::find()->orderBy("id")->asArray()->all();
        $sub_directions = SubDirection::find()->orderBy("id")->asArray()->all();
        $events = Event::find()->orderBy("id")->all();
        return $this->render('index', [
            'directions' => $directions,
            'sub_directions' => $sub_directions,
            'events' => $events,
        ]);
    }

}
