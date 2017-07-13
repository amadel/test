<?php

use yii\db\Migration;

class m170713_161542_create_tables extends Migration
{
    public function safeUp(){

        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('link', [
            'id' => $this->primaryKey(),
            'original' => $this->string()->defaultValue('NULL'),
            'cut' => $this->string(45)->defaultValue('NULL'),
            'expire' => $this->dateTime()->defaultExpression('NULL'),
        ], $tableOptions);

        $this->createTable('statistic', [
            'id' => $this->primaryKey(),
            'country' => $this->string(255)->defaultValue('NULL'),
            'city' => $this->string(255)->defaultValue('NULL'),
            'goTime' => $this->dateTime()->defaultExpression('NULL'),
            'userAgent' => $this->string(255)->defaultValue('NULL'),
        ], $tableOptions);
    }

    public function safeDown(){

        $this->dropTable('link');
        $this->dropTable('statistic');
    }

}
