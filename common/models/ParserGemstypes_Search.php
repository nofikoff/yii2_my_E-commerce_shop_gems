<?php

namespace common\models;


use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ParserGemstypes;

/**
 * ParserGemstypes_Search represents the model behind the search form about `app\models\ParserGemstypes`.
 */
class ParserGemstypes_Search extends ParserGemstypes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_1cparser_gemstypes', 'exclude_1cparser_gemstype', 'product_type_id'], 'integer'],
            [['name_1cparser_gemstype'], 'safe'],
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
        $query = ParserGemstypes::find();

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
            'id_1cparser_gemstypes' => $this->id_1cparser_gemstypes,
            'exclude_1cparser_gemstype' => $this->exclude_1cparser_gemstype,
            'product_type_id' => $this->product_type_id,
        ]);

        $query->andFilterWhere(['like', 'name_1cparser_gemstype', $this->name_1cparser_gemstype]);

        return $dataProvider;
    }
}
