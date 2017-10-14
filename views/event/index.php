<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

use app\models\Direction;
use app\models\SubDirection;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Events');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
<?//vd($model);?>
    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', ['modelClass' => Yii::t('app', 'Event')]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'direction_id',
                'value' => 'direction.title',
                'filter' => ArrayHelper::map(Direction::find()->asArray()->all(), 'id', 'title'),
            ],
            [
                'attribute' => 'sub_dir_id',
                'value' => 'subDir.title',
                //'filter' => ArrayHelper::map(SubDirection::find()->asArray()->all(), 'id', 'title'),
                'filter' => SubDirection::direction($searchModel->direction)
            ],
            'event:ntext',
            'details:ntext',
            [
                'attribute' => 'deadline',
                'format' => ['date', 'php:d.m.Y'],
                /*'filter' => DateRangePicker::widget([
                    'name'=>'deadline',
                    'convertFormat'=>false,
                    'pluginOptions'=>[
                        'opens'=>'left',
                    ]
                ])*/
            ],
            [
                'label' => 'Name',
                'format' => 'html',
                'attribute'=>'name',
                'filter' => \app\models\ExecutorAuthority::getAutoritiesMap(),
                'value' => function($model) {
                    foreach ($model->executorAuthorities as $auth) {
                        $authNames[] = '<span class="label label-info">'.$auth->name.'</span>';
                    }
                    return implode(" ", $authNames);
                },
            ],

            //'deadline_other',


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
