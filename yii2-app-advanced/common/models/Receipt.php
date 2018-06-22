<?php

namespace common\models;

/**
 * This is the model class for table "receipt".
 *
 * @property int $receipt_id
 * @property string $userInn
 * @property int $cashTotalSum
 * @property int $ecashTotalSum
 * @property string $operator
 * @property int $taxationType
 * @property string $kktRegId
 * @property int $postpaymentSum
 * @property int $receiptCode
 * @property int $operationType
 * @property int $counterSubmissionSum
 * @property int $ndsNo
 * @property string $dateTime
 * @property int $fiscalDocumentNumber
 * @property string $fiscalSign
 * @property string $items
 * @property int $totalSum
 * @property int $requestNumber
 * @property int $shiftNumber
 * @property int $prepaymentSum
 * @property string $fiscalDriveNumber
 * @property string $user
 * @property string $messageFiscalSign
 * @property int $nds18
 * @property string $rawData
 * @property int $nds10
 * @property string $fnsUrl
 * @property string $operatorInn
 * @property string $retailPlaceAddress
 * @property string $stornoItems
 * @property string $modifiers
 * @property string $retailPlace
 * @property string $machineNumber
 * @property string $sellerAddress
 * @property string $buyerAddress
 * @property string $provisionSum
 * @property string $fnsSite
 * @property string $propertiesUser
 * @property string $fiscalDocumentFormatVer
 * @property string $creditSum
 * @property string $paymentAgentType
 * @property string $prepaidSum
 * @property string $internetSign
 * @property string $addressToCheckFiscalSign
 * @property string $senderAddress
 * @property string $userProperty
 * @property string $ndsCalculated10
 * @property string $properties
 * @property string $ndsCalculated18
 *
 * @property Items[] $items0
 */
class Receipt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'receipt';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userInn', 'operator', 'kktRegId', 'items', 'fiscalDriveNumber', 'user', 'rawData', 'fnsUrl', 'operatorInn', 'retailPlaceAddress', 'stornoItems', 'modifiers'], 'string'],
            [['cashTotalSum', 'ecashTotalSum', 'taxationType', 'postpaymentSum', 'receiptCode', 'operationType', 'counterSubmissionSum', 'ndsNo', 'fiscalDocumentNumber', 'totalSum', 'requestNumber', 'shiftNumber', 'prepaymentSum', 'nds18', 'nds10'], 'integer'],
            [['dateTime'], 'string', 'max' => 255],
            [['fiscalSign', 'messageFiscalSign'], 'string', 'max' => 20],
            [['retailPlace', 'machineNumber', 'sellerAddress', 'buyerAddress', 'provisionSum', 'fnsSite', 'propertiesUser', 'fiscalDocumentFormatVer', 'creditSum', 'paymentAgentType', 'prepaidSum', 'internetSign', 'addressToCheckFiscalSign', 'senderAddress', 'userProperty', 'ndsCalculated10', 'properties', 'ndsCalculated18'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'receipt_id' => 'Receipt ID',
            'userInn' => 'User Inn',
            'cashTotalSum' => 'Cash Total Sum',
            'ecashTotalSum' => 'Ecash Total Sum',
            'operator' => 'Operator',
            'taxationType' => 'Taxation Type',
            'kktRegId' => 'Kkt Reg ID',
            'postpaymentSum' => 'Postpayment Sum',
            'receiptCode' => 'Receipt Code',
            'operationType' => 'Operation Type',
            'counterSubmissionSum' => 'Counter Submission Sum',
            'ndsNo' => 'Nds No',
            'dateTime' => 'Date Time',
            'fiscalDocumentNumber' => 'Fiscal Document Number',
            'fiscalSign' => 'Fiscal Sign',
            'items' => 'Items',
            'totalSum' => 'Total Sum',
            'requestNumber' => 'Request Number',
            'shiftNumber' => 'Shift Number',
            'prepaymentSum' => 'Prepayment Sum',
            'fiscalDriveNumber' => 'Fiscal Drive Number',
            'user' => 'User',
            'messageFiscalSign' => 'Message Fiscal Sign',
            'nds18' => 'Nds18',
            'rawData' => 'Raw Data',
            'nds10' => 'Nds10',
            'fnsUrl' => 'Fns Url',
            'operatorInn' => 'Operator Inn',
            'retailPlaceAddress' => 'Retail Place Address',
            'stornoItems' => 'Storno Items',
            'modifiers' => 'Modifiers',
            'retailPlace' => 'Retail Place',
            'machineNumber' => 'Machine Number',
            'sellerAddress' => 'Seller Address',
            'buyerAddress' => 'Buyer Address',
            'provisionSum' => 'Provision Sum',
            'fnsSite' => 'Fns Site',
            'propertiesUser' => 'Properties User',
            'fiscalDocumentFormatVer' => 'Fiscal Document Format Ver',
            'creditSum' => 'Credit Sum',
            'paymentAgentType' => 'Payment Agent Type',
            'prepaidSum' => 'Prepaid Sum',
            'internetSign' => 'Internet Sign',
            'addressToCheckFiscalSign' => 'Address To Check Fiscal Sign',
            'senderAddress' => 'Sender Address',
            'userProperty' => 'User Property',
            'ndsCalculated10' => 'Nds Calculated10',
            'properties' => 'Properties',
            'ndsCalculated18' => 'Nds Calculated18',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems0()
    {
        return $this->hasMany(Items::className(), ['receipt_id' => 'receipt_id']);
    }

    public function getFormatedTotalSum()
    {
        return number_format($this->totalSum / 100, 2, '.', ' ');
    }

    public function getDateTimeAsDateTime($outf = 'Y-m-d H:i:s', $inf = 'Y-m-d\TH:i:s')
    {
        if ($this->dateTime)
            $d = \DateTimeImmutable::createFromFormat($inf, $this->dateTime);
        return $d ? $d->format($outf) : null;

    }

}
