<?php

namespace common\models;

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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertiesValues()
    {
        return $this->hasMany(PropertiesValues::className(), ['goods_id' => 'goods_id']);
    }
}
