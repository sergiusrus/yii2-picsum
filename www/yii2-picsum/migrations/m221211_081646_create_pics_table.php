<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pics}}`.
 */
class m221211_081646_create_pics_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pics}}', [
            'id' => $this->primaryKey(),
            'image_id' => $this->integer()->comment('ID изображения'),
            'is_approved' => $this->boolean()->defaultValue(true)->comment('Одобрен'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pics}}');
    }
}
