<?php

namespace common\models;

use himiklab\sitemap\behaviors\SitemapBehavior;
use Yii;

/**
 * This is the model class for table "{{%products_shapes}}".
 *
 * @property integer $id_shape
 * @property string $name_shape
 * @property string $img_shape
 *
 * @property 1cparserGemshapes[] $1cparserGemshapes
 * @property ProductGemsPrices[] $productGemsPrices
 */
class ProductsShapes extends \yii\db\ActiveRecord
{
    public $file;
    public $del_img;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%products_shapes}}';
    }


    public function behaviors()
    {
        return [

            'sitemap' => [
                'class' => SitemapBehavior::className(),
                'scope' => function ($model) {
                    /** @var \yii\db\ActiveQuery $model */
                    $model->select(['id_shape']);
                    //$model->andWhere(['publish' => 1]); похер
                    $model->OrderBy(['id_shape' => SORT_DESC]);
                    if (isset($_GET['page']))
                        $model->offset(($_GET['page'] - 1) * 50000);
                    $model->limit(50000);
                },
                'dataClosure' => function ($model) {
                    /** @var self $model */
                    return [
                        'loc' => "shop?FilterForm[shape]=" . $model->id_shape,
                        // в новостях каокго тохера левая дата в базе
                        //'lastmod' => ($model->created_at == '') ? date('Y-m-d h:i:s') : date('Y-m-d h:i:s', $model->created_at),
                        'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
                        'priority' => 0.5
                    ];
                }
            ],


        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_shape', 'name_shape_ua'], 'string', 'max' => 45],
            [['img_shape'], 'string', 'max' => 245],
            [['name_shape'], 'unique'],
            [['status_disabled', 'desc_uk', 'desc_ru'], 'safe'],

            [['file'], 'file', 'extensions' => 'png, jpg'],
            [['del_img'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_shape' => 'Id Shape',
            'name_shape' => 'Name Shape',
            'img_shape' => 'Img Shape',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function get1cparserGemshapes()
    {
        //return $this->hasMany(1cparserGemshapes::className(), ['product_shape_id' => 'id_shape']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductGemsPrices()
    {
        return $this->hasMany(ProductGemsPrices::className(), ['shape' => 'id_shape']);
    }
    
    public function getPreviewImage()
    {
        if (isset($this->img_product_type)) {
            return  '<img class="img-fluid" src="'.(Yii::getAlias('@site').'/upload/products_shape/'.$this->img_shape).'" >';
        } else {
            return false;
        }
    }
    
    public function getImageurl()
    {
        return Yii::getAlias('@site').'/upload/products_shape/'.$this->img_shape;
    }
    
    public function getContent()
    {
        if (Yii::$app->language == 'uk')
            return $this->name_shape_ua;
        else 
            return $this->name_shape;
    }   
     
    public function getName()
    {
        if (Yii::$app->language == 'uk')
            return $this->name_shape_ua;
        else 
            return $this->name_shape;
    }
}
