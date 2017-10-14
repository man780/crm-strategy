<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 24.05.2017
 * Time: 16:02
 */
?>
<h1>Регистрация</h1>
<?php
use \yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<?php
$form = ActiveForm::begin(['class'=>'form-horizontal']);
?>

<?= $form->field($model,'email')->textInput(['autofocus'=>true]) ?>

<?= $form->field($model,'password')->passwordInput()?>

<div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <?= Html::a( 'Back', Yii::$app->request->referrer);?>
</div>

<?php
ActiveForm::end();
?>
