<?php

use common\models\GoodsProperties;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Items */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="items-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'sum')->textInput() ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?php $id = 'collapse_' . mt_rand();
    echo Html::beginTag('div', ['class' => 'custom-collapse']), html::a('[..]', '#' . $id, ['class' => "btn btn-primary", 'data-toggle' => "collapse", /*'role'=>"button",  'aria-expanded'=>"false", 'aria-controls'=>"#".$id*/]) . PHP_EOL . Html::beginTag('div', ['id' => $id, 'class' => 'collapse']); ?>
    <?= $form->field($model, 'ndsRate')->textInput() ?>

    <?= $form->field($model, 'ndsSum')->textInput() ?>

    <?= $form->field($model, 'nds18')->textInput() ?>

    <?= $form->field($model, 'nds10')->textInput() ?>

    <?= $form->field($model, 'calculationSubjectSign')->textInput() ?>

    <?= $form->field($model, 'calculationTypeSign')->textInput() ?>

    <?= $form->field($model, 'modifiers')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ndsNo')->textInput() ?>
    <?= $form->field($model, 'ndsNo')->textInput() ?>

    <?= $form->field($model, 'receipt_id')->textInput() ?>
    <?= $form->field($model, 'reason')->textarea() ?>
    <?php echo Html::endTag('div'), '<!--/div' . $id . '.collapse-->', Html::endTag('div'), '<!--/div.custom-collapse-->'; ?>
    <?php if ($model->goods): ?>
        <?php
        $all = ArrayHelper::map(GoodsProperties::find()->asArray()->all(), 'name', 'title');
        $values = $model->goods->propertiesValues;
        $addon = [
            'prepend' => [
                'content' => kartik\helpers\Html::tag('code', 'Добавить  свойство')
            ],
            'append' => [
                'content' => Html::button(kartik\helpers\Html::icon('plus'), [
                    'class' => 'btn btn-success add_property',
                    'title' => 'Добавить  свойство',
                    'data-toggle' => 'tooltip'
                ]),
                'asButton' => true
            ]
        ];
        echo Select2::widget([
            'name' => 'GoodsProperties',
            'addon' => $addon,
            'data' => $all,
            'language' => 'ru',
            'options' => ['placeholder' => 'выбрать свойство'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

    <?php else: ?>

    <?php endif; ?>
    <? echo $form->field($model, 'goods')->widget(Select2::classname(), [
        'data' => $model->getAllGoods(),
        'language' => 'ru',
        'options' => ['placeholder' => 'прикрепить к товару из  справочника'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <div><?php echo Html::a('править товар', ['/goods/update', 'id' => $model->goods_id]) ?></div>

    <?php
    $images = $model->linkedFiles('image');
    $am = Yii::$app->getAssetManager();
    $Images = [];
    $reg = '/web\/index\.phpuploads\//';
    $repl = '/web/uploads/';
    foreach ($images as $index => $item) {
        /** @var \cyneek\yii2\uploadBehavior\models\ImageFileModel $item */
        $thumb = $item->getChildren('thumb');
        $UrlThumb = preg_replace($reg, $repl, $thumb[0]->getFilePath());
        $pathThumb = preg_replace($reg, $repl, $thumb[0]->getFilePath());
        $path = (implode('/', [$thumb[0]->completePath, $thumb[0]->fileName . '.' . $thumb[0]->extension]));
        $pathThumb = Yii::getAlias($path);
        $path = (implode('/', [$item->completePath, $item->fileName . '.' . $item->extension]));
        $pathFullsize = Yii::getAlias($path);
        $UrlFullsize = preg_replace($reg, $repl, $item->getFilePath());
        $tmp = $am->publish($pathThumb);
        $tmp[] = [
            'downloadUrl' => $UrlFullsize,
            'caption' => ArrayHelper::getValue($thumb, '0.fileName'),
            'size' => filesize($path), 'key' => $index, /*'type'=>'',*/
            'filename' => ArrayHelper::getValue($thumb, '0.fileName'),
            'filetype' => ArrayHelper::getValue($thumb, '0.mimeType')
        ];

        $Images[] = $tmp;
    }
    echo $form->field($model, 'date_of_manufacture')->widget(\kartik\widgets\DateTimePicker::classname(), [
        'options' => ['placeholder' => $model->getAttributeLabel('date_of_manufacture')],
        'pluginOptions' => [
            'autoclose' => true
        ]
    ]);;
    echo '<label class="control-label">добавить картинки</label>';
    echo FileInput::widget([
        'model' => $model,
        'attribute' => 'image',
        'options' => [
            'multiple' => true
        ],
        'pluginOptions' => [
            'initialPreview' => ArrayHelper::getColumn($Images, 1),
            'initialPreviewAsData' => true,
            'initialCaption' => "The Moon and the Earth",
            'initialPreviewConfig' => ArrayHelper::getColumn($Images, 2),
            'overwriteInitial' => false,
            "uploadUrl" => \yii\helpers\Url::to(['/items/update-images', 'action' => 'upload', 'id' => $model->item_id]),
            "deleteUrl" => \yii\helpers\Url::to(['/items/update-images', 'action' => 'delete', 'id' => $model->item_id]),
            'maxFileSize' => 2800
        ]
    ]); ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
