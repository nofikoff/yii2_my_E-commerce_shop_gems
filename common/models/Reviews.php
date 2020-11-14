<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "{{%reviews}}".
 *
 * @property integer $id_review
 * @property integer $product_type_id
 * @property string $author_review
 * @property string $status_review
 * @property string $text_review
 * @property string $author_city
 * @property string $author_IP
 *
 * @property ProductType $productType
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%reviews}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_type_id', 'text_review'], 'required'],
            [['id_review', 'product_type_id'], 'integer'],
            [['author_review', 'status_review', 'text_review', 'author_city', 'author_IP'], 'string', 'max' => 45],
            [['product_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductType::className(), 'targetAttribute' => ['product_type_id' => 'id_product_type']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_review' => 'Id Review',
            'product_type_id' => 'Product Type ID',
            'author_review' => 'Автор',
            'status_review' => 'Status Review',
            'text_review' => 'Отзыв',
            'author_city' => 'Author City',
            'author_IP' => 'Author  Ip',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductType()
    {
        return $this->hasOne(ProductType::className(), ['id_product_type' => 'product_type_id']);
    }
    
    public function getStatus()
    {
        return [0 => 'модерация', 1 => 'утвержден'];
    }
    
    public static function search($params) {

        $query = Reviews::find();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 30,
            ],
        ]);

        if ($params) {
            if (isset($params['product_type_id']) && $params['product_type_id']){
                $query->andWhere(['=', 'product_type_id', $params['product_type_id']]);
            }
            if (isset($params['status_review']) && $params['status_review']){
                $query->andWhere(['=', 'status_review', $params['status_review']]);
            }
        }

        return $dataProvider;
    }
}
