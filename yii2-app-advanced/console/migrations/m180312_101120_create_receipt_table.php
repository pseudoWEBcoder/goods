<?php

use yii\db\Migration;

/**
 * Handles the creation of table `receipt`.
 */
class m180312_101120_create_receipt_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('receipt', [
            'receipt_id' => $this->primaryKey(),
            'userInn' => $this->text(),
            'cashTotalSum' => $this->integer(),
            'ecashTotalSum' => $this->integer(),
            'operator' => $this->text(),
            'taxationType' => $this->integer(),
            'kktRegId' => $this->text(),
            'postpaymentSum' => $this->integer(),
            'receiptCode' => $this->integer(),
            'operationType' => $this->integer(),
            'counterSubmissionSum' => $this->integer(),
            'ndsNo' => $this->integer(),
            'dateTime' => $this->string(),
            'fiscalDocumentNumber' => $this->integer(),
            'fiscalSign' => $this->integer(),
            'items' => $this->text(),
            'totalSum' => $this->integer(),
            'requestNumber' => $this->integer(),
            'shiftNumber' => $this->integer(),
            'prepaymentSum' => $this->integer(),
            'fiscalDriveNumber' => $this->text(),
            'user' => $this->text(),
            'messageFiscalSign' => $this->integer(),
            'nds18' => $this->integer(),
            'rawData' => $this->text(),
            'nds10' => $this->integer(),
            'fnsUrl' => $this->text(),
            'operatorInn' => $this->text(),
            'retailPlaceAddress' => $this->text(),
            'stornoItems' => $this->text(),
            'modifiers' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('receipt');
    }
}
