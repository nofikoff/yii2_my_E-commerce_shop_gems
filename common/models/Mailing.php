<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%mailing}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $anons
 * @property string $content
 * @property string $anons_ua
 * @property string $content_ua
 * @property string $title
 * @property string $keywords
 * @property string $url
 * @property integer $updated_at
 * @property integer $created_at
 * @property integer $uid
 * @property string $img
 * @property integer $publish
 */
class Mailing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mailing}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'content', 'title', 'keywords', 'url', 'updated_at', 'created_at', 'uid', 'img', 'publish'], 'required'],
            [['anons', 'content', 'anons_ua', 'content_ua'], 'string'],
            [['updated_at', 'created_at', 'uid', 'publish'], 'integer'],
            [['name', 'title', 'keywords', 'url'], 'string', 'max' => 255],
            [['img'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'anons' => 'Anons',
            'content' => 'Content',
            'anons_ua' => 'Anons Ua',
            'content_ua' => 'Content Ua',
            'title' => 'Title',
            'keywords' => 'Keywords',
            'url' => 'Url',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
            'uid' => 'Uid',
            'img' => 'Img',
            'publish' => 'Publish',
        ];
    }
}
