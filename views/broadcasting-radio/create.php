<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BroadcastingRadio */

$this->title = Yii::t('app', 'Create Broadcasting Radio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Broadcasting Radios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="broadcasting-radio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
