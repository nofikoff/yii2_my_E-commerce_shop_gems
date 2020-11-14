<?php

namespace backend\controllers;

use Yii;
use common\models\ProductsTypeColorMultimedia;
use common\models\ProductsTypeColorMultimediaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * ProductsTypeColorMultimediaController implements the CRUD actions for ProductsTypeColorMultimedia model.
 */
class ProductsTypeColorMultimediaController extends Controller
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
     * Lists all ProductsTypeColorMultimedia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductsTypeColorMultimediaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductsTypeColorMultimedia model.
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
     * Creates a new ProductsTypeColorMultimedia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductsTypeColorMultimedia();

        $get = Yii::$app->request->get();
        $sid = 0;
        if (isset($get['sid']) && $get['sid'] > 0 )
        $sid = $get['sid'];
        $model->product_type_color_id = $sid;

        if ($model->load(Yii::$app->request->post())) {
                $file = UploadedFile::getInstance($model, 'file');
                if ($file && $file->tempName) {
                    $model->file = $file;
                    if ($model->validate(['file'])) {
                        $dir = Yii::getAlias('@frontend').'/web/upload/products_color/';
                        $fileName = md5(microtime()) . '.' . $file->extension; 
                        $model->file->saveAs($dir . $fileName);
                        $model->file = $fileName; 
                        $model->products_filepath = '/upload/products_color/'.$fileName;
                    }
                }
        if ($model->save()) {
            return $this->redirect(['index', 'ProductsTypeColorMultimediaSearch[product_type_color_id]' => $model->product_type_color_id]);
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
     * Updates an existing ProductsTypeColorMultimedia model.
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
                        $dir = Yii::getAlias('@frontend').'/web/upload/products_color/';
                        $fileName = md5(microtime()) . '.' . $file->extension; 
                        $model->file->saveAs($dir . $fileName);
                        $model->file = $fileName; 
                        $model->products_filepath = '/upload/products_color/'.$fileName;
                    }
                }
            $model->save();
            return $this->redirect(['index', 'ProductsTypeColorMultimediaSearch[product_type_color_id]' => $model->product_type_color_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProductsTypeColorMultimedia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        $model = $this->findModel($id);
        $sid = $model->product_type_color_id;
        $model->delete();

        return $this->redirect(['index','ProductsTypeColorMultimediaSearch[product_type_color_id]' => $sid]);
    }

    /**
     * Finds the ProductsTypeColorMultimedia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductsTypeColorMultimedia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductsTypeColorMultimedia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
