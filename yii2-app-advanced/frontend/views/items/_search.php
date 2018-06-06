<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ItemsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="items-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'item_id') ?>

    <?= $form->field($model, 'sum') ?>

    <?= $form->field($model, 'quantity') ?>

    <?= $form->field($model, 'price') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'ndsRate') ?>

    <?php // echo $form->field($model, 'ndsSum') ?>

    <?php // echo $form->field($model, 'nds18') ?>

    <?php // echo $form->field($model, 'nds10') ?>

    <?php // echo $form->field($model, 'calculationSubjectSign') ?>

    <?php // echo $form->field($model, 'calculationTypeSign') ?>

    <?php // echo $form->field($model, 'modifiers') ?>

    <?php // echo $form->field($model, 'ndsNo') ?>

    <?php // echo $form->field($model, 'receipt_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
