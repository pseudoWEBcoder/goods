<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Items;

/**
 * ItemsSearch represents the model behind the search form of `\common\models\Items`.
 */
class ItemsSearch extends Items
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'sum', 'quantity', 'price', 'ndsRate', 'ndsSum', 'nds18', 'nds10', 'calculationSubjectSign', 'calculationTypeSign', 'ndsNo', 'receipt_id'], 'integer'],
            [['name', 'modifiers'], 'safe'],
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
        $query = Items::find();

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
            'item_id' => $this->item_id,
            'sum' => $this->sum,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'ndsRate' => $this->ndsRate,
            'ndsSum' => $this->ndsSum,
            'nds18' => $this->nds18,
            'nds10' => $this->nds10,
            'calculationSubjectSign' => $this->calculationSubjectSign,
            'calculationTypeSign' => $this->calculationTypeSign,
            'ndsNo' => $this->ndsNo,
            'receipt_id' => $this->receipt_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'modifiers', $this->modifiers]);

        return $dataProvider;
    }
}
