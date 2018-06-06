<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Items */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="items-form">

    <?php $form = ActiveForm::begin([   'options'=>['enctype'=>'multipart/form-data'] ]); ?>

    <?= $form->field($model, 'sum')->textInput() ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ndsRate')->textInput() ?>

    <?= $form->field($model, 'ndsSum')->textInput() ?>

    <?= $form->field($model, 'nds18')->textInput() ?>

    <?= $form->field($model, 'nds10')->textInput() ?>

    <?= $form->field($model, 'calculationSubjectSign')->textInput() ?>

    <?= $form->field($model, 'calculationTypeSign')->textInput() ?>

    <?= $form->field($model, 'modifiers')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ndsNo')->textInput() ?>

    <?= $form->field($model, 'receipt_id')->textInput() ?>
    <?= $form->field($model, 'reason')->textarea() ?><?php
    $images =  $model->getImagesAsArray();
    $am =  Yii::$app->getAssetManager();$Images =[];
    foreach ($images as $index => $item) {
        $tmp  =  $am->publish($item);
        $tmp[] =  ['caption'=>pathinfo($item)['basename'], 'size' => filesize  ($item) ];

        $Images[]  =  $tmp;
    }

    echo '<label class="control-label">добавить картинки</label>';
    echo FileInput::widget([
    'model' => $model,
    'attribute' => 'image',
        'options'=>[
            'multiple'=>true
        ],
        'pluginOptions' => [
            'initialPreview'=>\yii\helpers\ArrayHelper::getColumn($Images,  1),
            'initialPreviewAsData'=>true,
            'initialCaption'=>"The Moon and the Earth",
            'initialPreviewConfig' => \yii\helpers\ArrayHelper::getColumn($Images,  2),
            'overwriteInitial'=>false,
            'maxFileSize'=>2800
        ]
    ]);?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
