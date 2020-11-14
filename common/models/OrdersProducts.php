<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%orders_products}}".
 *
 * @property integer $id_orders_products
 * @property string $name_orders_products
 *
 * @property Orders $idOrdersProducts
 */
class OrdersProducts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%orders_products}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_orders_products','id_product','price','quantity','summ'], 'required'],
            [['name_orders_products'], 'string', 'max' => 45],
            [['id_orders_products'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['id_orders_products' => 'id_orders']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_orders_products' => 'Id Orders Products',
            'name_orders_products' => 'Name Orders Products',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdOrdersProducts()
    {
        return $this->hasOne(Orders::className(), ['id_orders' => 'id_orders_products']);
    }
}
