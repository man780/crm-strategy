<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ConfirmedExecution */

$this->title = Yii::t('app', 'Confirmed Execution');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Confirmed Executions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="confirmed-execution-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'execution' => $execution,
        'event' => $event,
        'staff' => $staff,
        'authority' => $authority,
        'broadcasting_tvs' => $broadcasting_tvs,
        'broadcasting_radios' => $broadcasting_radios,
        'broadcasting_presss' => $broadcasting_presss,
        'broadcasting_internets' => $broadcasting_internets,
    ]) ?>

</div>
