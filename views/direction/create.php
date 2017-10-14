<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Direction */

$this->title = Yii::t('app', 'Create {modelClass}', ['modelClass' => Yii::t('app', 'Direction'),]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Directions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="direction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
