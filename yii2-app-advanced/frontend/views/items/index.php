<?php

use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

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
            [
                'attribute' => 'item_id',
                'vAlign' => 'middle',
                'width' => '180px',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $widget) {
                    $file = $model->linkedFiles('image');
                    if ($file) {
                        $child = $file->getChild('thumb');
                    }
                    return Html::a($model->item_id,
                        '#',
                        ['title' => 'View author detail', 'onclick' => 'alert("This will open the author page.\n\nDisabled for this demo!")']);
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(\common\models\Items::find()->orderBy('name')->asArray()->all(), 'item_id', 'name'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
            ],
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
