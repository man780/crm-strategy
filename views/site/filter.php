<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 24.07.2017
 * Time: 11:26
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\jui\DatePicker;
use kartik\select2\Select2;

$this->title = 'Фильтр ('. count($events).')';
?>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>


    <?=Html::beginForm(['/site/filter'], 'post');?>

    <div class="form-group">
        <label>Йўналиш</label>
        <?=Html::dropDownList('Filter[direction]', $selectedDir, $directionsMap, ['prompt'=>'Йўналишни танланг ...', 'class' => 'form-control'])?>
    </div>

    <div class="form-group">
        <label>Муддати: </label>
        дан:<?=DatePicker::widget([
            'name'  => 'Filter[from_date]',
            'value'  => $from_date,
            'class' => 'form-control'
        ])?>
        гача:<?=DatePicker::widget([
            'name'  => 'Filter[to_date]',
            'value'  => $to_date,
        ])?>
    </div>

    <div class="form-group">
        <label>Бошқа саналарни ҳам танлаш</label>
        <?=Html::checkbox('Filter[deadline_other]', $deadline_other)?>
    </div>

    <div class="form-group">
        <label>Ижрочи ташкилотлар</label>
        <?=Select2::widget([
            'name' => 'Filter[authority]',
            'data' => $authorities,
            'value' => $selectedAuthorities,
            'options' => [
                'placeholder' => 'Ташкилотни танланг ...',
                'multiple' => true
            ],
        ])?>
    </div>

    <div class="form-group">
        <label>Биринчи ижрочи бўлганлари: </label>
        <?=Html::checkbox('Filter[first_executor]', $first_executor)?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Қидириш', ['class' => 'btn btn-success']) ?>

    </div>

    <?php Html::endForm();?>



    <div class="body-content table-responsive">
        <table class="table table-striped table-bordered table-hover ">
            <thead>
            <tr>
                <th width="3%">Банд</th>
                <th width="45%">Амалга ошириладиган тадбир</th>
                <th width="5%">Муддати</th>
                <th width="40%">Ижро учун масъуллар</th>
                <th width="5%">Амаллар</th>
            </tr>
            </thead>
            <tbody>
            <?if(!is_null($events)):?>
                <?foreach ($directions as $direction):?>
                    <?if(!in_array($direction['id'], $dArr))continue;?>
                    <tr class="direction" data-id="tr-<?=$direction['id']?>">
                        <td colspan="5" align="left"><b><?=$direction['id']?> <?=$direction['title']?></b></td>
                    </tr>
                    <?foreach ($sub_directions as $sub_direction):?>
                        <?if(!in_array($sub_direction['id'], $sdArr))continue;?>
                        <?if($sub_direction['direction_id'] == $direction['id']):?>
                            <tr class="sub-dir tr-<?=$direction['id']?>" data-sub_dir="tr-<?=$direction['id']?>-<?=$sub_direction['num']?>">
                                <td colspan="5" align="left"><b><?=$sub_direction['direction_id']?>.<?=$sub_direction['num']?>. <?=$sub_direction['title']?></b></td>
                            </tr>
                            <?foreach ($events as $event):?>
                                <?if($event['direction_id'] == $direction['id'] && $event['sub_dir_id'] == $sub_direction['id']):?>
                                    <tr class="event tr-<?=$direction['id']?>-<?=$sub_direction['num']?> dir-<?=$direction['id']?>" data-direction="<?=$event['direction_id']?>" data-sub_direction="<?=$event['sub_dir_id']?>">
                                        <td><?=$event['id']?></td>
                                        <td><?=$event['event']?></td>
                                        <td><?=(is_null($event['deadline']))?$event['deadline_other']:date('d.m.Y', $event['deadline'])?></td>
                                        <td>
                                            <?//vd($event->executorAuthorities)?>
                                            <?foreach($event->executorAuthorities as $key=>$executorAuthority):?>
                                                <?if($key == 0):?>
                                                    <span class="label label-primary"><?=$executorAuthority->mini_name?></span>
                                                <?else:?>
                                                    <span class="label label-success"><?=$executorAuthority->mini_name?></span>
                                                <?endif;?>
                                            <?endforeach;?>
                                        </td>
                                        <td>
                                            <?=Html::a('Кўриш', Url::toRoute(['event/view', 'id' => $event['id']]))?>
                                            <?if(Yii::$app->user->id > 11):?>
                                                <?=Html::a('Бажариш', Url::toRoute(['event/execution', 'id' => $event['id']]))?>
                                            <?endif;?>
                                        </td>
                                    </tr>
                                <?endif;?>
                            <?endforeach;?>
                        <?endif;?>
                    <?endforeach;?>
                <?endforeach;?>
            <?endif;?>
            </tbody>

        </table>

    </div>

</div>
