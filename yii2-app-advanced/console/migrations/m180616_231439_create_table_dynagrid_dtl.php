<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%dynagrid_dtl}}`.
 */
class m180616_231439_create_table_dynagrid_dtl extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%dynagrid_dtl}}', [

            'id' => $this->string(100)->notNull(),
            'category' => $this->string(10)->notNull(),
            'name' => $this->string(150)->notNull(),
            'data' => $this->text(),
            'dynagrid_id' => $this->string(100)->notNull(),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%dynagrid_dtl}}');
    }
}
