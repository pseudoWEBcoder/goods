<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%dynagrid}}`.
 */
class m180617_041005_create_table_dynagrid extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%dynagrid}}', [

            'id' => $this->string(100)->notNull(),
            'filter_id' => $this->string(100),
            'sort_id' => $this->string(100),
            'data' => $this->text(),

        ]);

        // creates index for column `filter_id`
        $this->createIndex(
            'dynagrid_FK1',
            '{{%dynagrid}}',
            'filter_id'
        );

        // add foreign key for table `dynagrid_dtl`
        $this->addForeignKey(
            'dynagrid_FK1',
            '{{%dynagrid}}',
            'filter_id',
            '{{%dynagrid_dtl}}',
            'id',
            'CASCADE'
        );

        // creates index for column `sort_id`
        $this->createIndex(
            'dynagrid_FK2',
            '{{%dynagrid}}',
            'sort_id'
        );

        // add foreign key for table `dynagrid_dtl`
        $this->addForeignKey(
            'dynagrid_FK2',
            '{{%dynagrid}}',
            'sort_id',
            '{{%dynagrid_dtl}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `dynagrid_dtl`
        $this->dropForeignKey(
            'dynagrid_FK1',
            '{{%dynagrid}}'
        );

        // drops index for column `filter_id`
        $this->dropIndex(
            'dynagrid_FK1',
            '{{%dynagrid}}'
        );

        // drops foreign key for table `dynagrid_dtl`
        $this->dropForeignKey(
            'dynagrid_FK2',
            '{{%dynagrid}}'
        );

        // drops index for column `sort_id`
        $this->dropIndex(
            'dynagrid_FK2',
            '{{%dynagrid}}'
        );

        $this->dropTable('{{%dynagrid}}');
    }
}
