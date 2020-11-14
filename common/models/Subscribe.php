<?php

namespace common\models;

use Yii;

/**
 */
class Subscribe extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%subscribe}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['email'], 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => 'email',
        ];
    }
}

