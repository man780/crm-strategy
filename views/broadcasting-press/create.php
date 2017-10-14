<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BroadcastingPress */

$this->title = Yii::t('app', 'Create Broadcasting Press');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Broadcasting Presses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="broadcasting-press-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
