<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%products_type_desc}}".
 *
 * @property integer $id_product_type_desc
 * @property integer $product_type_id
 * @property string $desc_products
 * @property string $desc_short_products
 *
 * @property ProductType $productType
 */
class ProductsTypeDesc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%products_type_desc}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_type_id'], 'integer'],
            [['desc_products', 'desc_short_products'], 'string'],
            [['product_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductType::className(), 'targetAttribute' => ['product_type_id' => 'id_product_type']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_product_type_desc' => 'Id Product Type Desc',
            'product_type_id' => 'Product Type ID',
            'desc_products' => 'Desc Products',
            'desc_short_products' => 'Desc Short Products',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductType()
    {
        return $this->hasOne(ProductType::className(), ['id_product_type' => 'product_type_id']);
    }
}
