<?php
/* @var $this yii\web\View */
echo \yii\helpers\Html::tag('span', \yii\helpers\ArrayHelper::getValue($model, 'dateTime'), ['class' => 'text']);
echo ' ';
echo \yii\helpers\Html::tag('span', \yii\helpers\ArrayHelper::getValue($model, 'user'), ['class' => 'text-muted']);
echo ' ';
echo \yii\helpers\Html::tag('span', \yii\helpers\ArrayHelper::getValue($model, 'retailPlaceAddress'), ['class' => 'text-waring']);
echo ' ';
echo \yii\helpers\Html::tag('span', \common\models\Items::formatNum(\yii\helpers\ArrayHelper::getValue($model, 'totalSum')), ['class' => 'text-info']);
?>

