<?php

namespace common\models;

use Yii;
use common\helpers\Image;
/**
 * This is the model class for table "{{%products_type_color_multimedia}}".
 *
 * @property integer $id_my_products_type_color_multimedia
 * @property integer $product_type_color_id
 * @property string $products_filepath
 * @property integer $flag_img_or_video
 *
 * @property ProductsTypeColorVariation $productTypeColor
 */
class ProductsTypeColorMultimedia extends \yii\db\ActiveRecord
{
    public $file;
    public $del_img;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%products_type_color_multimedia}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_type_color_id', 'flag_img_or_video'], 'integer'],
            [['products_filepath'], 'string', 'max' => 245],
            [['file'], 'file', 'extensions' => 'png, jpg'],
            [['del_img'], 'boolean'],
            [['product_type_color_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductsTypeColorVariation::className(), 'targetAttribute' => ['product_type_color_id' => 'id_products_type_color_variation']],
            [['flag_img_or_video', 'shape_id'], 'safe' ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_my_products_type_color_multimedia' => 'Id My Products Type Color Multimedia',
            'product_type_color_id' => 'Product Type Color ID',
            'products_filepath' => 'Products Filepath',
            'flag_img_or_video' => 'Flag Img Or Video',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTypeColor()
    {
        return $this->hasOne(ProductsTypeColorVariation::className(), ['id_products_type_color_variation' => 'product_type_color_id']);
    }

    public function getShapes()
    {
        return $this->hasOne(ProductsShapes::className(), ['id_shape' => 'shape_id']);
    }

    public function getImage()
    {
        if (isset($this->products_filepath)) {
            return  (''.$this->products_filepath);
        } 
        return false;
    }
    
    public function thumb($width = null, $height = null, $shape = 0, $crop = true)
    {
        if($this->image && ($width || $height)){
            return Image::thumb($this->image, $width, $height, $crop);
        }
        return '';
    }

    public function getPreviewImage()
    {
        if (isset($this->products_filepath)) {
           return  '<img class="img-fluid" src="'.(Yii::getAlias('@site').''.$this->products_filepath).'" >';
        } else {
            return false;
        }
    }
}
