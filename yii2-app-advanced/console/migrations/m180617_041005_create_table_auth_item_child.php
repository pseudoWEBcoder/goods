<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%auth_item_child}}`.
 */
class m180617_041005_create_table_auth_item_child extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%auth_item_child}}', [

            'parent' => $this->string(64)->notNull(),
            'child' => $this->string(64)->notNull(),

        ]);

        // creates index for column `parent`
        $this->createIndex(
            'auth_item_child_ibfk_1',
            '{{%auth_item_child}}',
            'parent'
        );

        // add foreign key for table `auth_item`
        $this->addForeignKey(
            'auth_item_child_ibfk_1',
            '{{%auth_item_child}}',
            'parent',
            '{{%auth_item}}',
            'name',
            'CASCADE'
        );

        // creates index for column `child`
        $this->createIndex(
            'auth_item_child_ibfk_2',
            '{{%auth_item_child}}',
            'child'
        );

        // add foreign key for table `auth_item`
        $this->addForeignKey(
            'auth_item_child_ibfk_2',
            '{{%auth_item_child}}',
            'child',
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
            'auth_item_child_ibfk_1',
            '{{%auth_item_child}}'
        );

        // drops index for column `parent`
        $this->dropIndex(
            'auth_item_child_ibfk_1',
            '{{%auth_item_child}}'
        );

        // drops foreign key for table `auth_item`
        $this->dropForeignKey(
            'auth_item_child_ibfk_2',
            '{{%auth_item_child}}'
        );

        // drops index for column `child`
        $this->dropIndex(
            'auth_item_child_ibfk_2',
            '{{%auth_item_child}}'
        );

        $this->dropTable('{{%auth_item_child}}');
    }
}
