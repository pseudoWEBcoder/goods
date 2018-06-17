<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%goods_properties}}`.
 */
class m180617_041006_create_table_goods_properties extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%goods_properties}}', [

            'id' => $this->primaryKey()->notNull(),
            'name' => $this->string(255)->notNull(),
            'type' => $this->string(255)->notNull(),
            'title' => $this->string(500)->notNull(),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%goods_properties}}');
    }
}
