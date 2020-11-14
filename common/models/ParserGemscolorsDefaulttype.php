<?php

namespace common\models;


use Yii;

/**
 * This is the model class for table "my_1cparser_gemscolors_defaulttype".
 *
 * @property integer $id_1cparser_gcdt
 * @property integer $product_type_id
 * @property integer $product_color_id
 *
 * @property MyProductType $productType
 * @property MyProductsColors $productColor
 */
class ParserGemscolorsDefaulttype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'my_1cparser_gemscolors_defaulttype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_1cparser_gcdt'], 'safe'],
            [['product_type_id', 'product_color_id'], 'integer'],
            [['product_type_id', 'product_color_id'], 'unique', 'targetAttribute' => ['product_type_id', 'product_color_id'], 'message' => 'The combination of Product Type ID and Product Color ID has already been taken.'],
            [['product_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductType::className(), 'targetAttribute' => ['product_type_id' => 'id_product_type']],
            [['product_color_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductsColors::className(), 'targetAttribute' => ['product_color_id' => 'id_color']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_1cparser_gcdt' => 'Id 1cparser Gcdt',
            'product_type_id' => 'Тип камня',
            'product_color_id' => 'Цвет камня',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductType()
    {
        return $this->hasOne(ProductType::className(), ['id_product_type' => 'product_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsColors()
    {
        return $this->hasOne(ProductsColors::className(), ['id_color' => 'product_color_id']);
    }
}
