<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ReceiptSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="receipt-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'receipt_id') ?>

    <?= $form->field($model, 'userInn') ?>

    <?= $form->field($model, 'cashTotalSum') ?>

    <?= $form->field($model, 'ecashTotalSum') ?>

    <?= $form->field($model, 'operator') ?>

    <?php // echo $form->field($model, 'taxationType') ?>

    <?php // echo $form->field($model, 'kktRegId') ?>

    <?php // echo $form->field($model, 'postpaymentSum') ?>

    <?php // echo $form->field($model, 'receiptCode') ?>

    <?php // echo $form->field($model, 'operationType') ?>

    <?php // echo $form->field($model, 'counterSubmissionSum') ?>

    <?php // echo $form->field($model, 'ndsNo') ?>

    <?php // echo $form->field($model, 'dateTime') ?>

    <?php // echo $form->field($model, 'fiscalDocumentNumber') ?>

    <?php // echo $form->field($model, 'fiscalSign') ?>

    <?php // echo $form->field($model, 'items') ?>

    <?php // echo $form->field($model, 'totalSum') ?>

    <?php // echo $form->field($model, 'requestNumber') ?>

    <?php // echo $form->field($model, 'shiftNumber') ?>

    <?php // echo $form->field($model, 'prepaymentSum') ?>

    <?php // echo $form->field($model, 'fiscalDriveNumber') ?>

    <?php // echo $form->field($model, 'user') ?>

    <?php // echo $form->field($model, 'messageFiscalSign') ?>

    <?php // echo $form->field($model, 'nds18') ?>

    <?php // echo $form->field($model, 'rawData') ?>

    <?php // echo $form->field($model, 'nds10') ?>

    <?php // echo $form->field($model, 'fnsUrl') ?>

    <?php // echo $form->field($model, 'operatorInn') ?>

    <?php // echo $form->field($model, 'retailPlaceAddress') ?>

    <?php // echo $form->field($model, 'stornoItems') ?>

    <?php // echo $form->field($model, 'modifiers') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
