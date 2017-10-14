<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SubDirection */

$this->title = Yii::t('app', 'Create Sub Direction');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sub Directions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-direction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
