<?php

namespace common\models;


use Yii;

/**
 * This is the model class for table "my_1cparser_gemstypes".
 *
 * @property integer $id_1cparser_gemstypes
 * @property string $name_1cparser_gemstype
 * @property integer $exclude_1cparser_gemstype
 * @property integer $product_type_id
 */
class ParserGemstypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'my_1cparser_gemstypes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exclude_1cparser_gemstype', 'product_type_id'], 'integer'],
            [['name_1cparser_gemstype'], 'string', 'max' => 145],
            ['name_1cparser_gemstype', 'filter', 'filter'=>'trim'],
            [['name_1cparser_gemstype'], 'unique'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_1cparser_gemstypes' => 'Id 1cparser Gemstypes',
            'name_1cparser_gemstype' => 'Ключевое слово типа камня из выгрузки 1с',
            'exclude_1cparser_gemstype' => 'Исключить камни с таким словом',
            'product_type_id' => 'Соответсвует типу камня на вебсайте',
        ];
    }

    public function getProductType()
    {
            return $this->hasOne(ProductType::className(), ['id_product_type' => 'product_type_id']);
    }


}
