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

    <?php
    echo newerton\fancybox\FancyBox::widget([
        'target' => 'a[rel=fancybox]',
        'helpers' => true,
        'mouse' => true,
        'config' => [
            'maxWidth' => '90%',
            'maxHeight' => '90%',
            'playSpeed' => 7000,
            'padding' => 0,
            'fitToView' => false,
            'width' => '70%',
            'height' => '70%',
            'autoSize' => false,
            'closeClick' => false,
            'openEffect' => 'elastic',
            'closeEffect' => 'elastic',
            'prevEffect' => 'elastic',
            'nextEffect' => 'elastic',
            'closeBtn' => false,
            'openOpacity' => true,
            'helpers' => [
                'title' => ['type' => 'float'],
                'buttons' => [],
                'thumbs' => ['width' => 68, 'height' => 50],
                'overlay' => [
                    'css' => [
                        'background' => 'rgba(0, 0, 0, 0.8)'
                    ]
                ]
            ],
        ]
    ]);

    //echo Html::a(Html::img('/folder/thumb.jpg'), '/folder/imagem.jpg', ['rel' => 'fancybox']);
    ?>

    <?= GridView::widget([

        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key) {
            return is_null($model->reason) ? [] : ['class' => 'success'];
        },
        'columns' => [
            ['format' => 'raw',
                'value' => function ($model, $key, $index, $widget) {
                    $file = $model->linkedFiles('image');
                    $reg = '/web\/index\.phpuploads\//';
                    $repl = '/web/uploads/';
                    if ($file) {
                        $child = $file[0]->getChild('thumb');
                        $childr = $file[0]->getChildren();
                        $fullsize = preg_replace($reg, $repl, $file[0]->getFilePath());
                        $mini = preg_replace($reg, $repl, $childr[1]->getFilePath());
                        return Html::a(Html::img($mini), $fullsize, ['rel' => 'fancybox', 'title' => $model->name]);
                    }
                }],
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
