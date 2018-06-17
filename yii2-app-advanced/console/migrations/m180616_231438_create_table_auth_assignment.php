<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%auth_assignment}}`.
 */
class m180616_231438_create_table_auth_assignment extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%auth_assignment}}', [

            'item_name' => $this->string(64)->notNull(),
            'user_id' => $this->string(64)->notNull(),
            'created_at' => $this->integer(11),

        ]);

        // creates index for column `item_name`
        $this->createIndex(
            'auth_assignment_ibfk_1',
            '{{%auth_assignment}}',
            'item_name'
        );

        // add foreign key for table `auth_item`
        $this->addForeignKey(
            'auth_assignment_ibfk_1',
            '{{%auth_assignment}}',
            'item_name',
            '{{%auth_item}}',
            'name',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `auth_item`
        $this->dropForeignKey(
            'auth_assignment_ibfk_1',
            '{{%auth_assignment}}'
        );

        // drops index for column `item_name`
        $this->dropIndex(
            'auth_assignment_ibfk_1',
            '{{%auth_assignment}}'
        );

        $this->dropTable('{{%auth_assignment}}');
    }
}
