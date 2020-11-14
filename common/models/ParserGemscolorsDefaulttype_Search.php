<?php

namespace common\models;


use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ParserGemscolorsDefaulttype;

/**
 * ParserGemscolorsDefaulttype_Search represents the model behind the search form about `app\models\ParserGemscolorsDefaulttype`.
 */
class ParserGemscolorsDefaulttype_Search extends ParserGemscolorsDefaulttype
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_1cparser_gcdt', 'product_type_id', 'product_color_id'], 'integer'],
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
        $query = ParserGemscolorsDefaulttype::find();

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
            'id_1cparser_gcdt' => $this->id_1cparser_gcdt,
            'product_type_id' => $this->product_type_id,
            'product_color_id' => $this->product_color_id,
        ]);

        return $dataProvider;
    }
}
