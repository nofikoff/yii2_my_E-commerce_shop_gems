<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%product_desc}}".
 *
 * @property integer $id_product_desc
 * @property integer $product_id
 * @property string $desc_products
 * @property string $desc_short_products
 * @property string $desc_products_uk
 * @property string $desc_short_products_uk
 *
 * @property ProductGemsPrices $product
 */
class ProductDesc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_desc}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [[
                'country_name_ru',
                'country_name_uk',

                'name_suffix_ru',
                'name_suffix_uk',

                'desc_products_ru',
                'desc_products_uk',

                'nabor_seo_desc_ru',
                'nabor_seo_desc_uk',

                'nabor_notes_ru',
                'nabor_notes_uk',

                'seo_title_ru',
                'seo_title_uk',

                'seo_keywords_ru',
                'seo_keywords_uk',

                'seo_desc_ru',
                'seo_desc_uk',

            ], 'string'],

            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductGemsPrices::className(), 'targetAttribute' => ['product_id' => 'id_product']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_product_desc' => 'Id Product Desc',
            'product_id' => 'Product ID',
            'desc_products' => 'Desc Products',
            'desc_short_products' => 'Desc Short Products',
            'desc_products_uk' => 'Desc Products Ua',
            'desc_short_products_uk' => 'Desc Short Products Ua',
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
