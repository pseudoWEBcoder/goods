<?php

namespace common\models;

/**
 * This is the model class for table "properties_values".
 *
 * @property int $id
 * @property int $goods_id ID товара
 * @property int $properties_id ID  свойства
 * @property string $value значение
 *
 * @property Goods $goods
 * @property GoodsProperties $properties
 */
class PropertiesValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'properties_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'properties_id', 'value'], 'required'],
            [['goods_id', 'properties_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['goods_id'], 'exist', 'skipOnError' => true, 'targetClass' => Goods::className(), 'targetAttribute' => ['goods_id' => 'goods_id']],
            [['properties_id'], 'exist', 'skipOnError' => true, 'targetClass' => GoodsProperties::className(), 'targetAttribute' => ['properties_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goods_id' => 'ID товара',
            'properties_id' => 'ID  свойства',
            'value' => 'значение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasOne(Goods::className(), ['goods_id' => 'goods_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperties()
    {
        return $this->hasOne(GoodsProperties::className(), ['id' => 'properties_id']);
    }
}
