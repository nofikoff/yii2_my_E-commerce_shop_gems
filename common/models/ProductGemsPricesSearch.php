<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProductGemsPrices;
use yii\helpers\ArrayHelper;

/**
 * ProductGemsPricesSearch represents the model behind the search form about `common\models\ProductGemsPrices`.
 */
class ProductGemsPricesSearch extends ProductGemsPrices
{
    public $widthFrom;
    public $widthTo;
    public $heightFrom;
    public $heightTo;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_product', 'type_product_id', 'shape', 'treatment_type', 'synthetic_type', 'exclusive_type', 'this_is_nabor', 'recommended_type', 'country_id', 'color_id', 'date_added', 'date_updated', 'this_is_nabor'], 'integer'],
            [['name_suffix', 'sku', 'characteristics_str', 'brand', 'treatment_type'], 'safe'],
            [['size_h', 'size_w', 'size_d', 'weight', 'widthFrom', 'widthTo', 'heightFrom', 'heightTo', 'price', 'price_promo', 'stock_points', 'stock_karats'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $all = true)
    {
        if ($all)
            $query = ProductGemsPrices::find()
                ->joinWith(['productsTypeColorVariation'])
                ->joinWith(['typeProduct'])
                ->joinWith(['productsSales'])
                ->groupBy(['color_id', 'my_product_gems_prices.type_product_id'])
                ->orderBy(['my_product_type.name_product_type' => SORT_ASC]);
        else
            $query = ProductGemsPrices::find()
                ->joinWith(['productsSales'])
                ->orderBy('shape');

        // add conditions that should always apply here


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 1000,
            ],
        ]);

        if ($params)
            $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_product' => $this->id_product,
            'my_product_gems_prices.type_product_id' => $this->type_product_id,
            'shape' => $this->shape,
            'weight' => $this->weight,
            'treatment_type' => $this->treatment_type,
            'synthetic_type' => $this->synthetic_type,
            'exclusive_type' => $this->exclusive_type,
            'this_is_nabor' => $this->this_is_nabor,
            'recommended_type' => $this->recommended_type,
            'country_id' => $this->country_id,
            //'color_id' => $this->color_id,
            'price' => $this->price,
            'price_promo' => $this->price_promo,
            'stock_points' => $this->stock_points,
            'stock_karats' => $this->stock_karats,
            'date_added' => $this->date_added,
            'date_updated' => $this->date_updated,
//            'this_is_nabor' => $this->this_is_nabor,
            'brand' => $this->brand,
        ]);

        if (isset($params['ProductGemsPricesSearch']['id_color_group']) && is_numeric($params['ProductGemsPricesSearch']['id_color_group'])) {
            //$color_group = ArrayHelper::getColumn(ArrayHelper::map(\common\models\ProductsColors::find()->where(['=', 'color_group_id', $params['ProductGemsPricesSearch']['id_color_group']])->all(), 'id_color', 'name'),'id_color');
            $color_array_group = ArrayHelper::map(\common\models\ProductsColors::find()->where(['=', 'color_group_id', $params['ProductGemsPricesSearch']['id_color_group']])->all(), 'id_color', 'id_color');
            $color_group = array();
            foreach ($color_array_group as $color_array_group_item) {
                $color_group[] = $color_array_group_item;
            }
            //$color_group = ArrayHelper::getColumn(ArrayHelper::map(\common\models\ProductsColors::find()->where(['=', 'color_group_id', $params['ProductGemsPricesSearch']['id_color_group']])->all(), 'id_color', 'name'),'id_color');
            $query->andFilterWhere(['in', 'color_id', $color_group]);
        }

        if (isset($params['ProductGemsPricesSearch']['color_product_id']) && is_numeric($params['ProductGemsPricesSearch']['color_product_id'])) {
            $query->andFilterWhere(['=', 'color_id', $params['ProductGemsPricesSearch']['color_product_id']]);
        }

        if (isset($params['ProductGemsPricesSearch']['prices'])) {
            if (is_numeric($params['ProductGemsPricesSearch']['prices'][0]) && is_numeric($params['ProductGemsPricesSearch']['prices'][1]))
                $query->andFilterWhere(['between', 'price', $params['ProductGemsPricesSearch']['prices'][0], $params['ProductGemsPricesSearch']['prices'][1]]);
        }

        if (isset($params['ProductGemsPricesSearch']['action'])) {
            $query->andFilterWhere(['=', 'status', 1]);
        }


        if (isset($params['ProductGemsPricesSearch']['instock'])) {
            $query->andFilterWhere(['>', 'stock_points', 0]);
        }


//        if (isset($this->heightFrom) && isset($this->heightTo)) {
//            $query->andFilterWhere(['between', 'size_h', $this->heightFrom, $this->heightTo]);
//        }
//        if (isset($this->widthFrom) && isset($this->widthTo)) {
//            $query->andFilterWhere(['between', 'size_w', $this->widthFrom, $this->widthTo]);
//        }

//заказчие попросил искать одновременно по двум комбинациям вида H x W затем перевернуть W x H
//HW
//00
//01
        if (!isset($this->heightFrom) && isset($this->widthFrom)) {

            $query->andFilterWhere(['between', 'size_h', $this->widthFrom, $this->widthTo]);
            $query->andFilterWhere(['between', 'size_w', $this->widthFrom, $this->widthTo]);
        } //10
        else if (isset($this->heightFrom) && !isset($this->widthFrom)) {

            $query->andFilterWhere(['between', 'size_h', $this->heightFrom, $this->heightTo]);
            $query->andFilterWhere(['between', 'size_w', $this->heightFrom, $this->heightTo]);
        } //11
        else if (isset($this->heightFrom) && isset($this->widthFrom)) {

            if ($this->heightFrom == $this->widthFrom AND $this->heightTo == $this->widthTo) {
                $query->andFilterWhere(['between', 'size_h', $this->heightFrom, $this->heightTo]);
                $query->andFilterWhere(['between', 'size_w', $this->widthFrom, $this->widthTo]);
            } else {
                // кручу верчу
                $query->andFilterWhere([
                    'or',
                    ['and', ['between', 'size_h', $this->heightFrom, $this->heightTo], ['between', 'size_w', $this->widthFrom, $this->widthTo]],
                    ['and', ['between', 'size_h', $this->widthFrom, $this->widthTo], ['between', 'size_w', $this->heightFrom, $this->heightTo]],
                ]);
            }
        }


        $query->andFilterWhere(['like', 'name_suffix', $this->name_suffix])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'characteristics_str', $this->characteristics_str]);

        if (isset($params['ProductGemsPricesSearch']['key'])) {
            $key = $params['ProductGemsPricesSearch']['key'];
            //$query->joinWith(['typeProduct']);
            $query->joinWith(['color']);
            $query->joinWith(['typeProduct']);
            $query->andFilterWhere([
                'or',
                ['like', 'name_suffix', $key],
                ['like', 'my_product_type.name_product_type', $key],
                ['like', 'my_products_colors.name_color', $key],
            ]);
        }

        return $dataProvider;
    }
}
