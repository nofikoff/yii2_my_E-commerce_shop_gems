<?php

namespace backend\controllers;

use Yii;
use common\models\ProductsTypeColorVariation;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
/**
 * ProductsTypeColorVariationController implements the CRUD actions for ProductsTypeColorVariation model.
 */
class ProductsTypeColorVariationController extends Controller
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
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
    ];
    
    }

    /**
     * Lists all ProductsTypeColorVariation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ProductsTypeColorVariation::find()
            ->orderBy(['order_waight' => SORT_DESC]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductsTypeColorVariation model.
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
     * Creates a new ProductsTypeColorVariation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductsTypeColorVariation();

        if ($model->load(Yii::$app->request->post())) {
            
            if ($model->save()) {
                
                $modelDesc = new \common\models\ProductsTypeColorDesc();
                $modelDesc->product_type_color_id = $model->id_products_type_color_variation;
                $modelDesc->desc_products = $model->desc_products;
                $modelDesc->desc_short_products = $model->desc_short_products;
                $modelDesc->desc_products_ua = $model->desc_products_ua;
                $modelDesc->desc_short_products_ua = $model->desc_short_products_ua;
                $modelDesc->save();
   
                $file = UploadedFile::getInstance($model, 'file');
                if ($file && $file->tempName) {
                    $model->file = $file;
                    if ($model->validate(['file'])) {
                        $modelMultimedia = new \common\models\ProductsTypeColorMultimedia();
                        $modelMultimedia->product_type_color_id = $model->id_products_type_color_variation;
                        $dir = Yii::getAlias('@frontend').'/web/upload/products_color/';
                        $fileName = md5(microtime()) . '.' . $file->extension; 
                        //$fileName = $model->file->baseName . '.' . $model->file->extension;
                        $model->file->saveAs($dir . $fileName);
                        $model->file = $fileName; 
                        $modelMultimedia->products_filepath = $fileName;
                        $modelMultimedia->save();
                    }
                }        
   
                return $this->redirect(['index', 'id' => $model->id_products_type_color_variation]);
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
     * Updates an existing ProductsTypeColorVariation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $modelDesc = \common\models\ProductsTypeColorDesc::findOne(['product_type_color_id' => $model->id_products_type_color_variation]); 
        if ($modelDesc != null) {
            $model->desc_products = $modelDesc->desc_products;
            $model->desc_short_products = $modelDesc->desc_short_products;
            $model->desc_products_ua = $modelDesc->desc_products_ua;
            $model->desc_short_products_ua = $modelDesc->desc_short_products_ua;
        }
        
        if ($model->load(Yii::$app->request->post())) {
            
            if ($model->save()) {
                
                $modelDesc = \common\models\ProductsTypeColorDesc::findOne(['product_type_color_id' => $model->id_products_type_color_variation]); 
                if ($modelDesc == null) {
                    $modelDesc = new \common\models\ProductsTypeColorDesc();
                    $modelDesc->product_type_color_id = $model->id_products_type_color_variation;
                }                           
                $modelDesc->desc_products = $model->desc_products;
                $modelDesc->desc_short_products = $model->desc_short_products;
                $modelDesc->desc_products_ua = $model->desc_products_ua;
                $modelDesc->desc_short_products_ua = $model->desc_short_products_ua;
                $modelDesc->save();
                
                $file = UploadedFile::getInstance($model, 'file');
                if ($file && $file->tempName) {
                    $model->file = $file;
                    if ($model->validate(['file'])) {
                        $modelMultimedia = \common\models\ProductsTypeColorMultimedia::findOne(['product_type_color_id' => $model->id_products_type_color_variation]); 
                        if ($modelMultimedia == null) {
                            $modelMultimedia = new \common\models\ProductsTypeColorMultimedia();
                            $modelMultimedia->product_type_color_id = $model->id_products_type_color_variation;
                        }
                        //$modelMultimedia->product_type_color_id = $model->id_products_type_color_variation;
                        $dir = Yii::getAlias('@frontend').'/web/upload/products_color/';
                        $fileName = md5(microtime()) . '.' . $file->extension; 
                        $model->file->saveAs($dir . $fileName);
                        $model->file = $fileName; 
                        $modelMultimedia->products_filepath = $fileName;
                        $modelMultimedia->save();
                    }
                } 

                return $this->redirect(['index', 'id' => $model->id_products_type_color_variation]);
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
     * Deletes an existing ProductsTypeColorVariation model.
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
     * Finds the ProductsTypeColorVariation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductsTypeColorVariation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductsTypeColorVariation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
