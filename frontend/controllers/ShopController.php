<?php

namespace frontend\controllers;


use common\models\ProductsColorGroup;
use common\models\ProductsShapes;
use Yii;
use common\models\Simpleproducts;
use common\models\ProductGemsPrices;
use common\models\ProductGemsPricesSearch;
use common\models\ProductCartPosition;
use common\models\ProductType;
use common\models\ProductsTypeColorVariation;
use common\models\Orders;
use common\models\OrdersProducts;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yz\shoppingcart\ShoppingCart;
use frontend\models\FilterForm;
use yii\helpers\Url;

/**
 * ShopController implements the CRUD actions for Simpleproducts model.
 */
class ShopController extends Controller
{

    public function beforeAction($action)
    {
        // редирект на декодировыанный URL SEO [] - раскодируем квадратные скобки так краисей и унифицировано
        if (preg_match('~%5b~i', Yii::$app->request->url)) {
            return $this->redirect(urldecode(Yii::$app->request->url), 301)->send();
        }
        return parent::beforeAction($action);
    }


    public $filterForm;

    /**
     * Lists all  models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'shop';
        $shape = 0;
        $this->filterForm = new FilterForm();


        $filters = null;
        if ($this->filterForm->load(Yii::$app->request->get()) && $this->filterForm->validate()) {
            $filters['ProductGemsPricesSearch'] = $this->filterForm->parse();
        }


        if ($filters) {
            $searchModel = new ProductGemsPricesSearch();
            $dataProvider = $searchModel->search($filters);
            $dataProvider->pagination->pageSize = 99;






            if (isset($filters['ProductGemsPricesSearch']['shape']) && $filters['ProductGemsPricesSearch']['shape'] > 0)
                $shape = $filters['ProductGemsPricesSearch']['shape'];

            if ($dataProvider->getCount() == 1) {

                $one = $dataProvider->getModels();


                $a = array_shift($one);
                if (!isset($a->productsTypeColorVariation->id)) die('DataProvider->productsTypeColorVariation->id для этого камня не пределен ');

                if (!($id = $a->productsTypeColorVariation->id)) {

                    // ну и модель по дргому вызывается в шаблоне
                    // ШАБЛОН где в подшаблоне _list_gem сложно рассчитывается дальнейший линк на элементы
                    // ШАБЛОН где в подшаблоне _list_gem сложно рассчитывается дальнейший линк на элементы
                    // ШАБЛОН где в подшаблоне _list_gem сложно рассчитывается дальнейший линк на элементы
                    return $this->render('index-gem', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'filterForm' => $this->filterForm,
                        'shape' => $shape,
                        'filters' => $filters
                    ]);
                }

                //$id = array_shift($one)->productsTypeColorVariation->id;
                $model = ProductsTypeColorVariation::findOne($id);

                $searchModel = new ProductGemsPricesSearch();
                $dataProvider = $searchModel->search($filters, false);
                $items = $dataProvider->getModels();

                $modelreviews = new \common\models\Reviews();
                $modelreviews->product_type_id = $model->type_product_id;

                $reviews = \common\models\Reviews::search(['product_type_id' => $model->type_product_id, 'status_review' => 1]);
                $simple = new ActiveDataProvider([
                    'query' => Simpleproducts::find(),
                ]);


                // восполняем отсутсвующий тип камя в GEY запросе для отображени\я ОТФИЛЬТРОВАНО ПО
                $this->filterForm->color = $model->colorProduct->colorGroup->id_color_group;


                // ШАБЛОН основная таблица прайсов соотвествуюбщего типа камнея
                // ШАБЛОН основная таблица прайсов соотвествуюбщего типа камнея
                // ШАБЛОН основная таблица прайсов соотвествуюбщего типа камнея
                return $this->render('item', [
                    'model' => $model,
                    'items' => $items,
                    'filterForm' => $this->filterForm,
                    'modelreviews' => $modelreviews,
                    'reviews' => $reviews,
                    'simple' => $simple,
                    'shape' => $shape,
                ]);

            } else

                // СМ ВЫШЕ ЭТО ПЕРВЫЙ ШАБЛОН со слождными ссылками на элементы
                // СМ ВЫШЕ ЭТО ПЕРВЫЙ ШАБЛОН со слождными ссылками на элементы
                // СМ ВЫШЕ ЭТО ПЕРВЫЙ ШАБЛОН со слождными ссылками на элементы
                // СМ ВЫШЕ ЭТО ПЕРВЫЙ ШАБЛОН со слождными ссылками на элементы
                return $this->render('index-gem', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'filterForm' => $this->filterForm,
                    'shape' => $shape,
                    'filters' => $filters
                ]);
        }
        // ИНАЧЕ ПРОДОЛЖАМЕ ТУТ - ВСЕ ТОВАРЫ
        // ИНАЧЕ ПРОДОЛЖАМЕ ТУТ - ВСЕ ТОВАРЫ
        $dataProvider = new ActiveDataProvider([
            'query' => ProductsTypeColorVariation::find()
                ->orderBy(['order_waight' => SORT_DESC])
            ,
        ]);
//
        $dataProvider->pagination->pageSize = 99;

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'filterForm' => $this->filterForm,
            'shape' => $shape,
            'filters' => $filters
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

    public function actionBuy($id, $type = 'gems')
    {

        if ($type == 'simple')
            $model = Simpleproducts::findOne($id);
        else
            $model = ProductGemsPrices::findOne($id);

        if ($model) {
            $cartPosition = new ProductCartPosition();
            $cartPosition->id = $model->id;

            $cartPosition->type = $type;
            $cartPosition->name = $model->{'name' . (Yii::$app->language == 'uk' ? '_ua' : '')};


            \Yii::$app->cart->put($cartPosition, 1);

            return $this->redirect(['cart']);
        }

        throw new NotFoundHttpException();
    }


    public function actionAdd($type = 'gems')
//    public function actionAdd($id, $quantity = 1, $type = 'gems')
    {
        if (isset($_GET['quantity']))
            foreach ($_GET['quantity'] as $id => $val) {
                if ($val == 0) continue;
                $model = ProductGemsPrices::findOne($id);
                if ($model) {
                    $cartPosition = new ProductCartPosition();
                    $cartPosition->id = $model->id;

                    $cartPosition->type = $type;
                    $cartPosition->name = $model->name;

                    \Yii::$app->cart->put($cartPosition, $val);
                }
            }

        // смотри другой ЭКШЕН ДЛЯ СИМПЛ ПАРОДУКТОВ
//        if ($type == 'simple')
//            $model = Simpleproducts::findOne($id);
//        else
//            $model = ProductGemsPrices::findOne($id);


        return $this->redirect(['cart']);

//        throw new NotFoundHttpException();
    }

    public function actionDelete($id, $type = 'gems')
    {
        $md_id = md5(serialize([intval($id), $type]));
        $position = Yii::$app->cart->getPositionById($md_id);
        if ($position)
            Yii::$app->cart->remove($position);

        return $this->redirect(['cart']);
    }

    public function actionCart()
    {
        $positions = Yii::$app->cart->positions;

        if (Yii::$app->request->post('quantity')) {

            foreach (Yii::$app->request->post('quantity') as $qid => $value) {
                if (substr($qid, 0, 6) == 'simple') {
                    $type = 'simple';
                    $qid = substr($qid, 6);
                } else
                    $type = 'gems';

                $md_id = md5(serialize([intval($qid), $type]));
                $position = Yii::$app->cart->getPositionById($md_id);
                if ($position) {
                    Yii::$app->cart->putAll($position, $value);
                }
            }
            Yii::$app->session->setFlash('success', Yii::t('app', 'Содержимое вашей корзины обновлено'));
            return $this->redirect(['cart']);
        }

        $total = \Yii::$app->cart->getCost();
        $model = new Orders;

        if (!Yii::$app->user->isGuest) {
            $model->email = Yii::$app->user->identity->email;
            $model->phone = Yii::$app->user->identity->phone;
            $model->name = Yii::$app->user->identity->name;
            $model->address = Yii::$app->user->identity->address;
        }

        return $this->render('cart', [
            'positions' => $positions,
            'total' => $total,
            'model' => $model
        ]);
    }

    public function actionCheckout()
    {
        //checkout
        $positions = Yii::$app->cart->positions;


        $total = \Yii::$app->cart->getCost();
        $model = new Orders();

        if (!Yii::$app->request->post()) {
            return;
        }
        $model->load(Yii::$app->request->post());


        $model->comments = (Yii::$app->request->post()['Orders']['comment'] == '') ? 'Доп. комментариев нет' : Yii::$app->request->post()['Orders']['comment'];

        $model->name_orders = 'Заказ';
        $model->id_customers = 0;
        $model->date_added = time();


        if (Yii::$app->user->isGuest) {
            /* быстрый заказ без мыла !!!! $userid = User::find()->where(['email' => $model->email])->one();
            if (isset($userid->id)) {
                $model->id_customers = $userid->id;
//                $model->email = Yii::$app->user->email;

                //$model->phone = $userid->phone;
                //$model->name = $userid->name;
            } else*/
            $model->id_customers = 0;
            $model->contacts =
                Yii::$app->request->post()['Orders']['name'] . "\n\rЭТО БЫСТРЫЙ ЗАКАЗ \n\r Адрес: " .
                Yii::$app->request->post()['Orders']['phone'] . "\n\r";


        } else {
            $model->id_customers = Yii::$app->user->id;
            $model->contacts =
                Yii::$app->request->post()['Orders']['name'] . "\n\r Адрес: " .
                Yii::$app->request->post()['Orders']['address'] . "\n\r" .
                Yii::$app->request->post()['Orders']['email'] . "\n\r Тел: " .
                Yii::$app->request->post()['Orders']['phone'] . "\n\r";

//            $model->email = Yii::$app->user->email;
            //$model->phone = Yii::$app->user->identity->phone;
            //$model->name = Yii::$app->user->identity->name;
        }

//        print_r(Yii::$app->user);

//print_r($model);
//        exit;
        if ($model->save()) {
            foreach ($positions as $position) {
                if (!isset($position->product->name)) continue;

                $modelproducts = new OrdersProducts();
                $modelproducts->name_orders_products = $position->product->name;
                $modelproducts->id_product = $position->product->id;
                $modelproducts->price = $position->price;
                $modelproducts->quantity = $position->quantity;
                $modelproducts->summ = $position->price * $position->quantity;
                $modelproducts->id_orders_products = $model->id_orders;
                $modelproducts->save();
            }

            //send mail customer
            $this->mysendEmail($model->email, [
                    'positions' => $positions,
                    'contacts' => $model->contacts,
                    'comments' => $model->comments,
                ]
            );
            //send mail customer
            $this->mysendEmail(Yii::$app->params['adminEmail'],
                [
                    'positions' => $positions,
                    'contacts' => $model->contacts,
                    'comments' => $model->comments,
                ]
            );

            Yii::$app->session->setFlash('success', Yii::t('app', 'Спасибо за заказ! В ближайшее время с Вами свяжется консультант, чтобы уточнить детали.'));
            \Yii::$app->cart->removeAll();
            return $this->render('checkout');
        } else {
            return $this->render('cart', [
                'positions' => $positions,
                'total' => $total,
                'model' => $model
            ]);
        }
    }

    public function actionItem($id)
    {

        $this->layout = 'shop';
        $model = ProductsTypeColorVariation::findOne($id);

        $this->filterForm = new FilterForm();
        $filters = null;
        // грузим из адресной строки
        if ($this->filterForm->load(Yii::$app->request->get()) && $this->filterForm->validate()) {
            $filters['ProductGemsPricesSearch'] = $this->filterForm->parse();
        }

        if ($filters) {
            $searchModel = new ProductGemsPricesSearch();
            // восполняем отсутсвующий тип камя в GEY запросе для отображени\я ОТФИЛЬТРОВАНО ПО
            //$filters['ProductGemsPricesSearch']['type'] = $id;
            //
            $filters['ProductGemsPricesSearch']['type_product_id'] = $model->type_product_id;
            $filters['ProductGemsPricesSearch']['id_color_group'] = $model->colorProduct->colorGroup->id_color_group;
            $filters['ProductGemsPricesSearch']['color_product_id'] = $model->color_product_id;


            $dataProvider = $searchModel->search($filters, false);
            $items = $dataProvider->getModels();
        } else {
            $dataProvider = NULL;
            $items = ProductGemsPrices::find()
                ->where(['type_product_id' => $model->type_product_id, 'color_id' => $model->color_product_id])
                ->orderBy('shape')
                ->all();
        }
        // восполняем отсутсвующий тип камя в GEY запросе для отображени\я ОТФИЛЬТРОВАНО ПО
        $this->filterForm->type = $model->type_product_id;
        $this->filterForm->color = $model->colorProduct->colorGroup->id_color_group;


        $modelreviews = new \common\models\Reviews();
        $modelreviews->product_type_id = $model->type_product_id;

        if ($modelreviews->load(Yii::$app->request->post())) {
            $modelreviews->product_type_id = $model->type_product_id;
            $modelreviews->status_review = '0';
            $modelreviews->save();
            Yii::$app->session->setFlash('success', 'Отзыв отправлен на модерацию');
            $this->redirect(Url::current());
        }

        $reviews = \common\models\Reviews::search(['product_type_id' => $model->type_product_id, 'status_review' => 1]);

        $simple = new ActiveDataProvider([
            'query' => Simpleproducts::find(),
        ]);


        return $this->render('item', [
            'model' => $model,
            'items' => $items,
            'filterForm' => $this->filterForm,
            'modelreviews' => $modelreviews,
            'reviews' => $reviews,
            'simple' => $simple,
        ]);
    }

    public function actionGems($id)
    {
        $model = ProductGemsPrices::findOne($id);
        //
        $simple = new ActiveDataProvider([
            'query' => Simpleproducts::find(),
        ]);
        if ($simple AND $model)
            return $this->render('gems', [
                'model' => $model,
                'simple' => $simple,
            ]);
        else {
            Yii::$app->response->redirect(Url::to('/'));
        }
    }


    public function mysendEmail($mail, $params)
    {

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'new-orders'],
                [
                    'positions' => $params['positions'],
                    'contacts' => $params['contacts'],
                    'comments' => $params['comments']
                ]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($mail)
            ->setSubject('New order')
            ->send();
    }

    public function actionUser()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => \common\models\Orders::find()->where(['=', 'id_customers', Yii::$app->user->id])->OrderBy('id_orders DESC'),
        ]);

        return $this->render('userorders', [
            'dataProvider' => $dataProvider,
        ]);
    }

}
