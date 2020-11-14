<?php


// внимание этот контролеер просто работает с базой чужого компонента
// тот подклчен через конфиг и в мощное кеширование
//  с этим \basic\vendor\pheme\yii2-settings\components\Options.php


namespace backend\controllers;


use Yii;
use common\models\Options;
use common\models\OptionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

//use common\models\Notific;
use yii\caching\Cache;
use yii\filters\AccessControl;

use yii\base\Exception;

/**
 * OptionsController implements the CRUD actions for Options model.
 */
class OptionsController extends Controller
{


    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'confirm' => ['post'],
                    'block' => ['post']
                ],
            ],
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'roles' => ['@'],
//                        'matchCallback' => function () {
//                            return Yii::$app->user->identity->getIsAdmin();
//                        }
//                    ],
//                ]
//            ]
        ];
    }


    /**
     * Lists all Options models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OptionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Options model.
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
     * Creates a new Options model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Options();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // использует кэш
            Yii::$app->get('settings')->clearCache();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Options model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        // Поле ШАБЛОН письма для смс изменился группа настроек 14 - удаляем все заплнированные напоминания с Днем Рождения (признак notific_periodic_profile_id)
        // Или если сменили ответсвенного оператора за дни рождения группа настроек 15
        /*        if (isset($_POST['Options']['value']) AND ($id == 14 OR $id == 15 )) {
                    Notific::deleteAll('`notific_periodic_profile_id` > 0 AND  `datetime_notific` > NOW( ) ');
                }
         */

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // использует кэш
            Yii::$app->get('settings')->clearCache();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Options model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        try {
            if ($model->delete())
                return $this->redirect(['index']);
            //return $this->redirect(Yii::$app->request->getReferrer());
        } catch (Exception  $e) {
            $model->addError(null, $e->getMessage());
            echo "<h1>Внимание! Прежде чем удалить этот объект, удалите его подчиненные справочники!</h1>";
        }
    }

    /**
     * Finds the Options model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Options the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */


    public function findModel($id)
    {
        if ($id == 0) {
            // для определения вероятности создания модели с текущими входными параметрами
            // создадим пустышку для валидации на этапе логирования
            return new Options;
        } elseif (($model = Options::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
