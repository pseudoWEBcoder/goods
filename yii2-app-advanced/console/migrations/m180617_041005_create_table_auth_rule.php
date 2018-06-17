<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%auth_rule}}`.
 */
class m180617_041005_create_table_auth_rule extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%auth_rule}}', [

            'name' => $this->string(64)->notNull(),
            'data' => $this->binary(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%auth_rule}}');
    }
}
