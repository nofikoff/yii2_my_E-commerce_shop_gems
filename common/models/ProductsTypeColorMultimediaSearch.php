<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProductsTypeColorMultimedia;

/**
 * ProductsTypeColorMultimediaSearch represents the model behind the search form about `common\models\ProductsTypeColorMultimedia`.
 */
class ProductsTypeColorMultimediaSearch extends ProductsTypeColorMultimedia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_my_products_type_color_multimedia', 'product_type_color_id', 'shape_id', 'flag_img_or_video'], 'integer'],
            [['products_filepath'], 'safe'],
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
    public function search($params)
    {
        $query = ProductsTypeColorMultimedia::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_my_products_type_color_multimedia' => $this->id_my_products_type_color_multimedia,
            'product_type_color_id' => $this->product_type_color_id,
            'shape_id' => $this->shape_id,
            'flag_img_or_video' => $this->flag_img_or_video,
        ]);

        $query->andFilterWhere(['like', 'products_filepath', $this->products_filepath]);

        return $dataProvider;
    }
}
