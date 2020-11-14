<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%products_colors}}".
 *
 * @property integer $id_color
 * @property string $name_color
 * @property string $img_color
 * @property string $rgb_num_color
 * @property integer $color_group_id
 *
 * @property 1cparserGemscolors[] $1cparserGemscolors
 * @property 1cparserGemscolorsDefaulttype[] $1cparserGemscolorsDefaulttypes
 * @property ProductType[] $productTypes
 * @property ProductGemsPrices[] $productGemsPrices
 * @property ProductsColorGroup $colorGroup
 * @property ProductsTypeColorVariation[] $productsTypeColorVariations
 */
class ProductsColors extends \yii\db\ActiveRecord
{
    
    public $file;
    public $del_img;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%products_colors}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['color_group_id'], 'integer'],
            [['name_color', 'name_color_ua', 'rgb_num_color'], 'string', 'max' => 45],
            [['img_color'], 'string', 'max' => 245],
            [['name_color'], 'unique'],
            [['name_color'], 'required'],
            [['file'], 'file', 'extensions' => 'png, jpg'],
            [['del_img'], 'boolean'],
            [['color_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductsColorGroup::className(), 'targetAttribute' => ['color_group_id' => 'id_color_group']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_color' => 'Id Color',
            'name_color' => 'Name Color',
            'name_color_ua' => 'Name Color UA',
            'img_color' => 'Img Color',
            'rgb_num_color' => 'Rgb Num Color',
            'color_group_id' => 'Color Group ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function get1cparserGemscolors()
    {
      //  return $this->hasMany(1cparserGemscolors::className(), ['product_color_id' => 'id_color']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function get1cparserGemscolorsDefaulttypes()
    {
      //  return $this->hasMany(1cparserGemscolorsDefaulttype::className(), ['product_color_id' => 'id_color']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTypes()
    {
        return $this->hasMany(ProductType::className(), ['id_product_type' => 'product_type_id'])->viaTable('{{%1cparser_gemscolors_defaulttype}}', ['product_color_id' => 'id_color']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductGemsPrices()
    {
        return $this->hasMany(ProductGemsPrices::className(), ['color_id' => 'id_color']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColorGroup()
    {
        return $this->hasOne(ProductsColorGroup::className(), ['id_color_group' => 'color_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsTypeColorVariations()
    {
        return $this->hasMany(ProductsTypeColorVariation::className(), ['color_product_id' => 'id_color']);
    }
    
    public function getPreviewImage()
    {
        if (isset($this->img_product_type)) {
            return  '<img class="img-fluid" src="'.(Yii::getAlias('@site').'/upload/products_color/'.$this->img_color).'" >';
        } else {
            return false;
        }
    }
    
    public function getImageurl()
    {
        return Yii::getAlias('@site').'/upload/products_color/'.$this->img_color;
    }
    
    public function getContent()
    {
        if (Yii::$app->language == 'uk')
            return $this->name_color_ua;
        else 
            return $this->name_color;
    }
    
    public function getName()
    {
        if (Yii::$app->language == 'uk')
            return $this->name_color_ua;
        else 
            return $this->name_color;
    }
}
