<?php

namespace common\models;

use yii\helpers\Html;

/**
 * This is the model class for table "goods".
 *
 * @property int $goods_id
 * @property string $name
 * @property int $recognizable_name узнаваемое имя
 * @property int $edibility съедобность
 * @property int $shelf_life срок хранения
 *
 * @property PropertiesValues[] $propertiesValues
 */
class Goods extends \yii\db\ActiveRecord
{
    public $interval = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['recognizable_name', 'edibility', 'shelf_life'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'goods_id' => 'Goods ID',
            'name' => 'Name',
            'recognizable_name' => 'узнаваемое имя',
            'edibility' => 'съедобность',
            'shelf_life' => 'срок хранения',
        ];
    }

    public function renderInterval()
    {
        $result = [];
        try {
            $d ['y'] = round($this->shelf_life / 24 / 30 / 12);
            $d ['m'] = round($this->shelf_life / 24 / 30);
            $d ['d'] = round($this->shelf_life / 24);
            $d ['h'] = $this->shelf_life;
            $d ['i'] = $this->shelf_life * 60;
            $d ['s'] = $this->shelf_life * 60 * 60;
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage()];
        }
        $labels = [
            'y' => ['nom' => 'год', 'gen' => 'года', 'plu' => 'лет'],
            'm' => ['nom' => 'месяц', 'gen' => 'месяца', 'plu' => 'месяцев'],
            'd' => ['nom' => 'день', 'gen' => 'дня', 'plu' => 'дней'],
            'h' => ['nom' => 'час', 'gen' => 'часа', 'plu' => 'часов'],
            'i' => ['nom' => 'минута', 'gen' => 'минуты', 'plu' => 'минут'],
            's' => ['nom' => 'секунда', 'gen' => 'секунды', 'plu' => 'секунд'],
//  'weekday' => '',
//  'weekday_behavior' => '',
//  'first_last_day_of' => '',
//  'invert' => '',
//  'days' => '',
//  'special_type' => '',
//  'special_amount' => '',
//  'have_weekday_relative' => '',
//  'have_special_relative' => '',
        ];
        array_reverse($labels);
        $classs = ['info', 'warning', 'primary', 'success'];
        $i = 0;
        foreach (array_reverse($labels) as $index => $label) {
            $c = $classs[++$i % count($classs)];
            if ($d[$index] && $d[$index] > 0)
                $result[] = Html::tag('span', Html::tag('span', $d[$index], ['class' => 'timevalue']) . ' ' . Html::tag('span', $this->units($d[$index], $label), ['class' => 'timelabel']), ['class' => $index . ' text-' . $c]);
        }
        $this->interval = $d;
        return implode(' ', $result);
    }

    /**
     * Возвращает единицу измерения с правильным окончанием
     *
     * @param {Number} num      Число
     * @param {Object} cases    Варианты слова {nom: 'час', gen: 'часа', plu: 'часов'}
     * @return {String}
     */
    function units($num, $cases)
    {
        $num = abs($num);
        $word = '';
        if (strpos($num, '.') > -1) {
            $word = $cases['gen'];
        } else {
            $word = (
            $num % 10 == 1 && $num % 100 != 11
                ? $cases['nom']
                : $num % 10 >= 2 && $num % 10 <= 4 && ($num % 100 < 10 || $num % 100 >= 20)
                ? $cases['gen']
                : $cases['plu']
            );
        }
        return $word;
    }

    /**
     * https://habr.com/post/105428/
     * Функция возвращает окончание для множественного числа слова на основании числа и массива окончаний
     * param  $number Integer Число на основе которого нужно сформировать окончание
     * param  $endingsArray  Array Массив слов или окончаний для чисел (1, 4, 5),
     *         например array('яблоко', 'яблока', 'яблок')
     * return String
     */
    function getNumEnding($number, $endingArray)
    {
        $number = $number % 100;
        if ($number >= 11 && $number <= 19) {
            $ending = $endingArray[2];
        } else {
            $i = $number % 10;
            switch ($i) {
                case (1):
                    $ending = $endingArray[0];
                    break;
                case (2):
                case (3):
                case (4):
                    $ending = $endingArray[1];
                    break;
                default:
                    $ending = $endingArray[2];
            }
        }
        return $ending;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertiesValues()
    {
        return $this->hasMany(PropertiesValues::className(), ['goods_id' => 'goods_id']);
    }
}
