<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%menu}}`.
 */
class m180616_231440_create_table_menu extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%menu}}', [

            'id' => $this->primaryKey()->notNull(),
            'name' => $this->string(128)->notNull(),
            'parent' => $this->integer(11),
            'route' => $this->string(255),
            'order' => $this->integer(11),
            'data' => $this->binary(),

        ]);

        // creates index for column `parent`
        $this->createIndex(
            'menu_ibfk_1',
            '{{%menu}}',
            'parent'
        );

        // add foreign key for table `menu`
        $this->addForeignKey(
            'menu_ibfk_1',
            '{{%menu}}',
            'parent',
            '{{%menu}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `menu`
        $this->dropForeignKey(
            'menu_ibfk_1',
            '{{%menu}}'
        );

        // drops index for column `parent`
        $this->dropIndex(
            'menu_ibfk_1',
            '{{%menu}}'
        );

        $this->dropTable('{{%menu}}');
    }
}
