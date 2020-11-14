<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%products_multimedia}}".
 *
 * @property integer $id_products_multimedia
 * @property integer $product_id
 * @property string $products_filepath
 * @property integer $flag_img_or_video
 *
 * @property ProductGemsPrices $product
 */
class ProductsMultimedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%products_multimedia}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'flag_img_or_video'], 'integer'],
            [['products_filepath'], 'string', 'max' => 245],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductGemsPrices::className(), 'targetAttribute' => ['product_id' => 'id_product']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_products_multimedia' => 'Id Products Multimedia',
            'product_id' => 'Product ID',
            'products_filepath' => 'Products Filepath',
            'flag_img_or_video' => 'Flag Img Or Video',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(ProductGemsPrices::className(), ['id_product' => 'product_id']);
    }
}
