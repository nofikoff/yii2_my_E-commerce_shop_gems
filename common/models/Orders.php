<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%orders}}".
 *
 * @property integer $id_orders
 * @property string $name_orders
 * @property integer $id_customers
 * @property integer $date_added
 * @property integer $date_updated
 *
 * @property User $idCustomers
 * @property OrdersProducts $ordersProducts
 */
class Orders extends \yii\db\ActiveRecord
{
    public $name;
    public $address;
    public $email;
    public $phone;
    public $comment;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%orders}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_customers', 'date_added', 'date_updated'], 'integer'],
            [['name_orders'], 'string', 'max' => 45],
            [['email','phone','name'], 'required'],
            [['name','address','email','phone','comments', 'contacts'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['id_customers'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_customers' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_orders' => 'ID',
            'name_orders' => 'Name Orders',
            'id_customers' => 'Id Customers',
            'date_added' => 'Date Added',
            'date_updated' => 'Date Updated',
            'comments' => 'Comments',
            'contacts' => 'Contacts',

            'name' => Yii::t('app', 'Имя'),
            'email' => 'E-mail',
            'address' => Yii::t('app', 'Адрес'),
            'phone' => Yii::t('app', 'Телефон'),



        ];
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCustomers()
    {
        return $this->hasOne(User::className(), ['id' => 'id_customers']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdersProducts()
    {
        return $this->hasMany(OrdersProducts::className(), ['id_orders_products' => 'id_orders']);
    }
}
