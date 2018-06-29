<?php

namespace common\models;

use cyneek\yii2\uploadBehavior\UploadImageBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "items".
 *
 * @property int $item_id
 * @property int $sum
 * @property int $quantity
 * @property int $price
 * @property string $name
 * @property int $ndsRate
 * @property int $ndsSum
 * @property int $nds18
 * @property int $nds10
 * @property int $calculationSubjectSign
 * @property int $calculationTypeSign
 * @property string $modifiers
 * @property int $ndsNo
 * @property int $receipt_id
 * @property string $reason причина  использования
 * @property string $image путь  к картинке
 * @property string $description понятное описание
 * @property int $paymentType
 * @property int $nds
 * @property int $ndsCalculated10
 * @property int $ndsCalculated18
 * @property string $date_of_manufacture дата изготовления
 * @property int $goods_id идендификатор товара
 *
 * @property Receipt $receipt
 */
class Items extends \yii\db\ActiveRecord
{
    public $attachments = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'items';
    }

    public static function rus2translit($string, $dir = 'ru-en')
    {
        $converter = array(
            'а' => 'a', 'б' => 'b', 'в' => 'v',
            'г' => 'g', 'д' => 'd', 'е' => 'e',
            'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
            'и' => 'i', 'й' => 'y', 'к' => 'k',
            'л' => 'l', 'м' => 'm', 'н' => 'n',
            'о' => 'o', 'п' => 'p', 'р' => 'r',
            'с' => 's', 'т' => 't', 'у' => 'u',
            'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
            'ь' => '\'', 'ы' => 'y', 'ъ' => '\'',
            'э' => 'e', 'ю' => 'yu', 'я' => 'ya',

            'А' => 'A', 'Б' => 'B', 'В' => 'V',
            'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
            'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
            'И' => 'I', 'Й' => 'Y', 'К' => 'K',
            'Л' => 'L', 'М' => 'M', 'Н' => 'N',
            'О' => 'O', 'П' => 'P', 'Р' => 'R',
            'С' => 'S', 'Т' => 'T', 'У' => 'U',
            'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
            'Ь' => '\'', 'Ы' => 'Y', 'Ъ' => '\'',
            'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
        );
        return strtr($string, $dir == 'ru-en' ? $converter : array_flip($converter));
    }

    public function behaviors()
    {
        return [
//            [
//                'class' => UploadBehavior::className(),
//                'attribute' => 'image',
//                'scenarios' => ['default'],
//                'fileActionOnSave' => 'delete'
//            ],
            [
                'class' => UploadImageBehavior::className(),
                'attribute' => 'image',
                'scenarios' => ['insert', 'update'],
                'thumbPath' => 'items/images/thumb',
                'path' => 'items/images',
                'fileActionOnSave' => 'insert',
                'thumbs' => [
                    'thumb' => [
                        ['action' => 'thumbnail', 'width' => 200, 'height' => 200, 'quality' => 90]
                    ],
                    'mini' => [
                        ['action' => 'thumbnail', 'width' => 50, 'height' => 50, 'quality' => 90]
                    ],
                ]
//                'imageActions' => [['action' => 'thumbnail', 'width' => '400', 'height' => '400'], ['action' => 'thumbnail', 'width' => '400', 'height' => '400']]

            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sum', 'quantity', 'price', 'ndsRate', 'ndsSum', 'nds18', 'nds10', 'calculationSubjectSign', 'calculationTypeSign', 'ndsNo', 'receipt_id'], 'integer'],
            [['modifiers'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['receipt_id'], 'exist', 'skipOnError' => true, 'targetClass' => Receipt::className(), 'targetAttribute' => ['receipt_id' => 'receipt_id']],
            ['image', 'image', 'extensions' => 'jpg, jpeg, gif, png', 'on' => ['insert', 'update']],
            [['date_of_manufacture'], 'safe']

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_id' => 'Item ID',
            'sum' => 'Sum',
            'quantity' => 'количество',
            'price' => 'Price',
            'name' => 'название',
            'ndsRate' => 'НДС',
            'ndsSum' => 'сумма НДС',
            'nds18' => 'НДС 18%',
            'nds10' => 'НДС 10%',
            'calculationSubjectSign' => 'Calculation Subject Sign',
            'calculationTypeSign' => 'Calculation Type Sign',
            'modifiers' => 'Modifiers',
            'ndsNo' => 'без ндс',
            'receipt_id' => 'Receipt ID',
            'reason' => 'причина  использования',
            'image' => 'путь  к картинке ',
            'description' => 'понятное описание ',
            'paymentType' => 'Payment Type',
            'nds' => 'Nds',
            'ndsCalculated10' => 'Nds Calculated10',
            'ndsCalculated18' => 'Nds Calculated18',
            'date_of_manufacture' => 'дата  изготовления',
            'goods_id' => 'идендификатор товара',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceipt()
    {
        return $this->hasOne(Receipt::class, ['receipt_id' => 'receipt_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasOne(Goods::class, ['goods_id' => 'goods_id']);
    }

    public function getAllGoods()
    {
        return ArrayHelper::map(Goods::find()->all(), 'goods_id', 'name');

    }

    /**
     * @return string
     */
    public function getFormatedPrice()
    {
        return number_format($this->price / 100, 2, '.', ' ');
    }

    /**
     * @return string
     */
    public function getFormatedSum()
    {
        return number_format($this->sum / 100, 2, '.', ' ');
    }

    public function addImage($path)
    {
        if (!is_file($path)) return false;
        $images = $this->getImagesAsArray();
        if (!in_array($path, $images))
            $images[] = $path;

        return $this->image = implode(':', $images);
    }

    public function getImagesAsArray()
    {
        return mb_strlen($this->image) > 0 ? explode(';', $this->image) : [];

    }

}
