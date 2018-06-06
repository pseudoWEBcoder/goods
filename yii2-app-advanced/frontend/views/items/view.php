<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Items */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->item_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Commit', ['commit', 'id' => $model->item_id], [
            'class' => 'btn btn-success'

        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'item_id',
        //    'sum',
            'formatedSum',
            'quantity',
        //    'price',
            'formatedPrice',
            'name',
            'ndsRate',
            'ndsSum',
            'nds18',
            'nds10',
            'calculationSubjectSign',
            'calculationTypeSign',
            'modifiers:ntext',
            'ndsNo',
            'receipt_id',
        ],
    ]) ?>

</div>
