<?php

namespace backend\controllers;

use Yii;
use common\models\ProductGemsPrices;

use common\models\Parser;
use common\models\ProductDesc;
use common\models\ProductGemsPricesSearch;
use common\models\ProductsMultimedia;
use common\models\ProductsTypeColorMultimedia;
use common\models\ProductsTypeColorVariation;


use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;


/**
 * ProductGemsPricesController implements the CRUD actions for ProductGemsPrices model.
 */
class ProductGemsPricesController extends Controller
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
     * Lists all ProductGemsPrices models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ProductGemsPrices::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductGemsPrices model.
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
     * Creates a new ProductGemsPrices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductGemsPrices();

        if ($model->load(Yii::$app->request->post())) {

            $model->date_added = time();

            if ($model->save()) {

                $modelDesc = new \common\models\ProductDesc();
                $modelDesc->product_id = $model->id_product;
                $modelDesc->desc_products = $model->desc_products;
                $modelDesc->desc_short_products = $model->desc_short_products;
                $modelDesc->desc_products_ua = $model->desc_products_ua;
                $modelDesc->desc_short_products_ua = $model->desc_short_products_ua;
                $modelDesc->save();

                $file = UploadedFile::getInstance($model, 'file');
                if ($file && $file->tempName) {
                    $model->file = $file;
                    if ($model->validate(['file'])) {
                        $modelMultimedia = new \common\models\ProductsMultimedia();
                        $modelMultimedia->product_id = $model->id_product;
                        $dir = Yii::getAlias('@frontend') . '/web/upload/products/';
                        $fileName = md5(microtime()) . '.' . $file->extension;
                        //$fileName = $model->file->baseName . '.' . $model->file->extension;
                        $model->file->saveAs($dir . $fileName);
                        $model->file = $fileName;
                        $modelMultimedia->products_filepath = $fileName;
                        $modelMultimedia->save();
                    }
                }

                return $this->redirect(['index', 'id' => $model->id_product]);
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


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $modelDesc = \common\models\ProductDesc::findOne(['product_id' => $model->id_product]);
        $model->country_name_ru = isset($modelDesc->country_name_ru) ? $modelDesc->country_name_ru : '';
        $model->country_name_uk = isset($modelDesc->country_name_uk) ? $modelDesc->country_name_uk : '';
        $model->name_suffix_ru = isset($modelDesc->name_suffix_ru) ? $modelDesc->name_suffix_ru : '';
        $model->name_suffix_uk = isset($modelDesc->name_suffix_uk) ? $modelDesc->name_suffix_uk : '';
        $model->desc_products_ru = isset($modelDesc->desc_products_ru) ? $modelDesc->desc_products_ru : '';
        $model->desc_products_uk = isset($modelDesc->desc_products_uk) ? $modelDesc->desc_products_uk : '';
        $model->nabor_seo_desc_ru = isset($modelDesc->nabor_seo_desc_ru) ? $modelDesc->nabor_seo_desc_ru : '';
        $model->nabor_seo_desc_uk = isset($modelDesc->nabor_seo_desc_uk) ? $modelDesc->nabor_seo_desc_uk : '';
        $model->nabor_notes_ru = isset($modelDesc->nabor_notes_ru) ? $modelDesc->nabor_notes_ru : '';
        $model->nabor_notes_uk = isset($modelDesc->nabor_notes_uk) ? $modelDesc->nabor_notes_uk : '';
        $model->seo_title_ru = isset($modelDesc->seo_title_ru) ? $modelDesc->seo_title_ru : '';
        $model->seo_title_uk = isset($modelDesc->seo_title_uk) ? $modelDesc->seo_title_uk : '';
        $model->seo_keywords_ru = isset($modelDesc->seo_keywords_ru) ? $modelDesc->seo_keywords_ru : '';
        $model->seo_keywords_uk = isset($modelDesc->seo_keywords_uk) ? $modelDesc->seo_keywords_uk : '';
        $model->seo_desc_ru = isset($modelDesc->seo_desc_ru) ? $modelDesc->seo_desc_ru : '';
        $model->seo_desc_uk = isset($modelDesc->seo_desc_uk) ? $modelDesc->seo_desc_uk : '';


        if ($model->load(Yii::$app->request->post())) {

            $model->date_updated = time();

            if ($model->save()) {

                $modelDesc = \common\models\ProductDesc::findOne(['product_id' => $model->id_product]);
                if ($modelDesc == null) {
                    $modelDesc = new \common\models\ProductDesc();
                    $modelDesc->product_id = $model->id_product;
                }


                $modelDesc->country_name_ru = $model->country_name_ru;
                $modelDesc->country_name_uk = $model->country_name_uk;
                $modelDesc->name_suffix_ru = $model->name_suffix_ru;
                $modelDesc->name_suffix_uk = $model->name_suffix_uk;
                $modelDesc->desc_products_ru = $model->desc_products_ru;
                $modelDesc->desc_products_uk = $model->desc_products_uk;
                $modelDesc->nabor_seo_desc_ru = $model->nabor_seo_desc_ru;
                $modelDesc->nabor_seo_desc_uk = $model->nabor_seo_desc_uk;
                $modelDesc->nabor_notes_ru = $model->nabor_notes_ru;
                $modelDesc->nabor_notes_uk = $model->nabor_notes_uk;
                $modelDesc->seo_title_ru = $model->seo_title_ru;
                $modelDesc->seo_title_uk = $model->seo_title_uk;
                $modelDesc->seo_keywords_ru = $model->seo_keywords_ru;
                $modelDesc->seo_keywords_uk = $model->seo_keywords_uk;
                $modelDesc->seo_desc_ru = $model->seo_desc_ru;
                $modelDesc->seo_desc_uk = $model->seo_desc_uk;


                $modelDesc->save();

                $file = UploadedFile::getInstance($model, 'file');
                if ($file && $file->tempName) {
                    $model->file = $file;
                    if ($model->validate(['file'])) {
                        $modelMultimedia = \common\models\ProductsMultimedia::findOne(['product_id' => $model->id_product]);
                        if ($modelMultimedia == null)
                            $modelMultimedia = new \common\models\ProductsMultimedia();
                        $modelMultimedia->product_id = $model->id_product;
                        $dir = Yii::getAlias('@frontend') . '/web/upload/products/';
                        $fileName = md5(microtime()) . '.' . $file->extension;
                        $model->file->saveAs($dir . $fileName);
                        $model->file = $fileName;
                        $modelMultimedia->products_filepath = $fileName;
                        $modelMultimedia->save();
                    }
                }

                return $this->redirect(['index', 'id' => $model->id_product]);

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

    public function actionExport()
    {


        $objPHPExcel = new \PHPExcel();

        // Set the active Excel worksheet to sheet 0

        $objPHPExcel->setActiveSheetIndex(0);

// Initialise the Excel row number

        $rowCount = 1;
//start of printing column names as names of MySQL fields
//start of printing column names as names of MySQL fields
//start of printing column names as names of MySQL fields

        $col_names = [
            'назва', 'колір', 'форма', 'розмір, мм', 'вес, карати', 'ціна, $', 'наявність', 'фото', 'ціна за кар', 'ціна по-штучно',
            'к-сть каменів в наборі', 'розмір точний, мм', 'маса кожного каменю', 'характеристики: 1) колір', '2) чистота', 'старна происхождения',
            'країна походження', 'суффикс', 'суфікс - укр', 'примітка', 'примітки - урк', 'артикул', 'текст описание - русс', 'текст описание - укр',
            'сео-текст русс', 'сео-текст укр', 'Title русс', 'Title укр', 'Keywords-русс', 'Keywords-укр', 'Descroption-русс', 'Descroption -укр'
        ];
        $column = 'A';
        foreach ($col_names as $col_name) {
            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, $col_name);
            $column++;
        }

//end of adding column names
//end of adding column names
//end of adding column names

//start while loop to get data
//start while loop to get data
//start while loop to get data

        $rowCount = 2;
        $models = ProductGemsPrices::find()->where('exclusive_type = 1')->all();

        foreach ($models as $model) {
            $column = 'A';


            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, $model->typeProduct->name_product_type);
            $column++;

            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, $model->color->name_color);
            $column++;

            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, $model->shape0->name_shape);
            $column++;

            $size = '';
            $size .= ($model->size_h > 0) ? $model->size_h . "*" : '';
            $size .= ($model->size_w > 0) ? $model->size_w . "*" : '';
            $size .= ($model->size_d > 0) ? $model->size_d . "*" : '';
            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, trim($size, '*'));
            $column++;

            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, $model->weight);
            $column++;

            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, $model->price);
            $column++;

            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, ($model->stock_points > 0) ? 'есть' : '');
            $column++;

            $img = '';
            if (count($model->productsMultimedia))
                foreach ($model->productsMultimedia as $item) {
                    $img .= str_replace('/img-gems/', '', $item->products_filepath . ', ');
                }
            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, trim($img, ' ,'));
            $column++;


            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, $model->exclusiv_priceper_carat);
            $column++;

            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, $model->exclusiv_priceper_stone);
            $column++;

            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, $model->nabor_numberstones);
            $column++;

            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, $model->nabor_sizestones);
            $column++;

            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, $model->nabor_weightstones);
            $column++;

            //характеристики: 1) колір
            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, $model->exclusiv_params_colorcryst);
            $column++;

            //2) чистота
            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, '');
            $column++;

            //страна ру
            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, @$model->productDescs->country_name_ru);
            $column++;

            //страна укр
            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, @$model->productDescs->country_name_uk);
            $column++;

            //суфикс ру
            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, @$model->productDescs->name_suffix_ru);
            $column++;

            //суфикс укр
            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, @$model->productDescs->name_suffix_uk);
            $column++;

            //примтка
            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, @$model->productDescs->nabor_notes_ru);
            $column++;

            //примтка
            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, @$model->productDescs->nabor_notes_uk);
            $column++;


            //sku
            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, $model->sku);
            $column++;


            //
            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, @$model->productDescs->desc_products_ru);
            $column++;
            //
            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, @$model->productDescs->desc_products_uk);
            $column++;

            //
            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, @$model->productDescs->nabor_seo_desc_ru);
            $column++;
            //
            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, @$model->productDescs->nabor_seo_desc_uk);
            $column++;

            //
            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, @$model->productDescs->seo_title_ru);
            $column++;
            //
            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, @$model->productDescs->seo_title_uk);
            $column++;


            //
            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, @$model->productDescs->seo_keywords_ru);
            $column++;
            //
            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, @$model->productDescs->seo_keywords_uk);
            $column++;

            //
            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, @$model->productDescs->seo_desc_ru);
            $column++;

            //
            $objPHPExcel->getActiveSheet()->setCellValue($column . $rowCount, @$model->productDescs->seo_desc_uk);
            $column++;


            $rowCount++;


//            // Redirect output to a client’s web browser (Excel5)
//            header('Content-Type: application/vnd.ms-excel');
//            header('Content-Disposition: attachment;filename="results.xls"');
//            header('Cache-Control: max-age=0');
//            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
//            $objWriter->save('php://output');
//exit;

        }


// Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="results.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');


        /*
                if ($model->load(Yii::$app->request->post())) {

                    $model->date_updated = time();

                    if ($model->save()) {

                        $modelDesc = \common\models\ProductDesc::findOne(['product_id' => $model->id_product]);
                        if ($modelDesc == null) {
                            $modelDesc = new \common\models\ProductDesc();
                            $modelDesc->product_id = $model->id_product;
                        }


                        $modelDesc->country_name_ru = $model->country_name_ru;
                        $modelDesc->country_name_uk = $model->country_name_uk;
                        $modelDesc->name_suffix_ru = $model->name_suffix_ru;
                        $modelDesc->name_suffix_uk = $model->name_suffix_uk;
                        $modelDesc->desc_products_ru = $model->desc_products_ru;
                        $modelDesc->desc_products_uk = $model->desc_products_uk;
                        $modelDesc->nabor_seo_desc_ru = $model->nabor_seo_desc_ru;
                        $modelDesc->nabor_seo_desc_uk = $model->nabor_seo_desc_uk;
                        $modelDesc->nabor_notes_ru = $model->nabor_notes_ru;
                        $modelDesc->nabor_notes_uk = $model->nabor_notes_uk;
                        $modelDesc->seo_title_ru = $model->seo_title_ru;
                        $modelDesc->seo_title_uk = $model->seo_title_uk;
                        $modelDesc->seo_keywords_ru = $model->seo_keywords_ru;
                        $modelDesc->seo_keywords_uk = $model->seo_keywords_uk;
                        $modelDesc->seo_desc_ru = $model->seo_desc_ru;
                        $modelDesc->seo_desc_uk = $model->seo_desc_uk;


                        $modelDesc->save();

                        $file = UploadedFile::getInstance($model, 'file');
                        if ($file && $file->tempName) {
                            $model->file = $file;
                            if ($model->validate(['file'])) {
                                $modelMultimedia = \common\models\ProductsMultimedia::findOne(['product_id' => $model->id_product]);
                                if ($modelMultimedia == null)
                                    $modelMultimedia = new \common\models\ProductsMultimedia();
                                $modelMultimedia->product_id = $model->id_product;
                                $dir = Yii::getAlias('@frontend') . '/web/upload/products/';
                                $fileName = md5(microtime()) . '.' . $file->extension;
                                $model->file->saveAs($dir . $fileName);
                                $model->file = $fileName;
                                $modelMultimedia->products_filepath = $fileName;
                                $modelMultimedia->save();
                            }
                        }

                        return $this->redirect(['index', 'id' => $model->id_product]);

                    } else {
                        return $this->render('update', [
                            'model' => $model,
                        ]);
                    }
                }*/


    }


    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->productsMultimedia !== null) {
            foreach ($model->productsMultimedia as $item2) {
                $item2->delete();
            }
        }


        if ($model->productDescs !== null) {
            $model->productDescs->delete();
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    /**
     * Finds the ProductGemsPrices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductGemsPrices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductGemsPrices::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionUpload()
    {
        $model = new ProductGemsPrices();

        if (isset($_POST['drop_base'])) {
            echo "Опция заблокирована";
            exit;

            $ksql = 'DELETE FROM `my_products_sales`';
            Yii::$app->db->createCommand($ksql)->execute();

            $ksql = 'DELETE FROM `my_product_desc`';
            Yii::$app->db->createCommand($ksql)->execute();

            // хреачим картинки
            $ksql = 'DELETE FROM `my_products_multimedia`';
            Yii::$app->db->createCommand($ksql)->execute();


            $ksql = 'DELETE FROM `my_product_gems_prices`';
            Yii::$app->db->createCommand($ksql)->execute();


            echo "<h4>Очистили таблицы: ценпозиций, их описаний, их картинок";

        }
        // КНОПКА ПРИВЯЗАТЬ КАРТИНКУ к сущностям на основании Экселя / парсер тот же
        // КНОПКА ПРИВЯЗАТЬ КАРТИНКУ к сущностям на основании Экселя / парсер тот же
        // КНОПКА ПРИВЯЗАТЬ КАРТИНКУ к сущностям на основании Экселя / парсер тот же
        // КНОПКА ПРИВЯЗАТЬ КАРТИНКУ к сущностям на основании Экселя / парсер тот же
        // КНОПКА ПРИВЯЗАТЬ КАРТИНКУ к сущностям на основании Экселя / парсер тот же
        else if (isset($_POST['save_images_type_color'])) {


            // аплоудим файл
            $model->file = UploadedFile::getInstance($model, 'file');
            if (!$model->file) die('Не указан файл 111');
            $model->file->saveAs('uploadsss/' . $model->file->baseName . '.' . $model->file->extension);

            // разбиираем талицу на массив
            $objPHPExcel = \PHPExcel_IOFactory::load('uploadsss/' . $model->file->baseName . '.' . $model->file->extension);
            // берем только первую вкладку == 0
            $sheetData = $objPHPExcel->getSheet(0)->toArray(null, true, true, true);

            // ОСНОВНОЙ ПАРСЕР ПОСТРОЧНО !!!!!
            $p = new Parser();

            $myi = 0;
            foreach ($sheetData as $row) {
                $myi++;
                if ($row['A'] == '') continue;

                // ПАРСИМ МАССИВ!!!
                // ПАРСИМ МАССИВ!!!
                // ПАРСИМ МАССИВ!!!
                // режим КНОПКА ПРИВЯЗАТЬ КАРТИНКУ к сущностям на основании Экселя / парсер тот же
                // режим КНОПКА ПРИВЯЗАТЬ КАРТИНКУ к сущностям на основании Экселя / парсер тот же
                // режим КНОПКА ПРИВЯЗАТЬ КАРТИНКУ к сущностям на основании Экселя / парсер тот же
                $r = $p->parserExcelPrice($row);
                //диагностика ошибки

                if ($r['error'] OR $r['result'] == false) {
                    echo " ----<br><br><font color=red>Строка не разобрана</font> (исключено или нет обязательных поля КАМЕНЬ+ЦВЕТ+ФОРМА) ";
                    echo $r['comment'];
                    // обрываем
                    continue;
                } else {
                    echo " ----<br><br><font color=green>Строка разобрана </font>";
                    echo $r['comment'];
                }


                // Модель сущности
                // новая или старая
                // ВАЖНО!!!
                if (!$modelTypeColor = ProductsTypeColorVariation::findOne(
                    [
                        'type_product_id' => $r['result']['type_product_id'],
                        'color_product_id' => $r['result']['color_id'],
                    ]
                )
                ) {
                    // нет такого сущности - новый
                    $modelTypeColor = new ProductsTypeColorVariation();
                    $modelTypeColor->type_product_id = $r['result']['type_product_id'];
                    $modelTypeColor->color_product_id = $r['result']['color_id'];
                    $modelTypeColor->save(false);
                    echo "<br><h2><font color=green>Создана новая сущнгость</font></h2>";
                } else {
                    echo "<br><h2><font color=green>Старая сущность найдена грузим ей картинку</font></h2>";
                }

                // если картинка определена
                if (isset($r['result']['images'][0])) {
                    foreach ($r['result']['images'] as $img_file) {
                        $img = new ProductsTypeColorMultimedia();
                        $img->product_type_color_id = $modelTypeColor->id_products_type_color_variation;
                        $img->products_filepath = $img_file;
                        try {
                            $img->save(false);
                            // ловим дубли уникальных ключей в базе - повторные записи
                        } catch (\yii\db\Exception $e) { // не забудь use yii\base\Exception; !!
                            //print_r($e->getMessage());
                        }
                    }
                }


            }//foreach
        }
        // осталдьные кнопки
        // осталдьные кнопки
        // осталдьные кнопки
        // осталдьные кнопки
        // осталдьные кнопки
        // осталдьные кнопки
        // осталдьные кнопки
        // осталдьные кнопки
        // осталдьные кнопки
        // осталдьные кнопки
        // осталдьные кнопки
        // осталдьные кнопки
        else if (Yii::$app->request->isPost) {


            if (!isset($_POST['ProductGemsPrices']['brand'])) die ('Выберите Бренд заружаемых камней');
            //<option value="0">модельные камни</option>
            //<option value="1">калиброванные вставки  Swarovski gems</option>
            //<option value="2">Swarovski</option>
            //<option value="3">Куб. оксид циркония Swarovski</option>
            switch ($_POST['ProductGemsPrices']['brand']) {
                case '0':
                    $_POST['ProductGemsPrices']['brand'] = 'Модельные камни';
                    $_POST['ProductGemsPrices']['treatment_type'] = '1'; // ручная
                    $_POST['ProductGemsPrices']['synthetic_type'] = '0'; // натурал
                    break;
                case '1':
                    $_POST['ProductGemsPrices']['brand'] = 'Калиброванные вставки  Swarovski gems';
                    $_POST['ProductGemsPrices']['treatment_type'] = '2'; // машин
                    $_POST['ProductGemsPrices']['synthetic_type'] = '0'; // натурал
                    break;
                case '2':
                    $_POST['ProductGemsPrices']['brand'] = 'Swarovski';
                    $_POST['ProductGemsPrices']['treatment_type'] = '2'; // машин
                    $_POST['ProductGemsPrices']['synthetic_type'] = '1'; // искусствен
                    break;
                case '3':
                    $_POST['ProductGemsPrices']['brand'] = 'Куб. оксид циркония Swarovski';
                    $_POST['ProductGemsPrices']['treatment_type'] = '2'; // машин
                    $_POST['ProductGemsPrices']['synthetic_type'] = '1'; // искусствен
                    break;
                case '4':
                    $_POST['ProductGemsPrices']['brand'] = 'Другие бренды';
                    $_POST['ProductGemsPrices']['treatment_type'] = '2'; // машин
                    $_POST['ProductGemsPrices']['synthetic_type'] = '1'; // искусствен
                    break;
            }

            // аплоудим файл
            $model->file = UploadedFile::getInstance($model, 'file');
            if (!$model->file) die('Не указан файл 222');
            $model->file->saveAs('uploadsss/' . $model->file->baseName . '.' . $model->file->extension);

            // разбиираем талицу на массив
            // разбиираем талицу на массив
            // разбиираем талицу на массив
            // разбиираем талицу на массив
            // разбиираем талицу на массив
            // разбиираем талицу на массив
            // разбиираем талицу на массив
            // разбиираем талицу на массив
            // ОСНВНЕ МЯСО!!!!
            $objPHPExcel = \PHPExcel_IOFactory::load('uploadsss/' . $model->file->baseName . '.' . $model->file->extension);
            // берем только первую вкладку == 0
            $sheetData = $objPHPExcel->getSheet(0)->toArray(null, true, true, true);
            //
            //
            //

            // ОСНОВНОЙ ПАРСЕР ПОСТРОЧНО !!!!!
            $p = new Parser();


            if (isset($_POST['save_to_base'])) {
                echo "<h1><br>Пишем в базу</h1>";
            } else {
                echo "<h1><br>В базу НЕ пишем (только анализируем этот Эксель)!</h1>";
            }

            $myi = 0;
            foreach ($sheetData as $row) {
                $myi++;

                if ($row['A'] == '') continue;

                // ПАРСИМ ВЕКТОР!!!
                // ПАРСИМ ВЕКТОР!!!
                // ПАРСИМ ВЕКТОР!!!
                // ПАРСИМ МАССИВ!!!
                // ПАРСИМ МАССИВ!!!
                // обычный режим кнопка ГРУЗИМ прайс
                // обычный режим кнопка ГРУЗИМ прайс
                // обычный режим кнопка ГРУЗИМ прайс
                $r = $p->parserExcelPrice($row);
                //диагностика ошибки

                if ($r['error'] OR $r['result'] == false) {
                    echo " ----<br><br><font color=red>$myi строка НЕ будет импортировано в базу</font> (исключено или нет обязательных поля КАМЕНЬ+ЦВЕТ+ФОРМА) ";
                    echo $r['comment'];
                    // обрываем
                    continue;
                } else {
                    echo " ----<br><br><font color=green>$myi строка будет импортировано в базу! </font>";
                    echo $r['comment'];
                }


                if ($model = ProductGemsPrices::find()
                    ->where(
                        '`type_product_id` = \'' . $r['result']['type_product_id'] . '\' AND
                      `color_id` = \'' . $r['result']['color_id'] . '\' AND
                      `weight` = \'' . $r['result']['weight'] . '\' AND
                      `shape` = \'' . $r['result']['shape'] . '\' AND
                      `size_h`  ' . ($r['result']['size_h'] > 0 ? '= \'' . $r['result']['size_h'] . '\'' : ' = 0') . ' AND
                      `size_w`  ' . ($r['result']['size_w'] > 0 ? '= \'' . $r['result']['size_w'] . '\'' : ' = 0') . ' AND
                      `size_d`  ' . ($r['result']['size_d'] > 0 ? '= \'' . $r['result']['size_d'] . '\'' : ' = 0')
                    )
                    // AND                       `nabor_numberstones` = \'' . $r['result']['nabor_numberstones'] . '\''
                    ->one()
                    // 0 обычный камень, 1 ЭКСКЛЮЗИВ, 2-3 наборы

                ) {
                    echo "-----<br><h2><font color=green>Обновление старой ценовой позиции</font></h2>
Вот этой <a href='/ru/shop/gems?id={$model->id_product}'>/ru/shop/gems?id={$model->id_product}</a>

";
                    if (!$des = ProductDesc::find()
                        ->where('`product_id` = ' . $model->id_product)
                        ->one()
                    ) {
                        $des = new ProductDesc();
                        $des->product_id = $model->id_product;
                    }


                } else {
                    echo " ** нет такого камня - новый ** ";
                    $model = new ProductGemsPrices();
                    // если описание определено
                    $des = new ProductDesc();
                    $des->product_id = $model->id_product;
                }


                // тут бренд, тип огранки, синтетика  камня
                $model->load($_POST);
                // тут то что достали из Экселя
                // тут то что достали из Экселя
                // тут то что достали из Экселя
                // тут то что достали из Экселя
                $model->load(
                    [
                        'ProductGemsPrices' => $r['result']
                    ]);


                //print_r($r['result']);
//                print_r($_POST);
//                print_r($model);
//                exit;

//                if ($r['result']['sku'] == '13') {
//                    print_r($this->result);
//                    exit;
//                }


                $model->last_update = date('Y-m-d H:i:s');


                // ОПИСАНИЕ
                $des->load(
                    [
                        'ProductDesc' => $r['result']
                    ]);

                if ($r['result']['price'] > 0) {
                    //
                } else {
                    echo "<h2>Внимание Нулевая цена. На сайте будет отмечено 'Цену уточняйте'</h2>";
                }
                //кнопка СОХРАНИТЬ В БАЗУ
                if (isset($_POST['save_to_base'])) {

                    //
                    try {
                        echo "... пишем ";
                        $model->save(false);


                        // ОПИСАНИЕ
                        try {
                            $des->save(false);
                            // ловим дубли уникальных ключей в базе - повторные записи
                        } catch (\yii\db\Exception $e) { // не забудь use yii\base\Exception; !!
                            print_r($e->getMessage());
                        }


                        // ловим дубли уникальных ключей в базе - повторные записи
                    } catch (\yii\db\Exception $e) { // не забудь use yii\base\Exception; !!
                        print_r($e->getMessage());
                        echo "Пытаемся сохранть новый каемнь а такой уже существует";
                        echo 'Причем этот заспро не выявил наш старый камень для апдейта<br>`type_product_id` = \'' . $r['result']['type_product_id'] . '\' AND
                      `color_id` = \'' . $r['result']['color_id'] . '\' AND
                      `shape` = \'' . $r['result']['shape'] . '\' AND
                      `size_h`  ' . ($r['result']['size_h'] > 0 ? '= \'' . $r['result']['size_h'] . '\'' : ' = 0 ') . ' AND
                      `size_w`  ' . ($r['result']['size_w'] > 0 ? '= \'' . $r['result']['size_w'] . '\'' : ' = 0') . ' AND
                      `size_d`  ' . ($r['result']['size_d'] > 0 ? '= \'' . $r['result']['size_d'] . '\'' : ' = 0') . '
                      ';
                        // !!!!!!!!!!!!!!!!!!!!!! ПОЧЕМУ ВЕС ПРОПУЩЕН ?????????????
                        // !!!!!!!!!!!!!!!!!!!!!! ПОЧЕМУ ВЕС ПРОПУЩЕН ?????????????
                        // !!!!!!!!!!!!!!!!!!!!!! ПОЧЕМУ ВЕС ПРОПУЩЕН ?????????????
//                      AND `nabor_numberstones` = \'' . $r['result']['nabor_numberstones'] . '\'';

                        echo "<h2>Новый камень</h2>";
                        echo "<pre>";
                        print_r($model);
                        echo "</pre>";

                        exit;
                    }


                    // если картинка определена
                    if (isset($r['result']['images'][0]) AND $model->id_product) {
                        foreach ($r['result']['images'] as $img_file) {
                            $img = new ProductsMultimedia();
                            $img->product_id = $model->id_product;
                            $img->products_filepath = $img_file;
                            try {
                                $img->save(false);
                                // ловим дубли уникальных ключей в базе - повторные записи
                            } catch (\yii\db\Exception $e) { // не забудь use yii\base\Exception; !!
                                //print_r($e->getMessage());
                            }
//                            print_r($img);
                        }
                    }


                } // КНОПКА СОХРАНИТЬ В БАЗУ!!!
                //print_r($model->getErrors());
//                print_r($r['result']);

                echo "<hr><br>";

            }//foreach


            // конец обработчика Экселя
            exit;
            exit;
            exit;
            exit;
            exit;
        }

        // ФОРМА
        // ФОРМА
        // ФОРМА
        // ФОРМА
        // получим список полей enum для вып меню формы
        //обычный мускуль $ksql = "SELECT SUBSTRING(COLUMN_TYPE,5) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='gems' AND TABLE_NAME='my_product_gems_prices' AND COLUMN_NAME='brend_type'";
        preg_match('/\((.*)\)/', $model->tableSchema->columns['brand']->dbType, $matches);
        $enum_list = explode("','", trim($matches[1], "''"));
        //$enum_list = array_combine($enum_list, $enum_list);
        return $this->render('upload', [
            'model' => $model,
            'enum_list' => $enum_list,
        ]);
    }

}
