<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%product_price_group}}".
 *
 * @property integer $id_price_group
 * @property string $name_price_group
 * @property string $desc_price_group
 * @property string $amount_price_group
 *
 * @property ProductType[] $productTypes
 */
class ProductPriceGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_price_group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc_price_group'], 'string'],
            [['name_price_group', 'amount_price_group'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_price_group' => 'Id Price Group',
            'name_price_group' => 'Name Price Group',
            'desc_price_group' => 'Desc Price Group',
            'amount_price_group' => 'Amount Price Group',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTypes()
    {
        return $this->hasMany(ProductType::className(), ['price_group_id' => 'id_price_group']);
    }
}
