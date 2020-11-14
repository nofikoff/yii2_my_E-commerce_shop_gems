<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%currencies}}".
 *
 * @property integer $id_currency
 * @property string $code_currency
 * @property string $name_currency
 * @property string $course_currency
 */
class Currencies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%currencies}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_currency', 'code_currency', 'name_currency', 'course_currency'], 'required'],
            [['id_currency'], 'integer'],
            [['code_currency', 'name_currency', 'course_currency'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_currency' => 'Id Currency',
            'code_currency' => 'Code Currency',
            'name_currency' => 'Name Currency',
            'course_currency' => 'Course Currency',
        ];
    }
}
