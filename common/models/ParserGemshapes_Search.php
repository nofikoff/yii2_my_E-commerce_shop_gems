<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ParserGemshapes;

/**
 * ParserGemshapes_Search represents the model behind the search form about `common\models\ParserGemshapes`.
 */
class ParserGemshapes_Search extends ParserGemshapes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_1cparser_shapes', 'exclude_1cparser_shape', 'product_shape_id'], 'integer'],
            [['name_1cparser_shapes'], 'safe'],
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
        $query = ParserGemshapes::find();

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
            'id_1cparser_shapes' => $this->id_1cparser_shapes,
            'exclude_1cparser_shape' => $this->exclude_1cparser_shape,
            'product_shape_id' => $this->product_shape_id,
        ]);

        $query->andFilterWhere(['like', 'name_1cparser_shapes', $this->name_1cparser_shapes]);

        return $dataProvider;
    }
}
