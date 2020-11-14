<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%products_sales}}".
 *
 * @property integer $id_products_sales
 * @property integer $product_id
 * @property integer $price_sale
 * @property string $price_sale_enum
 * @property string $added_product_sales
 * @property string $expires_date_product_sales
 * @property integer $status
 *
 * @property ProductGemsPrices $product
 */
class ProductsSales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%products_sales}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'price_sale', 'status'], 'integer'],
            [['price_sale_enum'], 'string'],
            [['added_product_sales', 'expires_date_product_sales'], 'safe'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductGemsPrices::className(), 'targetAttribute' => ['product_id' => 'id_product']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_products_sales' => 'Id Products Sales',
            'product_id' => 'Product ID',
            'price_sale' => 'Размер скидки (в валюте или в процентах)',
            'price_sale_enum' => 'Единицы измерения скидки (в валюте или в процентах)',
            'added_product_sales' => 'Дата создания скидки',
            'expires_date_product_sales' => 'Дата действия скидки',
            'status' => 'Статус',
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
