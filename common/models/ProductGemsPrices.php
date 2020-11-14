<?php

namespace common\models;

use himiklab\sitemap\behaviors\SitemapBehavior;
use Yii;
use common\helpers\Image;
use yz\shoppingcart\CartPositionProviderInterface;

/**
 * This is the model class for table "{{%product_gems_prices}}".
 *
 * @property integer $id_product
 * @property integer $type_product_id
 * @property string $name_suffix
 * @property string $sku
 * @property string $size_h
 * @property string $size_w
 * @property string $size_d
 * @property integer $shape
 * @property string $weight
 * @property string $characteristics_str
 * @property integer $treatment_type
 * @property integer $synthetic_type
 * @property integer $exclusive_type
 * @property integer $recommended_type
 * @property integer $country_id
 * @property integer $color_id
 * @property string $price
 * @property string $price_promo
 * @property string $stock_points
 * @property string $stock_karats
 * @property string $date_added
 * @property string $date_updated
 * @property integer $this_is_nabor
 *
 * @property ProductDesc[] $productDescs
 * @property ProductsColors $color
 * @property ProductsShapes $shape0
 * @property ProductType $typeProduct
 * @property ProductsMultimedia[] $productsMultimedia
 * @property ProductsSales[] $productsSales
 */
class ProductGemsPrices extends \yii\db\ActiveRecord implements CartPositionProviderInterface
{
    use \yz\shoppingcart\CartPositionTrait;


    // Хранятся в отдельной таблице, и вытаскиваются спец функцией ниже
    // эти во внешеней таблице ЗДЕСЬ НУЖНЫ ЧТОБЫ В АДМИНК В ФОРМЕ ВЫВЕСТИ
    public $country_name_ru;
    public $country_name_uk;

    public $name_suffix_ru;
    public $name_suffix_uk;

    public $desc_products_ru;
    public $desc_products_uk;

    public $nabor_seo_desc_ru;
    public $nabor_seo_desc_uk;

    public $nabor_notes_ru;
    public $nabor_notes_uk;

    public $seo_title_ru;
    public $seo_title_uk;

    public $seo_keywords_ru;
    public $seo_keywords_uk;

    public $seo_desc_ru;
    public $seo_desc_uk;


    public $file;
    public $del_img;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_gems_prices}}';
    }



    public function behaviors()
    {
        return [


            'sitemap' => [
                'class' => SitemapBehavior::className(),
                'scope' => function ($model) {
                    /** @var \yii\db\ActiveQuery $model */
                    $model->select(['id_product', 'last_update']);
                    //$model->andWhere(['publish' => 1]); похер
                    $model->OrderBy(['last_update' => SORT_DESC]);
                    if (isset($_GET['page']))
                        $model->offset(($_GET['page'] - 1) * 50000);
                    $model->limit(50000);
                },
                'dataClosure' => function ($model) {
                    /** @var self $model */
                    return [
                        'loc' => "shop/gems?id=" . $model->id_product,
                        // в новостях каокго тохера левая дата в базе
                        //'lastmod' => ($model->created_at == '') ? date('Y-m-d h:i:s') : date('Y-m-d h:i:s', $model->created_at),
                        'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
                        'priority' => 0.3
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
            [['type_product_id', 'shape', 'treatment_type', 'synthetic_type', 'exclusive_type', 'recommended_type', 'color_id', 'this_is_nabor'], 'integer'],
            [['size_h', 'size_w', 'size_d', 'weight', 'price', 'exclusiv_priceper_carat', 'price_promo', 'stock_points', 'stock_karats', 'nabor_numberstones'], 'number'],
            [['name_suffix', 'sku'], 'string', 'max' => 45],
            [['characteristics_str', 'exclusiv_params_colorcryst', 'exclusiv_priceper_stone'], 'string', 'max' => 245],
            [['color_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductsColors::className(), 'targetAttribute' => ['color_id' => 'id_color']],
            [['shape'], 'exist', 'skipOnError' => true, 'targetClass' => ProductsShapes::className(), 'targetAttribute' => ['shape' => 'id_shape']],
            [['type_product_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductType::className(), 'targetAttribute' => ['type_product_id' => 'id_product_type']],
            [['price',], 'required'],
            [['file'], 'file', 'extensions' => 'png, jpg, xls, xlsx'],
            [['del_img'], 'boolean'],
            [['brand',

                'file', 'nabor_sizestones', 'nabor_weightstones',

                // эти во внешеней таблице ЗДЕСЬ НУЖНЫ ЧТОБЫ В АДМИНК В ФОРМЕ ВЫВЕСТИ
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
                'date_added',

            ], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_product' => 'Id Product',
            'type_product_id' => 'ТИП КАМНЯ',
            'name_suffix' => 'ИМЕНИ СУФФИКС ',
            'sku' => 'АРТИКУЛ',
            'size_h' => 'Size H',
            'size_w' => 'Size W',
            'size_d' => 'Size D',
            'shape' => 'ОГРАНКИ ФОРМА',
            'weight' => 'ВЕС',
            'characteristics_str' => 'ХАРАКТЕРИСТИКИ МЕТА',
            'treatment_type' => 'Машинная или ручная огранка/ обработка',
            'synthetic_type' => 'Синтетический или натуральный?',
            'exclusive_type' => 'ЭКСКЛЮЗИВНОСТЬ',
            'recommended_type' => 'РЕКОМЕНДУЕМ',
            'country_id' => 'СТРАНА ПРОИСХОЖДЕНИЯ',
            'color_id' => 'ЦВЕТ',
            'price' => 'ЦЕНА',
            'price_promo' => 'ЦЕНА АКЦИОННАЯ ',
            'stock_points' => 'Наличие на складе ',
            'stock_karats' => 'Наличие на складе объем в каратах',
            'date_added' => 'ДАТА ДОБАВЛЕНИЯ (используется для НОвинок на главной) ',
            'date_updated' => 'ДАТА ОБНОВЛЕНИЯ ',
            'this_is_nabor' => 'НАБОР камней',
            'brand' => 'Бренд',

        ];
    }

    public function getCartPosition($params = [])
    {
        return \Yii::createObject([
            'class' => 'common\models\ProductCartPosition',
            'id' => $this->id_product,
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductDescs()
    {
        return $this->hasOne(ProductDesc::className(), ['product_id' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColor()
    {
        return $this->hasOne(ProductsColors::className(), ['id_color' => 'color_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShape0()
    {
        return $this->hasOne(ProductsShapes::className(), ['id_shape' => 'shape']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeProduct()
    {
        return $this->hasOne(ProductType::className(), ['id_product_type' => 'type_product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsMultimedia()
    {
        return $this->hasMany(ProductsMultimedia::className(), ['product_id' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsSales()
    {
        return $this->hasMany(ProductsSales::className(), ['product_id' => 'id_product']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsTypeColorVariation()
    {
        return $this->hasOne(ProductsTypeColorVariation::className(), ['type_product_id' => 'type_product_id', 'color_product_id' => 'color_id']);
    }

    public function getAction()
    {
        return ProductsSales::findOne(['product_id' => $this->id, 'status' => 1]);
    }

    public function getActionPrice()
    {
        // по курсу скидка
        $currency = Yii::$app->currency->getCurrency();
        //
        //валюта или %
        $act_currency = ($this->action->price_sale_enum == 'currency' ? $currency->name_currency : '%');
        if ($act_currency == '%') return number_format($this->action->price_sale, 0, ',', '') . '%';

        $act_price = $this->action->price_sale / $currency->course_currency;
        return number_format($act_price, 2, ',', ' ') . ' ' . $act_currency . "";

    }

    public function getPreviewImage()
    {
        if (isset($this->productsMultimedia[0]->products_filepath)) {
            return '<img class="img-fluid" src="' . (Yii::getAlias('@site') . '/upload/products/' . $this->productsMultimedia->products_filepath) . '" >';
        } else {
            return false;
        }
    }

    public function getImage()
    {
        if (isset($this->productsMultimedia[0]->products_filepath)) {
            //return  ('/upload/products/'.$this->productsMultimedia->products_filepath);
            return ($this->productsMultimedia[0]->products_filepath);
        } else {
            if (isset($this->typeProduct->image)) {
                return $this->typeProduct->image;
            }
        }
        return '/img-gems/no-foto.jpg';
    }

    public function thumb($width = null, $height = null, $crop = true)
    {
        if ($this->image && ($width || $height)) {
            return Image::thumb($this->image, $width, $height, $crop);
        }
        return Image::thumb('/img-gems/no-foto.jpg', $width, $height, $crop);
        return '';
    }

    public function getFullImages()
    {
        if (isset($this->productsMultimedia)) {
            //return  ('/upload/products/'.$this->productsMultimedia->products_filepath);
            return ($this->productsMultimedia);
        } else {
            if (isset($this->typeProduct->image)) {
                return [0 => $this->typeProduct->image];
            }
        }
        return [0 => '/img-gems/no-foto.jpg'];
    }

    public function thumbImages($width = null, $height = null, $crop = true)
    {

        $r = [];
        foreach ($this->fullImages as $a) {
            $r[] = Image::thumb($a->products_filepath, $width, $height, $crop);
        }

        if (!sizeof($r))
            $r[] = Image::thumb('/img-gems/no-foto.jpg', $width, $height, $crop);

        return $r;

//        if ($this->image && ($width || $height)) {
//            return Image::thumb($this->image, $width, $height, $crop);
//        }
//        return [0 => Image::thumb('/img-gems/no-foto.jpg', $width, $height, $crop)];
    }


    public function getImageurl()
    {
        if (isset($this->productsMultimedia->products_filepath)) {
            return Yii::getAlias('@site') . '' . $this->productsMultimedia->products_filepath;
        }
        return '';
    }


    public function getId()
    {
        return $this->id_product;
    }


    public function getCost($otherPrice = 0)
    {
        // если функцию ничего неп ердается
        if (!$otherPrice) $otherPrice = $this->price;

        $curr = Yii::$app->currency->getCurrency();
        setlocale(LC_MONETARY, 'en_US');
        /** ВАЖНО ЗДЕСЬ ВЫВОДИ С ТОЧКОЙ и без <nobr> ! ибо в шаблонахз сравнение ит цен
         * // и в шаблоне потом переворачивай формат как хош
         * // и в шаблоне потом переворачивай формат как хош
         * // и в шаблоне потом переворачивай формат как хош
         * // и в шаблоне потом переворачивай формат как хош
         **/
        // если передан ноль или цена нулевая у модеи
        if ($otherPrice == 0)
            return '';
        else
            // ВНИМАНИЕ ЗДЕСЬ НУЖНА ЦИФРА ДЕСТИЯНАЯ БЕЗ АМЕРИКОСВСКИХ ПОБЛЕЛОВ БЕЗ ЗАПЯТЫХ
            // ВНИМАНИЕ ЗДЕСЬ НУЖНА ЦИФРА ДЕСТИЯНАЯ БЕЗ АМЕРИКОСВСКИХ ПОБЛЕЛОВ БЕЗ ЗАПЯТЫХ
            // ИБО В КОРИНЕ С НЕЙ РАСЧЕТВ ДА И КОЕ ГДЕ ТОЖЕ
            return number_format($otherPrice / $curr->course_currency, 2, '.', '');
    }


    // помом Акций существует цена промо - хуй разберешьсчя
    public function getCostPromo__()
    {
        $curr = Yii::$app->currency->getCurrency();
        return number_format($this->price_promo / $curr->course_currency, 2, ',', ' ');

    }


    public function getName()
    {
        //Тип + Цвет + Форма огранки + ЭТОТ СУФИКС ИМЕНИ
        return trim($this->typeProduct->name . ' - '
            . $this->color->name . ' - '
            . $this->shape0->name_shape . ' - '
            //. $this->productDescs->{'name_suffix_' . Yii::$app->language}
            , ' -');
    }


}
