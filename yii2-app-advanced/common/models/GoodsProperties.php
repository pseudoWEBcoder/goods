<?php

namespace common\models;

/**
 * This is the model class for table "goods_properties".
 *
 * @property int $id
 * @property string $name
 * @property string $type тип
 *
 * @property PropertiesValues[] $propertiesValues
 */
class GoodsProperties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_properties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['name', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'тип',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertiesValues()
    {
        return $this->hasMany(PropertiesValues::className(), ['properties_id' => 'id']);
    }
}
