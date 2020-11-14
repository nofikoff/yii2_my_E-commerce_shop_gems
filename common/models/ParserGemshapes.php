<?php

namespace common\models;


use Yii;

/**
 * This is the model class for table "my_1cparser_gemshapes".
 *
 * @property integer $id_1cparser_shapes
 * @property string $name_1cparser_shapes
 * @property integer $exclude_1cparser_shape
 * @property integer $product_shape_id
 *
 * @property MyProductsShapes $productShape
 */
class ParserGemshapes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'my_1cparser_gemshapes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exclude_1cparser_shape', 'product_shape_id'], 'integer'],
            [['name_1cparser_shapes'], 'string', 'max' => 145],
            [['name_1cparser_shapes'], 'unique'],
            [['product_shape_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductsShapes::className(), 'targetAttribute' => ['product_shape_id' => 'id_shape']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_1cparser_shapes' => 'Id 1cparser Shapes',
            'name_1cparser_shapes' => 'Ключевое слово формы огранки из выгрузки 1с',
            'exclude_1cparser_shape' => 'Exclude 1cparser Shape',
            'product_shape_id' => 'Соответсвует форме огранки на вебсайте',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsShapes()
    {
        return $this->hasOne(ProductsShapes::className(), ['id_shape' => 'product_shape_id']);
    }
}
