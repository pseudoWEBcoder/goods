<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%goods}}`.
 */
class m180617_041006_create_table_goods extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%goods}}', [

            'goods_id' => $this->primaryKey()->notNull(),
            'name' => $this->string(255)->notNull(),
            'recognizable_name' => $this->integer(255),
            'edibility' => $this->boolean(),
            'shelf_life' => $this->integer(10),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%goods}}');
    }
}
