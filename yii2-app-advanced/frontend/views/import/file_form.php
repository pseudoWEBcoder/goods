<?php
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'uploadedFile')->fileInput() ?>
<?= $form->field($model, 'truncateReceipt')->checkbox() ?>
<?= $form->field($model, 'truncateItems')->checkbox() ?>

    <button>Submit</button>

<?php ActiveForm::end() ?>