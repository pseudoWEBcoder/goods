<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%properties_values}}`.
 */
class m180616_231440_create_table_properties_values extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%properties_values}}', [

            'id' => $this->primaryKey()->notNull(),
            'goods_id' => $this->integer(11)->notNull(),
            'properties_id' => $this->integer(11)->notNull(),
            'value' => $this->string(255)->notNull(),

        ]);

        // creates index for column `goods_id`
        $this->createIndex(
            'igoods',
            '{{%properties_values}}',
            'goods_id'
        );

        // add foreign key for table `goods`
        $this->addForeignKey(
            'igoods',
            '{{%properties_values}}',
            'goods_id',
            '{{%goods}}',
            'goods_id',
            'CASCADE'
        );

        // creates index for column `properties_id`
        $this->createIndex(
            'igoods_properties',
            '{{%properties_values}}',
            'properties_id'
        );

        // add foreign key for table `goods_properties`
        $this->addForeignKey(
            'igoods_properties',
            '{{%properties_values}}',
            'properties_id',
            '{{%goods_properties}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `goods`
        $this->dropForeignKey(
            'igoods',
            '{{%properties_values}}'
        );

        // drops index for column `goods_id`
        $this->dropIndex(
            'igoods',
            '{{%properties_values}}'
        );

        // drops foreign key for table `goods_properties`
        $this->dropForeignKey(
            'igoods_properties',
            '{{%properties_values}}'
        );

        // drops index for column `properties_id`
        $this->dropIndex(
            'igoods_properties',
            '{{%properties_values}}'
        );

        $this->dropTable('{{%properties_values}}');
    }
}
