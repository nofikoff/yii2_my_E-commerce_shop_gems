<?php

namespace backend\controllers;

use Yii;
use common\models\Simpleproducts;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * SimpleproductsController implements the CRUD actions for Simpleproducts model.
 */
class SimpleproductsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Simpleproducts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Simpleproducts::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Simpleproducts model.
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
     * Creates a new Simpleproducts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Simpleproducts();

        if ($model->load(Yii::$app->request->post())) {
                $file = UploadedFile::getInstance($model, 'file');
                if ($file && $file->tempName) {
                    $model->file = $file;
                    if ($model->validate(['file'])) {
                        $dir = Yii::getAlias('@frontend').'/web/upload/simple/';
                        $fileName = md5(microtime()) . '.' . $file->extension; 
                        $model->file->saveAs($dir . $fileName);
                        $model->file = $fileName; 
                        $model->img = '/upload/simple/'.$fileName;
                    }
                }
        if ($model->save()) {
            return $this->redirect(['view', 'id' => $model->id_simpleproduct]);
        } else {
           return $this->render('create', [
                'model' => $model,
            ]);
        }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Simpleproducts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
                $file = UploadedFile::getInstance($model, 'file');
                if ($file && $file->tempName) {
                    $model->file = $file;
                    if ($model->validate(['file'])) {
                        $dir = Yii::getAlias('@frontend').'/web/upload/simple/';
                        $fileName = md5(microtime()) . '.' . $file->extension; 
                        $model->file->saveAs($dir . $fileName);
                        $model->file = $fileName; 
                        $model->img = '/upload/simple/'.$fileName;
                    }
                }
        if ($model->save()) {
            return $this->redirect(['view', 'id' => $model->id_simpleproduct]);
        } else {
           return $this->render('update', [
                'model' => $model,
            ]);
        }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Deletes an existing Simpleproducts model.
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
     * Finds the Simpleproducts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Simpleproducts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Simpleproducts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
