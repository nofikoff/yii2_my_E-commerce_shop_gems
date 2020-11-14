<?php

namespace frontend\controllers;

use Yii;
use common\models\Pages;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PagesController implements the CRUD actions for Pages model.
 */
class PagesController extends Controller
{

    public function actionIndex()
    {
        // список служебных страниц нахер не нужен
        return $this->redirect(['/pages/about']);


//        $query = Pages::find()->orderBy('updated_at DESC');
//        $models = new ActiveDataProvider([
//            'query'      => $query,
//            'pagination' => [
//                'pageSize' => 10
//            ],
//        ]);
//
//        return $this->render('index', [
//            'models' => $models,
//        ]);
    }
    
    public function actionView($url = null)
    {     
        $model = Pages::find()->where(['url' => $url])->one();
        if ($model) {   
            return $this->render('_one', [
                    'model' => $model,
            ]);
        }
        else {
            return $this->goHome();
        }
    }

    /**
     * Finds the Pages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
