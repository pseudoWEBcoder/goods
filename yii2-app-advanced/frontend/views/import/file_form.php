<?php

use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'uploadedFile')->fileInput(['class' => 'btn  btn-primary']) ?>
<?= $form->field($model, 'truncateReceipt')->checkbox() ?>
<?= $form->field($model, 'truncateItems')->checkbox() ?>

<?= \yii\helpers\Html::submitButton('отправить', ['class' => 'btn  btn-success']) ?>

<?php ActiveForm::end() ?>