<?php

namespace frontend\controllers;

use Yii;
use frontend\models\SubscribeForm;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use common\models\Subscribe;

class SubscribeController extends \yii\web\Controller
{

    public function actionSend()
    {

        $model = new Subscribe();
        
        if (Yii::$app->request->post('SubscribeForm')) {
          $email = Yii::$app->request->post('SubscribeForm')['email'];
          $subscribe = Subscribe::find()->where(['email'=>$email])->one();
            if (isset($subscribe->id)) {
                Yii::$app->session->setFlash('error', 'Вы отписаны от новостей сайта');
                $subscribe->delete();
            }               
            else {
                Yii::$app->session->setFlash('success', 'Вы подписаны на новости сайта');
                $model->email = $email;
                $model->save();
            }
        }


        return $this->redirect(['/'.Yii::$app->request->post('successUrl')]);
         
    }

}
