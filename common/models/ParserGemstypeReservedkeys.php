<?php

namespace common\models;


use Yii;

/**
 * This is the model class for table "my_1cparser_gemstype_reservedkeys".
 *
 * @property integer $id_1cparser_grk
 * @property string $keyword_1cparser_grk
 */
class ParserGemstypeReservedkeys extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'my_1cparser_gemstype_reservedkeys';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['id_1cparser_grk'], 'required'],
            [['id_1cparser_grk'], 'integer'],
            [['keyword_1cparser_grk','russian_1cparser_grk'], 'string', 'max' => 45],
            [['keyword_1cparser_grk', 'russian_1cparser_grk'], 'filter', 'filter'=>'trim'],
            [['keyword_1cparser_grk'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_1cparser_grk' => 'Id 1cparser Grk',
            'keyword_1cparser_grk' => 'Зарезерированное слово в названии камня (1c)',
            'russian_1cparser_grk' => 'Зарезерированное слово в названии камня (вебсайт)',
        ];
    }
}
