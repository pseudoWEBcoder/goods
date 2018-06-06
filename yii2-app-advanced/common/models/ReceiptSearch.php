<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Receipt;

/**
 * ReceiptSearch represents the model behind the search form of `\common\models\Receipt`.
 */
class ReceiptSearch extends Receipt
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['receipt_id', 'cashTotalSum', 'ecashTotalSum', 'taxationType', 'postpaymentSum', 'receiptCode', 'operationType', 'counterSubmissionSum', 'ndsNo', 'fiscalDocumentNumber', 'totalSum', 'requestNumber', 'shiftNumber', 'prepaymentSum', 'nds18', 'nds10'], 'integer'],
            [['userInn', 'operator', 'kktRegId', 'dateTime', 'fiscalSign', 'items', 'fiscalDriveNumber', 'user', 'messageFiscalSign', 'rawData', 'fnsUrl', 'operatorInn', 'retailPlaceAddress', 'stornoItems', 'modifiers'], 'safe'],
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
        $query = Receipt::find();

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
            'receipt_id' => $this->receipt_id,
            'cashTotalSum' => $this->cashTotalSum,
            'ecashTotalSum' => $this->ecashTotalSum,
            'taxationType' => $this->taxationType,
            'postpaymentSum' => $this->postpaymentSum,
            'receiptCode' => $this->receiptCode,
            'operationType' => $this->operationType,
            'counterSubmissionSum' => $this->counterSubmissionSum,
            'ndsNo' => $this->ndsNo,
            'fiscalDocumentNumber' => $this->fiscalDocumentNumber,
            'totalSum' => $this->totalSum,
            'requestNumber' => $this->requestNumber,
            'shiftNumber' => $this->shiftNumber,
            'prepaymentSum' => $this->prepaymentSum,
            'nds18' => $this->nds18,
            'nds10' => $this->nds10,
        ]);

        $query->andFilterWhere(['like', 'userInn', $this->userInn])
            ->andFilterWhere(['like', 'operator', $this->operator])
            ->andFilterWhere(['like', 'kktRegId', $this->kktRegId])
            ->andFilterWhere(['like', 'dateTime', $this->dateTime])
            ->andFilterWhere(['like', 'fiscalSign', $this->fiscalSign])
            ->andFilterWhere(['like', 'items', $this->items])
            ->andFilterWhere(['like', 'fiscalDriveNumber', $this->fiscalDriveNumber])
            ->andFilterWhere(['like', 'user', $this->user])
            ->andFilterWhere(['like', 'messageFiscalSign', $this->messageFiscalSign])
            ->andFilterWhere(['like', 'rawData', $this->rawData])
            ->andFilterWhere(['like', 'fnsUrl', $this->fnsUrl])
            ->andFilterWhere(['like', 'operatorInn', $this->operatorInn])
            ->andFilterWhere(['like', 'retailPlaceAddress', $this->retailPlaceAddress])
            ->andFilterWhere(['like', 'stornoItems', $this->stornoItems])
            ->andFilterWhere(['like', 'modifiers', $this->modifiers]);

        return $dataProvider;
    }
}
