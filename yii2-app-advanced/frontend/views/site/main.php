<?php

use kartik\icons\Icon;
use yii\grid\GridView;
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



    <?= GridView::widget([

        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key) {
            return is_null($model->reason) ? [] : ['class' => 'success'];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            'formatedSum',
            'name',

            'formatedPrice',
            'quantity',
            //'ndsRate',
            //'ndsSum',
            //'nds18',
            //'nds10',
            //'calculationSubjectSign',
            //'calculationTypeSign',
            //'modifiers:ntext',
            //'ndsNo',
            //'receipt_id',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{commit} {view} {update}',
                'buttons' => [
                    'commit' => function ($url, $model, $key) {
                        return Html::a(Icon::show('check', [/*'class' => 'fa-3x'*/], Icon::FA), $url);
                    }
                ],
                'urlCreator' => /**
                 * @param $action
                 * @param  \common\models\Items $model
                 * @param string $key
                 * @param int $index
                 * @return string
                 */
                    function ($action, $model, $key, $index) {

                        return \yii\helpers\Url::to(["/items/{$action}", 'id' => $model->item_id]);

                    }],
        ],
    ]); ?>
</div>
