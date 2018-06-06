<?php

use yii\db\Migration;

/**
 * Handles the creation of table `items`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m180312_111744_create_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('items', [
            'item_id' => $this->primaryKey(),
            'sum' => $this->integer(),
            'quantity' => $this->integer(),
            'price' => $this->integer(),
            'name' => $this->string(),
            'ndsRate' => $this->integer(),
            'ndsSum' => $this->integer(),
            'nds18' => $this->integer(),
            'nds10' => $this->integer(),
            'calculationSubjectSign' => $this->integer(),
            'calculationTypeSign' => $this->integer(),
            'modifiers' => $this->text(),
            'ndsNo' => $this->integer(),
            'receipt_id' => $this->integer(),
        ]);

        // creates index for column `receipt_id`
        $this->createIndex(
            'idx-items-receipt_id',
            'items',
            'receipt_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-items-receipt_id',
            'items',
            'receipt_id',
            'receipt',
            'receipt_id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-items-receipt_id',
            'items'
        );

        // drops index for column `receipt_id`
        $this->dropIndex(
            'idx-items-receipt_id',
            'items'
        );

        $this->dropTable('items');
    }
}
