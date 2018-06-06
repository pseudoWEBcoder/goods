<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-index" id="items-list">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Items', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([

        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'item_id',
            'sum',
            'formatedSum',
            'quantity',
            'price',
            'formatedPrice',
            'name',
            //'ndsRate',
            //'ndsSum',
            //'nds18',
            //'nds10',
            //'calculationSubjectSign',
            //'calculationTypeSign',
            //'modifiers:ntext',
            //'ndsNo',
            //'receipt_id',

            ['class' => 'yii\grid\ActionColumn',   'urlCreator' => /**
             * @param $action
             * @param  \common\models\Items $model
             * @param string $key
             * @param int  $index
             * @return string
             */
                function ($action, $model, $key, $index) {

                    return \yii\helpers\Url::to(["/items/{$action}", 'id' => $model->item_id]);

            }],
        ],
    ]); ?>
</div>
