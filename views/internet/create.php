<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Internet */

$this->title = Yii::t('app', 'Create Internet');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Internets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="internet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
