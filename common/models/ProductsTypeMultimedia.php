<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%products_type_multimedia}}".
 *
 * @property integer $id_products_type_multimedia
 * @property integer $product_type_id
 * @property string $products_filepath
 * @property integer $flag_img_or_video
 *
 * @property ProductType $productType
 */
class ProductsTypeMultimedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%products_type_multimedia}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_type_id', 'flag_img_or_video'], 'integer'],
            [['products_filepath'], 'string', 'max' => 245],
            [['product_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductType::className(), 'targetAttribute' => ['product_type_id' => 'id_product_type']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_products_type_multimedia' => 'Id Products Type Multimedia',
            'product_type_id' => 'Product Type ID',
            'products_filepath' => 'Products Filepath',
            'flag_img_or_video' => 'Flag Img Or Video',
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
