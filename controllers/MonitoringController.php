<?php

namespace app\controllers;

class MonitoringController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionEventOne()
    {
        return $this->render('event-one');
    }

    public function actionDirOne()
    {
        return $this->render('dir-one');
    }

    public function actionDirTwo()
    {
        return $this->render('dir-two');
    }

    public function actionDirThree()
    {
        return $this->render('dir-three');
    }

    public function actionDirFour()
    {
        return $this->render('dir-four');
    }

    public function actionDirFive()
    {
        return $this->render('dir-five');
    }

}
