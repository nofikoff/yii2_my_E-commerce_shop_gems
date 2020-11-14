<?php

namespace common\models;


use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ParserGemscolors;

/**
 * ParserGemscolors_Search represents the model behind the search form about `app\models\ParserGemscolors`.
 */
class ParserGemscolors_Search extends ParserGemscolors
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_1cparser_colors', 'exclude_1cparser_color', 'product_color_id'], 'integer'],
            [['name_1cparser_colors'], 'safe'],
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
        $query = ParserGemscolors::find();

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
            'id_1cparser_colors' => $this->id_1cparser_colors,
            'exclude_1cparser_color' => $this->exclude_1cparser_color,
            'product_color_id' => $this->product_color_id,
        ]);

        $query->andFilterWhere(['like', 'name_1cparser_colors', $this->name_1cparser_colors]);

        return $dataProvider;
    }
}
