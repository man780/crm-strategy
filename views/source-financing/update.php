<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SourceFinancing */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Source Financing',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Source Financings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="source-financing-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
