<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SourceFinancing */

$this->title = Yii::t('app', 'Create Source Financing');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Source Financings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-financing-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
