<?php

namespace common\models;

use himiklab\sitemap\behaviors\SitemapBehavior;
use Yii;

/**
 * This is the model class for table "{{%products_color_group}}".
 *
 * @property integer $id_color_group
 * @property string $name_color_group
 * @property string $rgb_color_group
 *
 * @property ProductsColors[] $productsColors
 */
class ProductsColorGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%products_color_group}}';
    }



    public function behaviors()
    {
        return [

            'sitemap' => [
                'class' => SitemapBehavior::className(),
                'scope' => function ($model) {
                    /** @var \yii\db\ActiveQuery $model */
                    $model->select(['id_color_group']);
                    //$model->andWhere(['publish' => 1]); похер
                    $model->OrderBy(['id_color_group' => SORT_DESC]);
                    if (isset($_GET['page']))
                        $model->offset(($_GET['page'] - 1) * 50000);
                    $model->limit(50000);
                },
                'dataClosure' => function ($model) {
                    /** @var self $model */
                    return [
                        'loc' => "shop?FilterForm[color]=" . $model->id_color_group,
                        // в новостях каокго тохера левая дата в базе
                        //'lastmod' => ($model->created_at == '') ? date('Y-m-d h:i:s') : date('Y-m-d h:i:s', $model->created_at),
                        'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
                        'priority' => 0.5
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
            [['name_color_group', 'name_color_group_ua', 'rgb_color_group'], 'string', 'max' => 45],
            [['seo_ru','seo_uk'], 'safe'],
            [['name_color_group'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_color_group' => 'Id Color Group',
            'name_color_group' => 'Name Color Group',
            'name_color_group' => 'Name Color Group UA',
            'rgb_color_group' => 'Rgb Color Group',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsColors()
    {
        return $this->hasMany(ProductsColors::className(), ['color_group_id' => 'id_color_group']);
    }
    
    public function getContent()
    {
        if (Yii::$app->language == 'uk')
            return $this->name_color_group_ua;
        else 
            return $this->name_color_group;
    }


    public function getName()
    {
        if (Yii::$app->language == 'uk')
            return $this->name_color_group_ua;
        else 
            return $this->name_color_group;
    }
}
