<?php

namespace common\models;


use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ParserGemstypeReservedkeys;

/**
 * ParserGemstypeReservedkeys_Search represents the model behind the search form about `app\models\ParserGemstypeReservedkeys`.
 */
class ParserGemstypeReservedkeys_Search extends ParserGemstypeReservedkeys
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_1cparser_grk'], 'integer'],
            [['keyword_1cparser_grk', 'russian_1cparser_grk'], 'safe'],
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
        $query = ParserGemstypeReservedkeys::find();

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
            'id_1cparser_grk' => $this->id_1cparser_grk,
        ]);

        $query->andFilterWhere(['like', 'keyword_1cparser_grk', $this->keyword_1cparser_grk])
            ->andFilterWhere(['like', 'russian_1cparser_grk', $this->keyword_1cparser_grk]);

        return $dataProvider;
    }
}
