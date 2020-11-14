<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%products_type_color_desc}}".
 *
 * @property integer $id_products_type_color_desc
 * @property integer $product_type_color_id
 * @property string $desc_products
 * @property string $desc_short_products
 *
 * @property ProductsTypeColorVariation $productTypeColor
 */
class ProductsTypeColorDesc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%products_type_color_desc}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_type_color_id'], 'integer'],
            [['desc_products', 'desc_short_products'], 'string'],
            [['product_type_color_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductsTypeColorVariation::className(), 'targetAttribute' => ['product_type_color_id' => 'id_products_type_color_variation']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_products_type_color_desc' => 'Id Products Type Color Desc',
            'product_type_color_id' => 'Product Type Color ID',
            'desc_products' => 'Desc Products',
            'desc_short_products' => 'Desc Short Products',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTypeColor()
    {
        return $this->hasOne(ProductsTypeColorVariation::className(), ['id_products_type_color_variation' => 'product_type_color_id']);
    }
}
