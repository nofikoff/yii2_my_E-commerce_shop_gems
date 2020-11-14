<?php

namespace common\models;

use himiklab\sitemap\behaviors\SitemapBehavior;
use Yii;
use common\helpers\Image;
use common\models\ProductGemsPrices;

/**
 * This is the model class for table "{{%products_type_color_variation}}".
 *
 * @property integer $id_products_type_color_variation
 * @property integer $type_product_id
 * @property integer $color_product_id
 * @property integer $description_id
 *
 * @property ProductsTypeColorDesc[] $productsTypeColorDescs
 * @property ProductsTypeColorMultimedia[] $productsTypeColorMultimedia
 * @property ProductsColors $colorProduct
 * @property ProductType $typeProduct
 */
class ProductsTypeColorVariation extends \yii\db\ActiveRecord
{
    public $desc_products;
    public $desc_short_products;
    public $desc_products_ua;
    public $desc_short_products_ua;
    public $file;
    public $del_img;
    public $shape;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%products_type_color_variation}}';
    }


    public function behaviors()
    {
        return [


            'sitemap' => [
                'class' => SitemapBehavior::className(),
                'scope' => function ($model) {
                    /** @var \yii\db\ActiveQuery $model */
                    $model->select(['id_products_type_color_variation']);
                    //$model->andWhere(['publish' => 1]); похер
                    $model->OrderBy(['id_products_type_color_variation' => SORT_DESC]);
                    if (isset($_GET['page']))
                        $model->offset(($_GET['page'] - 1) * 50000);
                    $model->limit(50000);
                },
                'dataClosure' => function ($model) {
                    /** @var self $model */
                    return [
                        'loc' => "shop/item?id=" . $model->id_products_type_color_variation,
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
            [['type_product_id', 'color_product_id', 'description_id'], 'integer'],
            [['color_product_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductsColors::className(), 'targetAttribute' => ['color_product_id' => 'id_color']],
            [['type_product_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductType::className(), 'targetAttribute' => ['type_product_id' => 'id_product_type']],
            [['file'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 30],
            [['del_img'], 'boolean'],
            [['order_waight','desc_products', 'file', 'shape', 'desc_short_products', 'desc_products_ua', 'desc_short_products_ua'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_products_type_color_variation' => 'Id Products Type Color Variation',
            'type_product_id' => 'Type Product ID',
            'color_product_id' => 'Color Product ID',
            'description_id' => 'Description ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsTypeColorDescs()
    {
        return $this->hasOne(ProductsTypeColorDesc::className(), ['product_type_color_id' => 'id_products_type_color_variation']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsTypeColorMultimedia()
    {
        if (!$this->shape) $this->shape = 1;
        //return $this->hasOne(ProductsTypeColorMultimedia::className(), ['product_type_color_id' => 'id_products_type_color_variation']);
        return $this->hasMany(ProductsTypeColorMultimedia::className(), ['product_type_color_id' => 'id_products_type_color_variation'])->where(['=', 'shape_id', $this->shape])->one();
    }

    public function getProductsTypeColorImage($shape)
    {
        return $this->hasMany(ProductsTypeColorMultimedia::className(), ['product_type_color_id' => 'id_products_type_color_variation'])->where(['=', 'shape_id', $shape])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColorProduct()
    {
        return $this->hasOne(ProductsColors::className(), ['id_color' => 'color_product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeProduct()
    {
        return $this->hasOne(ProductType::className(), ['id_product_type' => 'type_product_id']);
    }


    public function getProductGemsPrices()
    {
        return $this->hasMany(ProductGemsPrices::className(), ['type_product_id' => 'type_product_id', 'color_id' => 'color_product_id']);
    }

    public function getMinCost()
    {
        $curr = Yii::$app->currency->getCurrency();
        $models = $this->productGemsPrices;
        $min = 0;
        foreach ($models as $model) {
            if ($min > $model->price || $min == 0) $min = $model->price;
        }
        return (round($min / $curr->course_currency, 2)) . ' ' . $curr->name_currency;
    }


    public function getPreviewImage()
    {
        if (isset($this->productsTypeColorMultimedia->products_filepath)) {
            return '<img class="img-fluid" src="' . (Yii::getAlias('@site') . '' . $this->productsTypeColorMultimedia->products_filepath) . '" >';
        } else {
            return false;
        }
    }


    // получить картинку согласно Сущности и его Формы огранки
    public function getImage($shape)
    {
        $image = $this->getProductsTypeColorImage($shape);
        if (isset($image->products_filepath)) {
            return ('' . $image->products_filepath);
            //
        } else {
            // попытаемся взять эскиз формы без цветный
            $outline = '/images/cuts-of-gemstones-outline/' . $shape . '.gif';
            if (file_exists(Yii::getAlias('@frontend') . '/web' . $outline))
                return $outline;
        }
        //иначе нахер
        return '/img-gems/no-foto.jpg';
//$image = $this->getProductsTypeColorImage($shape);
//if (isset($image->products_filepath)) {
//return ('' . $image->products_filepath.'-222222');
//} else {
//    if (isset($this->typeProduct->image)) {
//        return $this->typeProduct->image.'-333333';
//    }

//        if (isset($this->productsTypeColorMultimedia->products_filepath)) {
//            return ('' . $this->productsTypeColorMultimedia->products_filepath.'-444444');
//        } else {
//            if (isset($this->typeProduct->image)) {
//                return $this->typeProduct->image.'-5555555';
//            }
//        }
    }

    public function thumb($width = null, $height = null, $shape, $crop = true)
    {
        // временно заблокиеум тк в админке проблемы :
        // public_html/backend/views/products-type-color-variation/index.php
        // вызывается thumb без шейп и дает ошибку
        return $this->getImage($shape);
        return $this->getImage($shape);
        return $this->getImage($shape);
        return $this->getImage($shape);

        if ($this->getImage($shape) && ($width || $height)) {
            return Image::thumb($this->getImage($shape), $width, $height, $crop);
        }
        return Image::thumb('/img-gems/no-foto.jpg', $width, $height, $crop);

        return '';
    }


    public function getImageurl_____()
    {

        print_r($this->productsTypeColorMultimedia);
        exit;
        return Yii::getAlias('@site') . '/upload/products_color/' . $this->productsTypeColorMultimedia->products_filepath;
    }

    public function getContentSeo()
    {
        if (isset($this->productsTypeColorDescs->product_type_color_id))
            if (Yii::$app->language == 'uk') {

                return $this->productsTypeColorDescs->desc_products_ua;
            } else
                return $this->productsTypeColorDescs->desc_products;

        else return '';
    }

    public function getContentShort()
    {
        if (isset($this->productsTypeColorDescs->product_type_color_id))
            if (Yii::$app->language == 'uk') {

                return $this->productsTypeColorDescs->desc_short_products_ua;
            } else
                return $this->productsTypeColorDescs->desc_short_products;

        else return '';
    }

    public function getName()
    {
        return $this->typeProduct->name . ' ' . $this->colorProduct->name;
    }

    public function getId()
    {
        return $this->id_products_type_color_variation;
    }
}
