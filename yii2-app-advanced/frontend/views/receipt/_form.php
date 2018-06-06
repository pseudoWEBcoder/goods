<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Receipt */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="receipt-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userInn')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cashTotalSum')->textInput() ?>

    <?= $form->field($model, 'ecashTotalSum')->textInput() ?>

    <?= $form->field($model, 'operator')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'taxationType')->textInput() ?>

    <?= $form->field($model, 'kktRegId')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'postpaymentSum')->textInput() ?>

    <?= $form->field($model, 'receiptCode')->textInput() ?>

    <?= $form->field($model, 'operationType')->textInput() ?>

    <?= $form->field($model, 'counterSubmissionSum')->textInput() ?>

    <?= $form->field($model, 'ndsNo')->textInput() ?>

    <?= $form->field($model, 'dateTime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fiscalDocumentNumber')->textInput() ?>

    <?= $form->field($model, 'fiscalSign')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'items')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'totalSum')->textInput() ?>

    <?= $form->field($model, 'requestNumber')->textInput() ?>

    <?= $form->field($model, 'shiftNumber')->textInput() ?>

    <?= $form->field($model, 'prepaymentSum')->textInput() ?>

    <?= $form->field($model, 'fiscalDriveNumber')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'messageFiscalSign')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nds18')->textInput() ?>

    <?= $form->field($model, 'rawData')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'nds10')->textInput() ?>

    <?= $form->field($model, 'fnsUrl')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'operatorInn')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'retailPlaceAddress')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'stornoItems')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'modifiers')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
