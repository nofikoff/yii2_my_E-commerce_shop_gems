<?php

namespace backend\controllers;

use Yii;
use common\models\ProductType;
use yii\console\Exception;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * ProductTypeController implements the CRUD actions for ProductType model.
 */
class ProductTypeController extends Controller
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
     * Lists all ProductType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ProductType::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductType model.
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
     * Creates a new ProductType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductType();

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'file');
            if ($file && $file->tempName) {
                $model->file = $file;
                if ($model->validate(['file'])) {
                    $dir = Yii::getAlias('@frontend') . '/web/upload/product_type/';
                    $fileName = md5(microtime()) . '.' . $file->extension;
                    //$fileName = $model->file->baseName . '.' . $model->file->extension;
                    $model->file->saveAs($dir . $fileName);
                    $model->file = $fileName;
                    $model->img_product_type = $fileName;
                }
            }

            if ($model->save()) {

                $modelDesc = new \common\models\ProductsTypeDesc();
                $modelDesc->product_type_id = $model->id_product_type;
                $modelDesc->desc_products = $model->desc_products;
                $modelDesc->desc_short_products = $model->desc_short_products;
                $modelDesc->desc_products_ua = $model->desc_products_ua;
                $modelDesc->desc_short_products_ua = $model->desc_short_products_ua;
                $modelDesc->save();

                return $this->redirect(['index', 'id' => $model->id_product_type]);
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
     * Updates an existing ProductType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        if ($modelDesc = \common\models\ProductsTypeDesc::findOne(['product_type_id' => $model->id_product_type])) {
            $model->desc_products = $modelDesc->desc_products;
            $model->desc_short_products = $modelDesc->desc_short_products;
            $model->desc_products_ua = $modelDesc->desc_products_ua;
            $model->desc_short_products_ua = $modelDesc->desc_short_products_ua;
        }

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'file');
            if ($file && $file->tempName) {
                $model->file = $file;
                if ($model->validate(['file'])) {
                    $dir = Yii::getAlias('@frontend') . '/web/upload/product_type/';
                    $fileName = md5(microtime()) . '.' . $file->extension;
                    //$fileName = $model->file->baseName . '.' . $model->file->extension;
                    $model->file->saveAs($dir . $fileName);
                    $model->file = $fileName;
                    $model->img_product_type = $fileName;
                }
            }

            if ($model->save()) {

                $modelDesc = \common\models\ProductsTypeDesc::findOne(['product_type_id' => $model->id_product_type]);
                if ($modelDesc == null) {
                    $modelDesc = new \common\models\ProductsTypeDesc();
                    $modelDesc->product_type_id = $model->id_product_type;
                }
                $modelDesc->desc_products = $model->desc_products;
                $modelDesc->desc_short_products = $model->desc_short_products;
                $modelDesc->desc_products_ua = $model->desc_products_ua;
                $modelDesc->desc_short_products_ua = $model->desc_short_products_ua;
                $modelDesc->save();

                return $this->redirect(['index', 'id' => $model->id_product_type]);
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
     * Deletes an existing ProductType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        $model = $this->findModel($id);
        //
        //
        if ($model->productsTypeColorVariation <> null) {

            foreach ($model->productsTypeColorVariation as $item) {


                if (isset($item->productsTypeColorDescs))
                    try {
                        $item->productsTypeColorDescs->delete();
                    } catch (\Exception $e) {
                        print_r($e);
                    }

                if (isset($item->productsTypeColorImage))
                    try {
                        $item->productsTypeColorImage->delete();
                    } catch (\Exception $e) {
                        print_r($e);
                    }


                $sql = "DELETE FROM `my_products_type_color_multimedia` WHERE `product_type_color_id` = " . $item->id;
                Yii::$app->db->createCommand($sql)->execute();
                //                под капотом огромная тучп шейпов камней и они сходу не удаляются
                //                по гасим их запрсом напрямую
                /*if (isset($item->productsTypeColorMultimedia)) {
                    try {
                        $item->productsTypeColorMultimedia->delete();
                    } catch (\Exception $e) {
                        print_r($e);
                    }
                }*/


                $item->delete();
            }
        }

        if ($model->productsTypeMultimedia <> null) {
            foreach ($model->productsTypeMultimedia as $item) {
                $item->delete();
            }
        }

        if ($model->productsTypeDescs <> null) {
            foreach ($model->productsTypeDescs as $item) {
                $item->delete();
            }
        }

        if ($model->productGemsPrices <> null) {
            foreach ($model->productGemsPrices as $item) {
                foreach ($item->productsMultimedia as $item2) {
                    $item2->delete();
                }
                $item->delete();
            }
        }


        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
