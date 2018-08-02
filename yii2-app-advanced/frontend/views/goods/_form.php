<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Goods */
/* @var $form yii\widgets\ActiveForm */
$this->registerJs('var Server = ' . json_encode(['convertdate' => ['url' => Url::to(['/site/covertdate'])]]) . ';', $this::POS_BEGIN);
?>

<div class="goods-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'recognizable_name')->textInput() ?>

    <?= $form->field($model, 'edibility')->checkbox() ?>

    <?= $form->field($model, 'shelf_life', [


        'addon' => [
            'prepend' => [
                'content' => $model->renderInterval()
            ],
            'append' => [
                'content' =>
                    \yii\bootstrap\Button::widget([
                        'label' => 'дни &rarr; часы',
                        'encodeLabel' => false,
                        'options' => ['class' => 'btn btn-default convertdate', 'data-cell' => '#goods-shelf_life', 'data-format' => 'day2hours']
                    ]) . PHP_EOL .
                    \yii\bootstrap\Button::widget([
                        'label' => 'в  часы',
                        'options' => ['class' => 'btn btn-default']
                    ]) . PHP_EOL .
                    \yii\bootstrap\ButtonDropdown::widget([
                        'label' => 'Air',
                        'dropdown' => [
                            'items' => [
                                ['label' => 'Another action', 'url' => '#'],
                                ['label' => 'Something else', 'url' => '#'],
                                '<li class="divider"></li>',
                                ['label' => 'Separated link', 'url' => '#'],
                            ],
                        ],
                        'options' => ['class' => 'btn-default']
                    ]),
                'asButton' => true
            ],
        ]
    ])->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
