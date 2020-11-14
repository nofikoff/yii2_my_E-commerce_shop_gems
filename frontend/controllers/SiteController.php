<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Currencies;
use yii\data\ActiveDataProvider;
use common\models\ProductsTypeColorVariation;
use common\models\ProductGemsPrices;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        // SEO редиректы
//        https://gems.ua/uk/site/index
//        https://gems.ua/uk/site/
        if (preg_match('~(\/site\/index$)|(\/site$)~', Yii::$app->request->url)) {
            return $this->redirect('/', 301)->send();
        }


        $types = new ActiveDataProvider([
            'query' => ProductsTypeColorVariation::find()->orderBy('color_product_id'),
            'pagination' => false,
        ]);

        $new = new ActiveDataProvider([
            'query' => ProductGemsPrices::find()->orderBy('date_added DESC' )->limit(10),
            'pagination' => false,
        ]);

        $news = new ActiveDataProvider([
            'query' => \common\models\News::find()->orderBy('created_at')->limit(5),
            'pagination' => false,
        ]);

        $reviews = new ActiveDataProvider([
            'query' => \common\models\Reviews::find()->where(['status_review' => 1])->limit(5),
            'pagination' => false,
        ]);

        return $this->render('index', [
            'types' => $types,
            'new' => $new,
            'reviews' => $reviews,
            'news' => $news,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {

        // авторизирован? марш на главную
        if (!Yii::$app->user->isGuest) {
            if (isset($_POST['backurl']))
                return Yii::$app->getResponse()->redirect($_POST['backurl']);
            return $this->goHome();
        }

        $modelSignupForm = new SignupForm();
        // на входе ПОСТ данные?
        if ($modelSignupForm->load(Yii::$app->request->post())) {
            if ($user = $modelSignupForm->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    if (isset($_POST['backurl']))
                        return Yii::$app->getResponse()->redirect($_POST['backurl']);

                    return Yii::$app->getResponse()->redirect('/simpleproducts/?2=2');
                    return $this->goHome();

                }
            }
        }


        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (isset($_POST['backurl']))
                return Yii::$app->getResponse()->redirect($_POST['backurl']);

            return Yii::$app->getResponse()->redirect('/simpleproducts/?3=3');
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
                'modelSignupForm' => $modelSignupForm,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Ссылка для сброса пароля отправлена вам на E-mail'));
                //return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Ошибка отправки сообщения с инструкциями о сбросе пароля. Возможно адрес указан с ошибкой или отсутсвует в базе'));
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Новый пароль был сохранен'));

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionCurrencies($code, $destination)
    {
        $currency = \common\models\Currencies::find()->where('code_currency = :code_currency', [':code_currency' => $code])->one();
        Yii::$app->currency->put($currency);
        return $this->redirect($destination);
    }

}
