<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Receipt */

$this->title = $model->receipt_id;
$this->params['breadcrumbs'][] = ['label' => 'Receipts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="receipt-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->receipt_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->receipt_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'receipt_id',
            'userInn:ntext',
            'cashTotalSum',
            'ecashTotalSum',
            'operator:ntext',
            'taxationType',
            'kktRegId:ntext',
            'postpaymentSum',
            'receiptCode',
            'operationType',
            'counterSubmissionSum',
            'ndsNo',
            'dateTime',
            'fiscalDocumentNumber',
            'fiscalSign',

            [ 'attribute'=>'items',  'value'=>Html::a($model->getItems0()->count(), '#items-list'), 'format'=>'raw'],
            'totalSum',
            'requestNumber',
            'shiftNumber',
            'prepaymentSum',
            'fiscalDriveNumber:ntext',
            'user:ntext',
            'messageFiscalSign',
            'nds18',
           [ 'attribute'=>'rawData:ntext',  'value'=>Html::img('data:image/gif;base64,'.$model->rawData), 'format'=>'raw'],
            'nds10',
            'fnsUrl:ntext',
            'operatorInn:ntext',
            'retailPlaceAddress:ntext',
            'stornoItems:ntext',
            'modifiers:ntext',
        ],
    ]);
    echo  Html::tag('h2',  'товары');
    echo  $this->render('/items/index',  [
        'searchModel' => $model,
        'dataProvider' => $dataProvider = new \yii\data\ActiveDataProvider([
            'query' =>$model->getItems0(),
        ])
    ])
    ?>

</div>
