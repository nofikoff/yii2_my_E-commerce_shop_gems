<?php

namespace frontend\models;

use common\models\ProductsColorGroup;
use common\models\ProductsShapes;
use common\models\ProductType;
use Yii;
use yii\base\Model;

class FilterForm extends Model
{
    public $type;
    public $color;
    public $shape;
    public $treatment_type;
    public $brand;
    public $action;
    public $instock;
    public $exclusive;
    public $this_is_nabor;
    public $priceFrom = 0;
    public $priceTo = 0;
    public $sizeFrom = 0;
    public $sizeTo = 0;
    public $width;
    public $widthFrom = 0;
    public $widthTo = 0;
    public $height;
    public $heightFrom = 0;
    public $heightTo = 0;
    public $synthetic;
    public $key;


    public function rules()
    {
        return [
            //[['priceFrom', 'priceTo'], 'number', 'min' => 0],
            [['synthetic', 'type', 'color', 'shape', 'treatment_type', 'exclusive', 'this_is_nabor', 'priceFrom', 'priceTo', 'sizeFrom', 'sizeTo', 'widthFrom', 'widthTo', 'heightFrom', 'heightTo', 'action', 'instock'], 'number'],
            [['key', 'width', 'height', 'brand'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'brand' => Yii::t('app', 'Бренд'),
            'type' => Yii::t('app', 'Драгоценный камень'),
            'color' => Yii::t('app', 'Цвет'),
            'shape' => Yii::t('app', 'Форма огранки'),
            'treatment_type' => Yii::t('app', 'Тип огранки'),
            'action' => Yii::t('app', 'Акции'),
            'instock' => Yii::t('app', 'В наличии'),
            'exclusive' => Yii::t('app', 'Эксклюзив'),
            'this_is_nabor' => Yii::t('app', 'Набор'),
            'priceFrom' => Yii::t('app', 'от'),
            'priceTo' => Yii::t('app', 'Цена до'),
            'height' => Yii::t('app', 'Высота'),
            'width' => Yii::t('app', 'Ширина'),
            'key' => Yii::t('app', 'Ключевое слово'),
        ];
    }


    public function parse()
    {
        $filters = [];

        $curr = Yii::$app->currency->getCurrency();
        $priceFrom = $this->priceFrom * $curr->course_currency;
        $priceTo = $this->priceTo * $curr->course_currency;

        if ($this->brand) {
            $filters['brand'] = $this->brand;
        }
        if ($this->type) {
            $filters['type_product_id'] = $this->type;
        }
        if ($this->color) {
            $filters['id_color_group'] = $this->color;
        }
        if ($this->shape) {
            $filters['shape'] = $this->shape;
        }
        if ($this->action) {
            $filters['action'] = $this->action;
        }
        if ($this->instock) {
            $filters['instock'] = $this->instock;
        }
        if ($this->exclusive) {
            $filters['exclusive_type'] = $this->exclusive;
        }
        if ($this->this_is_nabor) {
            $filters['this_is_nabor'] = $this->this_is_nabor;
        }
        if ($this->synthetic) {
            $filters['synthetic_type'] = $this->synthetic;
        }
        if ($this->treatment_type) {
            $filters['treatment_type'] = $this->treatment_type;
        }

        if ($this->priceTo == 0) {
            // анулируем
            $this->priceTo = NULL;
            //$filters['prices'] = [$priceFrom, $priceTo];

        } else if ($this->priceTo > 0) {
            $filters['prices'] = [$priceFrom, $priceTo];
        }

//        else { это не сработает если гет полносмтью пустой
//            exit;
//
//            // если NULL то ставим дефолт
//            $curr = Yii::$app->currency->getCurrency();
//            $max_price = \Yii::$app->params['maxPriceinUSAforFilters'] / $curr->course_currency;
//            $max_price = floor($max_price / 1000) * 1000;
//
//            $filters['prices'] = [$priceFrom, $max_price];
//
//        }


        if ($this->key) {
            $filters['key'] = $this->key;
        }

        if ($this->sizeFrom > 0 || $this->sizeTo > 0) {
            $filters['size'] = [($this->sizeFrom - $this->sizeFrom * 0.4), ($this->sizeTo + $this->sizeTo * 0.4)];
        }
        if ($this->width) {
            if (strpos($this->width, '-')) {
                $arr_w = explode('-', trim($this->width));
                $filters['widthFrom'] = (is_numeric($arr_w[0]) ? $arr_w[0] : 0);
                $filters['widthTo'] = (is_numeric($arr_w[1]) ? $arr_w[1] : 99999);
            } else {
                if (is_numeric($this->width) AND $this->width > 0) {
                    $filters['widthFrom'] = $this->width - 0.7;
                    $filters['widthTo'] = $this->width + 0.7;
                } else if (is_numeric($this->width) AND $this->width == 0) {
                    $this->width = NULL;
                }
            }
        } else {
            $this->width = NULL;
        }
        if ($this->height) {
            if (strpos($this->height, '-')) {
                $arr_w = explode('-', trim($this->height));
                $filters['heightFrom'] = (is_numeric($arr_w[0]) ? $arr_w[0] : 0);
                $filters['heightTo'] = (is_numeric($arr_w[1]) ? $arr_w[1] : 99999);
            } else {
                if (is_numeric($this->height AND $this->height > 0)) {
                    $filters['heightFrom'] = $this->height - 0.7;
                    $filters['heightTo'] = $this->height + 0.7;

                } else if (is_numeric($this->height) AND $this->height == 0) {
                    $this->height = NULL;
                }
            }
        } else {
            $this->height = NULL;
        }
        return $filters;
    }


    public function getListFilters()
    {

//        print_r($this);

        $spl = ' | ';
        $str = '';

        if (isset($this->type) && $this->type > 0) {
            $a = ProductType::findOne($this->type);
            if ($a) $str .= '<span class="red">' . $a->{'name_product_type' . (Yii::$app->language == 'uk' ? '_ua' : '')} . '</span> '  . $spl;
        }

        if (isset($this->brand)) {
            $str .= Yii::t('app', 'бренд') . ' <span class="red">' . Yii::t('app', $this->brand) . '</span>' . $spl;
        }

        if (isset($this->shape) && $this->shape > 0) {
            $a = ProductsShapes::findOne($this->shape);
            if ($a) $str .= Yii::t('app', 'форма') . ' <span class="red">' . $a->{'name_shape' . (Yii::$app->language == 'uk' ? '_ua' : '')} . '</span>' . $spl;
        }
        if (isset($this->color) && $this->color > 0) {
            $a = ProductsColorGroup::findOne($this->color);
            if ($a) $str .= Yii::t('app', 'цвет') . ' <span class="red">' . $a->{'name_color_group' . (Yii::$app->language == 'uk' ? '_ua' : '')} . '</span>' . $spl;
        }
        // цены
        $curr = Yii::$app->currency->getCurrency();
        $max_price = \Yii::$app->params['maxPriceinUSAforFilters'] / $curr->course_currency;
        $max_price = floor($max_price / 1000) * 1000;
        $price = '';
        $price .= (isset($this->priceFrom) && $this->priceFrom > 0) ? 'от <span class="red"> ' . $this->priceFrom . ' ' . $curr->name_currency . '</span> ' : '';
        $price .= (isset($this->priceTo) && $this->priceTo > 0 && $this->priceTo != $max_price) ? 'до <span class="red"> ' . $this->priceTo . ' ' . $curr->name_currency . '</span>' : '';
        if ($price)
            $str .= '<nobr>' . Yii::t('app', 'цена') . ' ' . $price . '</nobr>' . $spl;

        // размер
        $size1 = (isset($this->width) AND $this->width > 0) ? '<span class="red"> ' . $this->width . ' мм</span>' : '';
        $size2 = (isset($this->height) AND $this->height > 0) ? ' <span class="red"> ' . $this->height . ' мм</span>' : '';
        if ($size1 AND $size2)
            $str .= '<nobr>' . Yii::t('app', 'размер') . ' ' . $size1 . ' х ' . $size2 . '</nobr>' . $spl;
        else if ($size1)
            $str .= Yii::t('app', 'Размер') . ': ' . $size1 . $spl;
        else if ($size2)
            $str .= Yii::t('app', 'Размер') . ': ' . $size2 . $spl;

        $str .= (isset($this->treatment_type) && $this->treatment_type > 0) ? Yii::t('app', 'обработка') . ': <span class="red"> ' . \Yii::$app->params['treatment_type' . '_' . (Yii::$app->language)][$this->treatment_type] . '</span>' . $spl : '';


        // ФЛАГИ
        $str .= (isset($this->action) && $this->action > 0) ? '<nobr>' . Yii::t('app', 'акционные') . ' <span class="red">' . Yii::t('app', 'камни') . '</span></nobr>' . $spl : '';
        $str .= (isset($this->instock) && $this->instock > 0) ? '<nobr>' . Yii::t('app', 'в наличии') . ' <span class="red">' . Yii::t('app', '') . '</span></nobr>' . $spl : '';
        $str .= (isset($this->exclusive) && $this->exclusive > 0) ? '<nobr>' . Yii::t('app', 'эксклюзивные') . ' <span class="red">' . Yii::t('app', 'камни') . '</span></nobr>' . $spl : '';
        $str .= (isset($this->this_is_nabor) && $this->this_is_nabor > 0) ? '<nobr>' . Yii::t('app', 'наборы') . ' <span class="red">' . Yii::t('app', 'камней') . '</span></nobr>' . $spl : '';


        $str = trim($str, $spl);
        if ($str) return $str;


    }


}
