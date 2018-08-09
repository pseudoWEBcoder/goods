<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Items */

$this->title = 'Обновить Items: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->item_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update', ['nameAttribute' => '']);
?>
<div class="items-update">

    <h1><?= 'Обновить Items:' . Html::tag('code', $model->name, ['class' => 'text-primary']) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
