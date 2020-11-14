<?php

namespace frontend\controllers;

use Yii;
use common\models\News;
use yii\web\Controller;
use yii\data\ActiveDataProvider;


class NewsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query = News::find()
            ->orderBy('sortorder DESC')
        ;
        $models = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'pageSize' => 10
            ],
        ]);

        return $this->render('index', [
            'models' => $models,
        ]);
    }
    
    public function actionView($url = null)
    {     
        if ($url == 'index') {
            $query = News::find()
                ->orderBy('sortorder DESC')
            ;
            $models = new ActiveDataProvider([
                'query'      => $query,
                'pagination' => [
                    'pageSize' => 10
                ],
            ]);

            return $this->render('index', [
                'models' => $models,
            ]);  
        }
        
        $model = News::find()->where(['url' => $url])->one();
        if ($model) {   
            return $this->render('_news_one', [
                    'model' => $model,
            ]);
        }
        else {
            return $this->goHome();
        }
    }

}
