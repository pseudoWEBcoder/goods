<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%goods}}`.
 */
class m180616_231003_create_table_goods extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%goods}}', [

            'goods_id' => $this->primaryKey()->notNull(),
            'name' => $this->string(255)->notNull(),

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
