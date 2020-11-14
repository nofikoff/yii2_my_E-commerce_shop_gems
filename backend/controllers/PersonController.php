<?php
namespace backend\controllers;

use Yii;
use common\models\Person;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

class PersonController extends \yii\web\Controller
{
     
       /** 
        * Lists all Person models. 
        * @return mixed 
        */ 
       public function actionIndex() 
       { 
           $dataProvider = new ActiveDataProvider([ 
               'query' => Person::find(), 
           ]); 
     
           return $this->render('index', [ 
               'dataProvider' => $dataProvider, 
           ]); 
       } 
     
       /** 
        * Displays a single Person model. 
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
     * Creates a new Person model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Person;

        if ($model->load(Yii::$app->request->post())) {
            // process uploaded image file instance
            $image = $model->uploadImage();

            if ($model->save()) {
                // upload only if valid uploaded file instance found
                if ($image !== false) {
                    $path = $model->getImageFile();
                    $image->saveAs($path);
                }
                $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
                if ($model->upload()) {
                // file is uploaded successfully
                    return;
                }
            
                
                return $this->redirect(['view', 'id'=>$model->id]);
            } else {
                // error in saving model
            }
        }
        return $this->render('create', [
            'model'=>$model,
        ]);
    }
        

        
        
    /**
     * Updates an existing Person model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldFile = $model->getImageFile();
        $oldAvatar = $model->avatar;
        $oldFileName = $model->filename;

        if ($model->load(Yii::$app->request->post())) {
            // process uploaded image file instance
            $image = $model->uploadImage();

            // revert back if no valid file instance uploaded
            if ($image === false) {
                $model->avatar = $oldAvatar;
                $model->filename = $oldFileName;
            }

            if ($model->save()) {
                // upload only if valid uploaded file instance found
                if ($image !== false && unlink($oldFile)) { // delete old and overwrite
                    $path = $model->getImageFile();
                    $image->saveAs($path);
                }
                return $this->redirect(['view', 'id'=>$model->id]);
            } else {
                // error in saving model
            }
        }
        return $this->render('update', [
            'model'=>$model,
        ]);
    }    

    /**
     * Deletes an existing Person model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        // validate deletion and on failure process any exception 
        // e.g. display an error message 
        if ($model->delete()) {
            if (!$model->deleteImage()) {
                Yii::$app->session->setFlash('error', 'Error deleting image');
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Person model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Person the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Person::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }  
    
    
    
}
