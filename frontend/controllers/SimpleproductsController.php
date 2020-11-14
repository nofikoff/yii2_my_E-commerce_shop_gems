<?php

namespace frontend\controllers;


use Yii;
use common\models\Simpleproducts;
use common\models\ProductCartPosition;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yz\shoppingcart\ShoppingCart;

/**
 * SimpleproductsController implements the CRUD actions for Simpleproducts model.
 */
class SimpleproductsController extends Controller
{

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
    
    public function actionBuy($id)
    {
        $model = Simpleproducts::findOne($id);
        if ($model) {
            $cartPosition = new ProductCartPosition();
            $cartPosition->id = $model->id;
            $cartPosition->type = 'simple';
            $cartPosition->name = $model->name;
            \Yii::$app->cart->put($cartPosition, 1);
            return $this->redirect(['cart-view']);
        }
        throw new NotFoundHttpException();
    }
    
    public function actionCartView()
    { 
        foreach(Yii::$app->cart->positions as $position){
          return $this->render('_cart_item',['position'=>$position]);
        }
    }
    
}
