<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

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
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'brands'],
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
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }




    public function actionLogin()
    {

        /*
        // ПРИМЕР КАК СКИНУТЬ ПАРОЛЬ НОВЫЙ
        $user = \common\models\User::find()->where(['id' => 10])->one();
        $user->password = '5124315';
        $user->save();*/


        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    public function actionImageupload(){
        return '222222222222';
		if(Yii::app()->request->isPostRequest){
			$img = isset($_FILES['file']) ? $_FILES['file'] : null;
			if($img){
				$path = Yii::app()->params['redactorUploadDir'];
				if(!is_dir($path)){
					@mkdir($path, 0755, true);
				}	
				$name = md5(microtime().uniqid());
				$name  = $name . '.' . pathinfo($img['name'], PATHINFO_EXTENSION);
	
				if(@copy($img['tmp_name'], $path . $name)){
					print CJSON::encode(array("filelink" => Yii::app()->params['redactorUploadUrl'] . $name));
				}
				Yii::app()->end();
			}			
		}
		//throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');		
	}

    public function actionBrands()
    {


        return $this->render('brands', [
//            'model' => $model,
        ]);
    }


}
