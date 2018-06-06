<?php

use kartik\dynagrid\DynaGrid;
use yii\helpers\Html;
use kartik\grid\GridView;
use  kartik\grid\ActionColumn;
use kartik\grid\SerialColumn;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ReceiptSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Receipts';
$this->params['breadcrumbs'][] = $this->title;
?>   <?php
$columns = [
    ['class' => SerialColumn::className()],

    [
'attribute'=>'receipt_id',
'visible'=>false,
],
    [
'attribute'=>'userInn:ntext',
'visible'=>false,
],
    [
'attribute'=>'cashTotalSum',
'visible'=>false,
],
[
'attribute'=>'formatedTotalSum',
'visible'=>true,
],
    [
'attribute'=>'ecashTotalSum',
'visible'=>false,
],
    [
'attribute'=>'operator:ntext',
'visible'=>false,
],
    [
'attribute'=>'taxationType',
'visible'=>false,
],
    [
'attribute'=>'kktRegId:ntext',
'visible'=>false,
],
    [
'attribute'=>'postpaymentSum',
'visible'=>false,
],
    [
'attribute'=>'receiptCode',
'visible'=>false,
],
    [
'attribute'=>'operationType',
'visible'=>false,
],
    [
'attribute'=>'counterSubmissionSum',
'visible'=>false,
],
    [
'attribute'=>'ndsNo',
'visible'=>false,
],
    [
'attribute'=>'dateTime',
'visible'=>true,
],
    [
'attribute'=>'fiscalDocumentNumber',
'visible'=>false,
],
    [
'attribute'=>'fiscalSign',
'visible'=>false,
],
    [
'attribute'=>'items:ntext',
'visible'=>false,
],
    [
'attribute'=>'totalSum',
'visible'=>false,
],
    [
'attribute'=>'requestNumber',
'visible'=>false,
],
    [
'attribute'=>'shiftNumber',
'visible'=>false,
],
    [
'attribute'=>'prepaymentSum',
'visible'=>false,
],
    [
'attribute'=>'fiscalDriveNumber:ntext',
'visible'=>false,
],
    [
'attribute'=>'user',
'visible'=>true,
],
    [
'attribute'=>'messageFiscalSign',
'visible'=>false,
],
    [
'attribute'=>'nds18',
'visible'=>false,
],
    [
'attribute'=>'rawData:ntext',
'visible'=>false,
],
    [
'attribute'=>'nds10',
'visible'=>false,
],
    [
'attribute'=>'fnsUrl:ntext',
'visible'=>false,
],
    [
'attribute'=>'operatorInn:ntext',
'visible'=>false,
],
    [
'attribute'=>'retailPlaceAddress:ntext',
'visible'=>false,
],
    [
'attribute'=>'stornoItems:ntext',
'visible'=>false,
],
    [
'attribute'=>'modifiers:ntext',
'visible'=>false,
],

    ['class' =>ActionColumn::className()],
];
$dynagrid = DynaGrid::begin([
    'columns' => $columns,
    'theme'=>'panel-info',
    'showPersonalize'=>true,
    'storage' => 'session',
    'gridOptions'=>[
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'showPageSummary'=>true,
        'floatHeader'=>true,
        'pjax'=>true,
        'responsiveWrap'=>false,
        'panel'=>[
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  Library</h3>',
            'before' =>  '<div style="padding-top: 7px;"><em>* The table header sticks to the top in this demo as you scroll</em></div>',
            'after' => false
        ],
        'toolbar' =>  [
            ['content'=>
                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Add Book', 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['dynagrid-demo'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>'Reset Grid'])
            ],
            ['content'=>'{dynagridFilter}{dynagridSort}{dynagrid}'],
            '{export}',
        ]
    ],
    'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
]);
if (substr($dynagrid->theme, 0, 6) == 'simple') {
    $dynagrid->gridOptions['panel'] = false;
}
DynaGrid::end();
?>
<div class="receipt-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Receipt', ['create'], ['class' => 'btn btn-success']) ?>
    </p>



</div>
