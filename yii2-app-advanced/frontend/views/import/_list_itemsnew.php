<?php
/* @var $this yii\web\View */

use yii\helpers\ArrayHelper;

echo \yii\helpers\Html::a(ArrayHelper::getValue($model, 'name'), ['items/view', 'id' => ArrayHelper::getValue($model, 'item_id')], ['class' => 'text-success']);

?>

