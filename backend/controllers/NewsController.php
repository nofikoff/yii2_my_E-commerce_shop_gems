<?php

namespace backend\controllers;

use Yii;
use yii\web\Response;
use common\models\News;
use common\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;
use yii\filters\AccessControl;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),

            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 100;
        $dataProvider->setSort(['defaultOrder' => [
            'sortorder' => SORT_DESC,
        ]]);




        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();

        $model->uid = Yii::$app->user->id;
        
        if ($model->load(Yii::$app->request->post())) {
         
            $image = UploadedFile::getInstance($model, 'file');
            if ($image){
                
            if (false && $image){
                Yii::$app->session->setFlash('alert', ['type' => 'error', 'message' => 'Image error']);
                return $this->refresh();
            }
                $new_name = md5(microtime()) . '.' . $image->extension;    
                $image->saveAs(Yii::getAlias('@frontend').'/web/upload/news_img/'.$new_name);
                $model->setAttribute('img', $new_name);
            } 
            
         
            $s = preg_replace('/[^a-z _]/i', "",$model->getAttribute('name'));
            $s = preg_replace('/[ ]/i', "_",$s);
            
            if (!$model->getAttribute('url'))
                $model->setAttribute('url', strtolower(preg_replace('/[_]{2,}/i', "_",$s)));
                
            $model->save();
                       
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
         
            $image = UploadedFile::getInstance($model, 'file');
            if ($image){
                
            if (false && $image){
                Yii::$app->session->setFlash('alert', ['type' => 'error', 'message' => 'Image error']);
                return $this->refresh();
            }
                $new_name = md5(microtime()) . '.' . $image->extension;    
                $image->saveAs(Yii::getAlias('@frontend').'/web/upload/news_img/'.$new_name);
                $model->setAttribute('img', $new_name);
            }  
         
            $s = preg_replace('/[^a-z _]/i', "",$model->getAttribute('name'));
            $s = preg_replace('/[ ]/i', "_",$s);
            
            if (!$model->getAttribute('url'))
                $model->setAttribute('url', strtolower(preg_replace('/[_]{2,}/i', "_",$s)));
                
            $model->save();
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
    public function actionImageupload(){
    $redactorUploadDir = Yii::getAlias('@frontend').'/web/upload/news_img/';

		if(true || Yii::$app->request->post()){
			$img = isset($_FILES['file']) ? $_FILES['file'] : null;

			if($img){
				$path = $redactorUploadDir;
				if(!is_dir($path)){
					@mkdir($path, 0755, true);
				}	
				$name = md5(microtime().uniqid());
				$name  = $name . '.' . pathinfo($img['name'], PATHINFO_EXTENSION);
	
				if(@copy($img['tmp_name'], $path . $name)){
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ['filelink' => '/upload/news_img/' . $name];
				}
				Yii::$app->end();
			}			
		}
		//throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');		
	}
    
}



