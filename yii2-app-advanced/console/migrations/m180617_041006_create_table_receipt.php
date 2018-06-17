<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%receipt}}`.
 */
class m180617_041006_create_table_receipt extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%receipt}}', [

            'receipt_id' => $this->primaryKey()->notNull(),
            'userInn' => $this->text(),
            'cashTotalSum' => $this->integer(11),
            'ecashTotalSum' => $this->integer(11),
            'operator' => $this->text(),
            'taxationType' => $this->integer(11),
            'kktRegId' => $this->text(),
            'postpaymentSum' => $this->integer(11),
            'receiptCode' => $this->integer(11),
            'operationType' => $this->integer(11),
            'counterSubmissionSum' => $this->integer(11),
            'ndsNo' => $this->integer(11),
            'dateTime' => $this->string(255),
            'fiscalDocumentNumber' => $this->integer(11),
            'fiscalSign' => $this->string(20),
            'items' => $this->text(),
            'totalSum' => $this->integer(11),
            'requestNumber' => $this->integer(11),
            'shiftNumber' => $this->integer(11),
            'prepaymentSum' => $this->integer(11),
            'fiscalDriveNumber' => $this->text(),
            'user' => $this->text(),
            'messageFiscalSign' => $this->string(20),
            'nds18' => $this->integer(20),
            'rawData' => $this->text(),
            'nds10' => $this->integer(20),
            'fnsUrl' => $this->text(),
            'operatorInn' => $this->text(),
            'retailPlaceAddress' => $this->text(),
            'stornoItems' => $this->text(),
            'modifiers' => $this->text(),
            'retailPlace' => $this->string(500),
            'machineNumber' => $this->string(500),
            'sellerAddress' => $this->string(500),
            'buyerAddress' => $this->string(500),
            'provisionSum' => $this->string(500),
            'fnsSite' => $this->string(500),
            'propertiesUser' => $this->string(500),
            'fiscalDocumentFormatVer' => $this->string(500),
            'creditSum' => $this->string(500),
            'paymentAgentType' => $this->string(500),
            'prepaidSum' => $this->string(500),
            'internetSign' => $this->string(500),
            'addressToCheckFiscalSign' => $this->string(500),
            'senderAddress' => $this->string(500),
            'userProperty' => $this->string(500),
            'ndsCalculated10' => $this->string(500),
            'properties' => $this->string(500),
            'ndsCalculated18' => $this->string(500),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%receipt}}');
    }
}
