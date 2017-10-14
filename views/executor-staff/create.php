<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ExecutorStaff */

$this->title = Yii::t('app', 'Create Executor Staff');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Executor Staff'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="executor-staff-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'executors' => $executors,
        'users' => $users,
    ]) ?>

</div>
