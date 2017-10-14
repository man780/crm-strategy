<?php
/* @var $this yii\web\View */
$this->title = "Ҳисоботлар";
?>
<style>
    body{
        font: 'Times New Roman';
    }
    th{
        font: bold;
    }
</style>
<h4 align="center">
    Ўзбекистон Республикаси Президентининг 2017 йил 7 февралдаги ПФ-4947-сонли Фармони билан тасдиқланган<br>
    2017-2021 йилларда Ўзбекистон Республикасини ривожлантиришнинг бешта устувор йўналиши бўйича Ҳаракатлар стратегиясини<br>
    “Халқ билан мулоқот ва инсон манфаатлари йили”да амалга оширишга оид Давлат дастури ижроси юзасидан<br>
    МАЪЛУМОТ
</h4>
<div align="right">
    <strong><?=date('d.m.Y');?></strong>
</div>
<div class="table-responsive">
    <table class="" border="1">
        <thead>
            <tr>
                <!--<th>Т/р</th>-->
                <th width="2%">Банд</th>
                <th width="40%">Амалга ошириладиган тадбир</th>
                <th width="5%">Муддати</th>
                <th width="25%">Ижро учун масъуллар</th>
                <th>Ижро ҳолати</th>
            </tr>
        </thead>
        <tbody>
        <?foreach ($directions as $direction):?>
            <tr>
                <td colspan="5" align="center"><b><?=$direction['title']?></b></td>
            </tr>
            <?foreach ($sub_directions as $sub_direction):?>
                <?if($sub_direction['direction_id'] == $direction['id']):?>
                <tr>
                    <td colspan="5" align="center"><b><?=$sub_direction['direction_id']?>.<?=$sub_direction['num']?>. <?=$sub_direction['title']?></b></td>
                </tr>
                    <?foreach ($events as $event):?>
                        <?if($event['direction_id'] == $direction['id'] && $event['sub_dir_id'] == $sub_direction['id']):?>
                        <tr>
                            <!--<td><?/*=$event['id']*/?>.</td>-->
                            <td><?=$event['id']?></td>
                            <td align="justify">
                                <?=$event['event']?>
                                <br>
                                <b><i>Амалга оширш механизми:</i></b><span><?=$event['mechanism']?></span>
                            </td>
                            <td align="center"><?=(!is_null($event['deadline']))?date('d.m.Y', $event['deadline']):$event['deadline_other']?></td>
                            <td>
                                <?foreach($event->executorAuthorities as $key => $executorAuthority):?>
                                    <?if($key == 0):?>
                                        <p><b><?=$executorAuthority->mini_name?></b></p>
                                    <?else:?>
                                        <p><span><?=$executorAuthority->mini_name?></span></p>
                                    <?endif;?>
                                <?endforeach;?>
                            </td>
                            <td align="justify">
                                <?
                                    switch ($event->percentage){
                                        case 1: echo "<b>Бажарилмаган:</b>"; break;
                                        case 2: echo "<b>Бажарилмоқда:</b>"; break;
                                        case 3: echo "<b>Бажарилди:</b>"; break;
                                        default: echo "<b>Бажарилмаган:</b>"; break;
                                    }
                                    /*if($event->percentage == 0){
                                        echo "<b>Бажарилмаган:</b>";
                                    }elseif($event->percentage > 0 && $event->percentage < 100){
                                        echo "<b>Бажарилмоқда:</b>";
                                    }else{
                                        echo "<b>Бажарилди:</b>";
                                    }*/
                                ?>
                                <?=$event->confirmedExecutions->new_execution_information?>
                            </td>
                        </tr>
                        <?endif;?>
                    <?endforeach;?>
                <?endif;?>
            <?endforeach;?>
        <?endforeach;?>
        </tbody>


</table>
</div>

