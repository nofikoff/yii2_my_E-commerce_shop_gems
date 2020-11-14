<?php

namespace common\models;

use Yii;
use yz\shoppingcart\CartPositionProviderInterface;
use common\helpers\Image;

/**
 * This is the model class for table "{{%simpleproducts}}".
 *
 * @property integer $id_simpleproduct
 * @property string $name
 * @property string $price
 * @property string $description
 */
class Simpleproducts extends \yii\db\ActiveRecord implements CartPositionProviderInterface
{
    use \yz\shoppingcart\CartPositionTrait;
    public $file;
    public $del_img;
    

    public function getCartPosition($params = [])
    {
        return \Yii::createObject([
            'class' => 'common\models\ProductCartPosition',
            'id' => $this->id_simpleproduct,
        ]);
    }
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%simpleproducts}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['description'], 'string'],
            [['description_ua'], 'string'],
            [['file'], 'file', 'extensions' => 'png, jpg'],
            [['del_img'], 'boolean'],
            [['img'], 'string', 'max' => 245],
            [['name'], 'string', 'max' => 145],
            [['name_ua'], 'string', 'max' => 145],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_simpleproduct' => 'Id Simpleproduct',
            'image' => '',
            'name' => 'Название',
            'name_ua' => 'Назва',

            'price' => Yii::t('app', 'Цена'),
            'description' => 'Описание',
            'description_ua' => 'Опис',
        ];
    }
    
    public function getId()
    {
        return $this->id_simpleproduct;
    }

    public function getCost()
    {
       $curr = Yii::$app->currency->getCurrency();
        return number_format($this->price / $curr->course_currency, 2, '.', '');
    }
 
    public function getName()
    {
        return $this->name;
    }

    public function getNameUa()
    {
        return $this->name_ua;
    }

    public function getImage()
    {
        if (isset($this->img)) {
            return  (''.$this->img);
        } 
        return false;
    }
    
    public function thumb($width = null, $height = null, $crop = true)
    {
        if($this->image && ($width || $height)){
            return Image::thumb($this->image, $width, $height, $crop);
        }
        return '';
    }

    public function getPreviewImage()
    {
        if (isset($this->img)) {
           return  '<img class="img-fluid" src="'.(Yii::getAlias('@site').''.$this->img).'" >';
        } else {
            return false;
        }
    }
}
