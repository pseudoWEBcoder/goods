<?php

namespace common\models;

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

    public static function rus2translit($string,  $dir =  'ru-en')
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
        return strtr($string,$dir ==  'ru-en'? $converter: array_flip($converter));
    }
    public function behaviors()
    {
        return [
            [
                'class' => \mongosoft\file\UploadImageBehavior::class,
                'attribute' => 'image',
                'scenarios' => ['insert', 'update'],
                'placeholder' => '@app/modules/user/assets/images/userpic.jpg',
                'path' => '@common/upload/images/{id}',
                'url' => '@web/upload/user/{id}',
                'thumbs' => [
                    'thumb' => ['width' => 400, 'quality' => 90],
                    'preview' => ['width' => 200, 'height' => 200],
                    'news_thumb' => ['width' => 200, 'height' => 200, 'bg_color' => '000'],
                ],
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
            'formatedPrice' => 'цена',
            'formatedSum' => 'сумма',
            'name' => 'название',
            'ndsRate' => 'НДС',
            'ndsSum' => 'сумма  НДС',
            'nds18' => 'НДС 18%',
            'nds10' => 'НДС 10%',
            'calculationSubjectSign' => 'Calculation Subject Sign',
            'calculationTypeSign' => 'Calculation Type Sign',
            'modifiers' => 'Modifiers',
            'ndsNo' => 'без ндс',
            'receipt_id' => 'Receipt ID',
            'attachments' => 'файлы'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceipt()
    {
        return $this->hasOne(Receipt::className(), ['receipt_id' => 'receipt_id']);
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
        return mb_strlen($this->image)>0?explode(';', $this->image):[];

    }

}
