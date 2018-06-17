<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%items}}`.
 */
class m180616_231440_create_table_items extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%items}}', [

            'item_id' => $this->primaryKey()->notNull(),
            'sum' => $this->integer(11),
            'quantity' => $this->double(),
            'price' => $this->integer(11),
            'name' => $this->string(255),
            'ndsRate' => $this->integer(11),
            'ndsSum' => $this->integer(11),
            'nds18' => $this->integer(11),
            'nds10' => $this->integer(11),
            'calculationSubjectSign' => $this->integer(11),
            'calculationTypeSign' => $this->integer(11),
            'modifiers' => $this->text(),
            'ndsNo' => $this->integer(11),
            'receipt_id' => $this->integer(11),
            'reason' => $this->text(),
            'image' => $this->string(800),
            'description' => $this->text(),
            'paymentType' => $this->integer(10),
            'nds' => $this->integer(10),
            'ndsCalculated10' => $this->integer(10),
            'ndsCalculated18' => $this->integer(10),
            'goods_id' => $this->integer(11),

        ]);

        // creates index for column `receipt_id`
        $this->createIndex(
            'fk-items-receipt_id',
            '{{%items}}',
            'receipt_id'
        );

        // add foreign key for table `receipt`
        $this->addForeignKey(
            'fk-items-receipt_id',
            '{{%items}}',
            'receipt_id',
            '{{%receipt}}',
            'receipt_id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `receipt`
        $this->dropForeignKey(
            'fk-items-receipt_id',
            '{{%items}}'
        );

        // drops index for column `receipt_id`
        $this->dropIndex(
            'fk-items-receipt_id',
            '{{%items}}'
        );

        $this->dropTable('{{%items}}');
    }
}
