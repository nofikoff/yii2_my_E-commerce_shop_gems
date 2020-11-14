<?php

namespace common\models;

use himiklab\sitemap\behaviors\SitemapBehavior;
use yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property string $title
 * @property string $keywords
 * @property string $url
 * @property string $updated_at
 * @property string $created_at
 * @property integer $uid
 * @property string $img
 * @property integer $publish
 */
class Pages extends \yii\db\ActiveRecord
{

    public $file;
    public $del_img;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pages}}';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],


            'sitemap' => [
                'class' => SitemapBehavior::className(),
                'scope' => function ($model) {
                    /** @var \yii\db\ActiveQuery $model */
                    $model->select(['id', 'created_at', 'url']);
                    // https://gems.ua/uk/pages/ нах не нужны тем более сразу несколько копий
                    $model->andWhere("`url` != '' ");
                    $model->OrderBy(['created_at' => SORT_DESC]);
                    if (isset($_GET['page']))
                        $model->offset(($_GET['page'] - 1) * 50000);
                    $model->limit(50000);
                },
                'dataClosure' => function ($model) {
                    /** @var self $model */
                    return [
                        'loc' => "pages/" . $model->url,
                        // в новостях каокго тохера левая дата в базе
                        //'lastmod' => ($model->created_at == '') ? date('Y-m-d h:i:s') : date('Y-m-d h:i:s', $model->created_at),
                        'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
                        'priority' => 0.8
                    ];
                }
            ],

        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'required'],
            [['content_ru', 'anons_ru', 'name_ua', 'content_ua', 'anons_ua'], 'string'],
            [['updated_at', 'created_at'], 'safe'],
            [['uid', 'publish'], 'integer'],
            [['name_ru', 'name_ua', 'title', 'keywords', 'title_ua', 'keywords_ua', 'url'], 'string', 'max' => 255],
            [['img'], 'string', 'max' => 100],
            ['del_img', 'boolean'],
            [['file'], 'file', 'extensions' => 'jpg, gif, png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_ru' => 'Название РУ',
            'anons_ru' => 'Краткое содержание РУ',
            'content_ru' => 'Содержание РУ',

            'name_ua' => 'Название укр.',
            'anons_ua' => 'Краткое содержание укр.',
            'content_ua' => 'Содержание укр.',

            'title' => 'Title РУ',
            'keywords' => 'Ключевые слова РУ',
            'title_ua' => 'Title Укр',
            'keywords_ua' => 'Ключевые слова Укр',
            'url' => 'Ссылка',
            'updated_at' => 'Обновлено',
            'created_at' => 'Создано',
            'uid' => 'Автор',
            'img' => 'Изображение',
            'publish' => 'Статус',
            'file' => 'Изображение',
            'del_img' => 'Удалить картинку?',
        ];
    }

    public function search($params)
    {

        $query = News::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 10,
            ],
            'sort' => ['defaultOrder' => ['updated' => SORT_ASC]]
        ]);

        if ($params) {

            if (isset($params['id']) && $params['id']) {
                $query->andWhere(['=', 'id', $params['id']]);
            }
            if (isset($params['name']) && $params['name']) {
                $query->andWhere(['like', 'name_' . Yii::$app->language, $params['name']]);
            }
        }

        return $dataProvider;
    }

}
