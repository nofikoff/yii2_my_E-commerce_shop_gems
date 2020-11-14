<?php

namespace common\models;


use Yii;

/**
 * This is the model class for table "my_1cparser_gemscolors".
 *
 * @property integer $id_1cparser_colors
 * @property string $name_1cparser_colors
 * @property integer $exclude_1cparser_color
 * @property integer $product_color_id
 *
 * @property MyProductsColors $productColor
 */
class ParserGemscolors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'my_1cparser_gemscolors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exclude_1cparser_color', 'product_color_id'], 'integer'],
            [['name_1cparser_colors'], 'string', 'max' => 145],
            [['name_1cparser_colors'], 'unique'],
            [['product_color_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductsColors::className(), 'targetAttribute' => ['product_color_id' => 'id_color']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_1cparser_colors' => 'Id 1cparser Colors',
            'name_1cparser_colors' => 'Ключевое слово ЦВЕТА из выгрузки 1с',
            'exclude_1cparser_color' => 'Exclude 1cparser Color',
            'product_color_id' => 'Соответсвует цвету камня на вебсайте',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsColors()
    {
        return $this->hasOne(ProductsColors::className(), ['id_color' => 'product_color_id']);
    }
}
