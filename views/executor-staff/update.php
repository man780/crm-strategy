<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ExecutorStaff */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Executor Staff',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Executor Staff'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="executor-staff-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'executors' => $executors,
        'users' => $users,
    ]) ?>

</div>
