<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

use app\models\ExecutorAuthority;

/* @var $this yii\web\View */
/* @var $model app\models\Event */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-view">

    <!--<h1><?/*= Html::encode($this->title) */?></h1>-->
    <p>
        <?= Html::a(Yii::t('app', 'Back'), \Yii::$app->user->getReturnUrl(), ['class' => 'btn btn-danger']) ?>
    </p>
    <?if(!Yii::$app->user->isGuest && Yii::$app->user->id <= 11):?>
    <p>
        <?= Html::a(Yii::t('app', 'Back'), \Yii::$app->user->getReturnUrl(), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?endif;?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //'direction_id',
            [
                'attribute'=>'direction_id',
                'value'=>$model->direction->title,
            ],
            //'sub_dir_id',
            [
                'attribute'=>'sub_dir_id',
                'value'=>$model->subDir->title,
            ],
            'event:ntext',
            'details:ntext',
            'deadline:date',
            'deadline_other',
        ],
    ]) ?>

    <?//vd($model->executorAuthorities)?>
    <h2>Ижрочилар: </h2>
    <?
        $authority_id = Yii::$app->session->get('user.authority_id');
        $staff_id = Yii::$app->session->get('user.staff_id');
        //vd($staff_id);
    ?>
    
    <?
        //$executorAuthorities = \app\models\EventExecutorAuthority::getAuthoritiesByEventId($model->id);
    ?>
    <?//vd($model->executorAuthorities)?>
    <?foreach ($model->executorAuthoritiesBySec as $key => $executorAuthority):?>
        <p>
            <?if($authority_id == $executorAuthority->executor_authority_id):?>
                <?=Html::a(ExecutorAuthority::getName($executorAuthority->executor_authority_id), Url::toRoute(['executor-authority/view', 'id' => $executorAuthority->executor_authority_id]));?>
            <?else:?>
                <?=Html::tag('span', ExecutorAuthority::getName($executorAuthority->executor_authority_id), ['class' => ($key==0)?'label label-success':'label label-info']);?>
            <?endif;?>
        </p>
    <?endforeach;?>

    <h2>Ижроси ҳақидаги маълумот</h2>
    <?=Html::a('Ижроси ҳақидаги маълумот киритиш', Url::toRoute(['event/execution', 'id' => $model->id]), ['class' => 'btn btn-primary']);?>
    <?foreach ($model->executions as $execution):?>
        <p>
            <?if($execution->exec_id == $authority_id || Yii::$app->user->id < 12):?>
                <?=Html::a($execution->exec->name.' '.date('d.m.Y', $execution->dcreated), Url::toRoute(['event/card', 'id' => $execution->id]));?>

                <?if(is_null($execution->seen) && Yii::$app->user->id < 12):?>
                    <span class="label label-warning">кўрилмаган</span>
                <?endif;?>
            <?else:?>
                <?=Html::tag('span', $execution->exec->name.' '.date('d.m.Y', $execution->dcreated));?>
            <?endif;?>

        </p>
    <?endforeach;?>

</div>