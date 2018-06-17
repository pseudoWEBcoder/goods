<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%auth_item}}`.
 */
class m180616_231438_create_table_auth_item extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%auth_item}}', [

            'name' => $this->string(64)->notNull(),
            'type' => $this->integer()->notNull(),
            'description' => $this->text(),
            'rule_name' => $this->string(64),
            'data' => $this->binary(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),

        ]);

        // creates index for column `rule_name`
        $this->createIndex(
            'auth_item_ibfk_1',
            '{{%auth_item}}',
            'rule_name'
        );

        // add foreign key for table `auth_rule`
        $this->addForeignKey(
            'auth_item_ibfk_1',
            '{{%auth_item}}',
            'rule_name',
            '{{%auth_rule}}',
            'name',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `auth_rule`
        $this->dropForeignKey(
            'auth_item_ibfk_1',
            '{{%auth_item}}'
        );

        // drops index for column `rule_name`
        $this->dropIndex(
            'auth_item_ibfk_1',
            '{{%auth_item}}'
        );

        $this->dropTable('{{%auth_item}}');
    }
}
