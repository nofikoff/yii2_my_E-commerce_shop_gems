<?php

namespace common\models;
use common\helpers\Image;
use himiklab\sitemap\behaviors\SitemapBehavior;
use Yii;

/**
 * This is the model class for table "{{%product_type}}".
 *
 * @property integer $id_product_type
 * @property string $name_product_type
 * @property string $name_product_type_ua
 * @property string $img_product_type
 * @property integer $price_group_id
 *
 * @property 1cparserGemscolorsDefaulttype[] $1cparserGemscolorsDefaulttypes
 * @property ProductsColors[] $productColors
 * @property 1cparserGemstypes[] $1cparserGemstypes
 * @property ProductGemsPrices[] $productGemsPrices
 * @property ProductPriceGroup $priceGroup
 * @property ProductsTypeColorVariation[] $productsTypeColorVariations
 * @property ProductsTypeDesc[] $productsTypeDescs
 * @property ProductsTypeMultimedia[] $productsTypeMultimedia
 * @property Reviews[] $reviews
 */
class ProductType extends \yii\db\ActiveRecord
{
    public $file;
    public $del_img;
    public $desc_products;
    public $desc_short_products;
    public $desc_products_ua;
    public $desc_short_products_ua;
    public $file_multimedia;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_type}}';
    }


    public function behaviors()
    {
        return [

            'sitemap' => [
                'class' => SitemapBehavior::className(),
                'scope' => function ($model) {
                    /** @var \yii\db\ActiveQuery $model */
                    $model->select(['id_product_type']);
                    //$model->andWhere(['publish' => 1]); похер
                    $model->OrderBy(['id_product_type' => SORT_DESC]);
                    if (isset($_GET['page']))
                        $model->offset(($_GET['page'] - 1) * 50000);
                    $model->limit(50000);
                },
                'dataClosure' => function ($model) {
                    /** @var self $model */
                    return [
                        'loc' => "shop?FilterForm[type]=" . $model->id_product_type,
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
            [['img_product_type'], 'string'],
            [['price_group_id', 'status_disabled'], 'integer'],
            [['name_product_type', 'name_product_type_ua'], 'string', 'max' => 145],
            [['name_product_type'], 'unique'],
            [['name_product_type_ua'], 'unique'],
            [['name_product_type'], 'required'],
            [['file'], 'file', 'extensions' => 'png, jpg'],
            [['del_img'], 'boolean'],
            [['price_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductPriceGroup::className(), 'targetAttribute' => ['price_group_id' => 'id_price_group']],
            [['desc_products', 'desc_short_products', 'desc_products_ua', 'desc_short_products_ua'], 'safe' ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_product_type' => 'ID',
            'name_product_type' => 'Name Product Type',
            'name_product_type_ua' => 'Name Product Type Ua',
            'img_product_type' => 'Img Product Type',
            'price_group_id' => '1-4',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductColors()
    {
        return $this->hasMany(ProductsColors::className(), ['id_color' => 'product_color_id'])->viaTable('{{%1cparser_gemscolors_defaulttype}}', ['product_type_id' => 'id_product_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductGemsPrices()
    {
        return $this->hasMany(ProductGemsPrices::className(), ['type_product_id' => 'id_product_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriceGroup()
    {
        return $this->hasOne(ProductPriceGroup::className(), ['id_price_group' => 'price_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsTypeColorVariation()
    {
        return $this->hasMany(ProductsTypeColorVariation::className(), ['type_product_id' => 'id_product_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsTypeDescs()
    {
        return $this->hasMany(ProductsTypeDesc::className(), ['product_type_id' => 'id_product_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsTypeMultimedia()
    {
        return $this->hasMany(ProductsTypeMultimedia::className(), ['product_type_id' => 'id_product_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Reviews::className(), ['product_type_id' => 'id_product_type']);
    }
    
    public function getPreviewImage()
    {
        if (isset($this->img_product_type)) {
            return  '<img class="img-fluid" src="'.(Yii::getAlias('@site').'/upload/product_type/'.$this->img_product_type).'" >';
        } else {
            return false;
        }
    }
    
    public function getImage()
    {
        if (isset($this->img_product_type)) {
            return  ('/upload/product_type/'.$this->img_product_type);
        } else {
            return false;
        }
    }
    
    public function thumb($width = null, $height = null, $crop = true)
    {
        if($this->image && ($width || $height)){
            return Image::thumb($this->image, $width, $height, $crop);
        }
        return '';
    }
    
    public function getImageurl()
    {
        return Yii::getAlias('@site').'/upload/product_type/'.$this->img_product_type;
    }
    
    public function getContent()
    {
        if (Yii::$app->language == 'uk')
            return $this->name_product_type_ua;
        else 
            return $this->name_product_type;
    }
    
    public function getName()
    {
        if (Yii::$app->language == 'uk')
            return $this->name_product_type_ua;
        else 
            return $this->name_product_type;
    }
}
