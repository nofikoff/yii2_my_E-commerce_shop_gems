<?php

namespace backend\controllers;

use common\models\Parser;
use common\models\ParserGemscolors;
use common\models\ParserGemscolorsDefaulttype;
use common\models\ParserGemshapes;
use common\models\ParserGemstypeReservedkeys;
use common\models\ParserGemstypes;
use common\models\ProductsColors;
use common\models\ProductsShapes;
use common\models\ProductType;

use Yii;

use yii\helpers\ArrayHelper;
use yii\swiftmailer\Message;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\filters\AccessControl;

use yii\authclient\clients\Twitter;
use yii\authclient\OAuthToken;

use yii\base\Exception;


/**
 * ModelsStatusJournalController implements the CRUD actions for ModelsStatusJournal model.
 */
class TestController extends Controller
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
                ]
            ],

            // use yii\filters\AccessControl;
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // этот экшен не закрыт автоизацией
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ]
            ]

        ];
    }

    /**
     * Lists all ModelsStatusJournal models.
     * @return mixed
     */
    public function actionIndex()
    {

        // возможно будет выгрука в эксеот ниже
        ob_start();

        if (isset($_POST['words'])) {

            $p = new Parser();


            $a = explode("\r\n", $_POST['words']);
            if (sizeof($a))
                foreach ($a as $str) {
                    if (trim($str)) {

                        $r = $p->parser1c($str);
                        echo $r['comment'];

                        if ($r['error'] OR $r['result'] == false) {
                            echo " <br><br><font color=red>НЕ будет импортировано в базу</font> (исключено или нет обязательных поля КАМЕНЬ+ЦВЕТ+ФОРМА) ";
                        } else {
                            echo " <br><br><font color=green>будет импортировано в базу! </font>";
                        }
                        $result[] = $r['result'];
                        //
                    }
                }


            if (isset($_POST['excel']) AND isset($result)) {
                //
                $g_type = ProductType::find()->asArray()->all();
                $g_type = ArrayHelper::map($g_type, 'id_product_type', 'name_product_type');

                //
                $g_color = ProductsColors::find()->asArray()->all();
                $g_color = ArrayHelper::map($g_color, 'id_color', 'name_color');

                //
                $g_cutshape = ProductsShapes::find()->asArray()->all();
                $g_cutshape = ArrayHelper::map($g_cutshape, 'id_shape', 'name_shape');
                //
                foreach ($result as $k => $r) {
                    $result[$k]['type_id'] = $g_type[$r['type_id']];
                    $result[$k]['color_id'] = $g_color[$r['color_id']];
                    $result[$k]['cutshape_id'] = $g_cutshape[$r['cutshape_id']];
                }
//                print_r($result);
                //  ничего не выводим
                ob_get_clean();
                $p->excelExport($result);
            } else {
                // выводим
                echo ob_get_clean();
            }
            exit;
            // далее выводится фома
        }


        return $this->render('index', [
            //'message' => $message,
        ]);


    }

    /**
     * Displays a single ModelsStatusJournal model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionCreate()
    {


    }


}








