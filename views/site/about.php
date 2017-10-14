<?php
use yii\helpers\Html;
use mickgeek\daslider\Widget as DaSlider;
$this->title = 'Dastur haqida';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div>
        <?$html = \keltstr\simplehtmldom\SimpleHTMLDom::file_get_html('http://basic/web/site/some');


        foreach($html->find('tr') as $tr){
            $ktd = 0;
        /*foreach ($tr->find('td') as $k => $td){
            if($k==2){
                $td = trim($td->);
            }
        }*/
            //var_dump($tr->find('td'));
            $sql = '(1,1,"';
            foreach ($tr->find('td') as $k => $td){
                $ktd++;
                $tdv = trim(preg_replace('~\s+~s', ' ', $td));
                if($k == 0 || $k==3 || $k==4 || $k==5){
                    continue;
                }elseif($k==1){
                    $sql .= $td.trim('", "');
                }/*elseif($k==2){
                    var_dump($tdv);
                    var_dump('2017 йил II чорак');
                    $a = $tdv;
                    $b = '2017 йил II чорак';
                    $i=1; $l=strlen($a); $equals=true;
                    while ($i<=$l && $equals) {
                        //echo mb_detect_encoding($a);
                        if (strncmp($a, $b, $i) != 0) {
                            $equals = false;
                        } else {
                            $i++;
                        }
                    }
                    if ($equals) {
                        echo 'Strings are equal';
                    } else {
                        echo 'Character '.$i.' is not equal';
                    } die;
                    if($tdv == trim('2017 йил I чорак')) echo $tdv = strtotime('31.03.2017' );
                    if($tdv == trim('2017 йил II чорак')) echo $tdv = strtotime('30.06.2017' );
                    if($tdv == trim('2017 йил III чорак')) echo  $tdv = strtotime('30.09.2017' );
                    if($tdv == trim('2017 йил IV чорак')) echo $tdv = strtotime('31.12.2017' );
                    $sql .= $td.trim('", "');
                }*/elseif($k==6){
                    $sql .= $td.trim('"), ');
                }
            }
            echo $sql;

        }
        //foreach ($html->)
        ?>
    </div>

</div>
