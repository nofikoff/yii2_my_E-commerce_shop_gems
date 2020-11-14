<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%products_countries}}".
 *
 * @property integer $id_country
 * @property string $code_country
 * @property string $name_country
 */
class ProductsCountries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%products_countries}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code_country', 'name_country'], 'required'],
            [['code_country', 'name_country'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_country' => 'Id Country',
            'code_country' => 'Code Country',
            'name_country' => 'Name Country',
        ];
    }
}
