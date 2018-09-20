<?php
/* @var $this yii\web\View */

/* @var $model common\models\UploadForm */

use conquer\highlightjs\HighlightjsWidget;
use yii\helpers\Html;
use yii\widgets\ListView;

echo Html::a('вернуться', ['import/upload']);
if (!empty($model->new_cols) && (isset($model->new_cols[0]) or isset($model->new_cols[1]))) {
    echo Html::tag('h2', 'найдены недостающие  колонки в  таблице ');
    echo \yii\bootstrap\Collapse::widget([
        'items' => [
            // equivalent to the above
            [
                'label' => \common\models\Items::tableName(),
                'content' => HighlightjsWidget::widget([
                    'language' => 'sql',
                    'content' => implode(PHP_EOL, $model->new_cols[0]),
                ]), //Html::tag('pre',  Html::tag('code',  implode(PHP_EOL, $model->new_cols[0] ))),
                // open its content by default
                'contentOptions' => ['class' => 'in']
            ],
            // another group item
            [
                'label' => \common\models\Receipt::tableName(),
                'content' => HighlightjsWidget::widget([
                    'language' => 'sql',
                    'content' => implode(PHP_EOL, $model->new_cols[1]),
                ]),
                'contentOptions' => [],
                'options' => [],
            ],

        ]
    ]);

}
if ($model->itemsnew || $model->skipt) {
    echo Html::tag('h2', 'результат импорта');
    echo \yii\bootstrap\Collapse::widget([
        'items' => [
            // equivalent to the above
            [
                'label' => 'Добавлено' . Html::tag('span', count($model->itemsnew), ['class' => 'badge']),
                'content' => ListView::widget([
                    'dataProvider' => new \yii\data\ArrayDataProvider(['allModels' => $model->itemsnew]),
                    'itemView' => '_list_itemsnew',
                ]), //Html::tag('pre',  Html::tag('code',  implode(PHP_EOL, $model->new_cols[0] ))),
                // open its content by default
                'contentOptions' => ['class' => 'in'],
                'options' => ['class' => 'panel-success'],
            ],
            // another group item
            [
                'label' => 'пропущено' . Html::tag('span', count($model->skipt), ['class' => 'badge']),
                'content' => ListView::widget([
                    'dataProvider' => new \yii\data\ArrayDataProvider(['allModels' => $model->skipt, 'pagination' => ['pageSize' => '1000']]),
                    'itemView' => '_list_skipt',
                ]),
                'contentOptions' => [],
                'options' => ['class' => 'panel-danger'],
            ],

        ],
        'encodeLabels' => false
    ]);

}
?>