<?php

namespace frontend\controllers;

use Yii;
use frontend\models\SubscribeForm;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use common\models\Subscribe;

class BackcallController extends \yii\web\Controller
{

    public function actionSend()
    {

        if (Yii::$app->request->post('name')) {

            $name = Yii::$app->request->post('name');
            $phone = Yii::$app->request->post('phone');
            Yii::$app->session->setFlash('error', Yii::t("app","Мы получили ваш номер телефона и скоро перезвоним вам").": ".$phone);
            Yii::$app
                ->mailer
                ->compose(
                    ['text' => 'backCallmessage-text'],
                    ['name' => $name, 'phone' => $phone]
                )
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                ->setTo(Yii::$app->params['supportEmail'])
                ->setSubject('New Callback Me ' . Yii::$app->name)
                ->send();
        }
        return $this->redirect(['/' . Yii::$app->request->post('successUrl')]);

    }

}
