<?php

use yii\db\Migration;

/**
 * Class m240816_224853_projects
 */
class m240816_224853_projects extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%project}}', [
            'id' => $this->primaryKey(),
            'idCategory'=>$this->integer()->notNull()->defaultValue(0),
            'idCustomer'=>$this->integer()->notNull()->defaultValue(0),
            'title' => $this->string(255)->notNull(),
            'description'=>$this->text()->notNull(),
            'budget'=>$this->decimal(10,2)->notNull()->defaultValue(0.00),
            'color'=>$this->string(255)->notNull()->defaultValue(''),
            'state' => $this->integer(11)->notNull()->defaultValue(1),
            'archive' => $this->integer(11)->notNull()->defaultValue(0),
            'deleted' => $this->integer(11)->notNull()->defaultValue(0),
            'owner' => $this->integer(11)->notNull(),
            'priority' => $this->integer(11)->notNull()->defaultValue(3),
            'createdAt' => $this->dateTime()->notNull(),
            'createdFrom' => $this->integer(255)->notNull(),
            'updatedAt' => $this->dateTime()->notNull(),
            'updatedFrom' => $this->integer(255)->notNull(),
        ]);
        $this->createIndex('idx_project_title', '{{%project}}', 'title');
        $this->createIndex('idx_project_state', '{{%project}}', 'state');
        $this->createIndex('idx_project_owner', '{{%project}}', 'owner');

        $this->createTable('{{%project_category}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->text()->notNull(),
            'color'=>$this->string(255)->notNull()->defaultValue(''),
            'sort'=>$this->integer()->notNull()->defaultValue(0),
            'deleted'=>$this->integer(11)->notNull()->defaultValue(0),
            'createdAt'=>$this->dateTime()->notNull(),
            'createdFrom'=>$this->integer(255)->notNull(),
            'updatedAt'=>$this->dateTime()->notNull(),
            'updatedFrom'=>$this->integer(255)->notNull(),
        ]);
        $this->createIndex('idx_project_category_title', '{{%project_category}}', 'title');

        $this->createTable('{{%project_task}}', [
            'id'=>$this->primaryKey(),
            'idProject'=>$this->integer(11)->notNull(),
            'title'=>$this->string(255)->notNull(),
            'description'=>$this->text()->notNull()->defaultValue(""),
            'expiration'=>$this->dateTime()->notNull()->defaultValue('1970-01-01 00:00:00'),
            'estimate'=>$this->decimal(10,2)->notNull()->defaultValue(0),
            'state'=>$this->integer(11)->notNull()->defaultValue(1),
            'deleted'=>$this->integer(11)->notNull()->defaultValue(0),
            'owner'=>$this->integer(11)->notNull(),
            'deadline'=>$this->dateTime()->notNull()->defaultValue('1970-01-01 00:00:00'),
            'createdAt'=>$this->dateTime()->notNull(),
            'createdFrom'=>$this->integer(255)->notNull(),
            'updatedAt'=>$this->dateTime()->notNull(),
            'updatedFrom'=>$this->integer(255)->notNull(),
        ]);
        $this->createIndex('idx_project_task_idProject', '{{%project_task}}', 'idProject');
        $this->addForeignKey('fk_project_task_idProject', '{{%project_task}}', 'idProject', '{{%project}}', 'id', 'RESTRICT');

        $this->createTable('{{%project_task_comment}}', [
            'id'=>$this->primaryKey(),
            'idProjectTask'=>$this->integer(11)->notNull(),
            'comment'=>$this->text()->notNull()->defaultValue(''),
            'attachment'=>$this->text()->notNull()->defaultValue(''),
            'deleted'=>$this->integer(11)->notNull()->defaultValue(0),
            'createdAt'=>$this->dateTime()->notNull(),
            'createdFrom'=>$this->integer(255)->notNull(),
            'updatedAt'=>$this->dateTime()->notNull(),
            'updatedFrom'=>$this->integer(255)->notNull(),
        ]);
        $this->createIndex('idx_project_task_comment_idProjectTask', '{{%project_task_comment}}', 'idProjectTask');
        $this->addForeignKey('fk_project_task_comment_idProjectTask', '{{%project_task_comment}}', 'idProjectTask', '{{%project_task}}', 'id', 'RESTRICT');

        $this->createTable('{{%project_task_time}}', [
            'id'=>$this->primaryKey(),
            'idProjectTask'=>$this->integer(11)->notNull(),
            'start'=>$this->dateTime()->notNull()->defaultValue('1970-01-01 00:00:00'),
            'end'=>$this->dateTime()->notNull()->defaultValue('1970-01-01 00:00:00'),
            'duration'=>$this->integer(11)->notNull()->defaultValue(0),
            'owner'=>$this->integer(11)->notNull()->defaultValue(0),
            'deleted'=>$this->integer(11)->notNull()->defaultValue(0),
            'createdAt'=>$this->dateTime()->notNull(),
            'createdFrom'=>$this->integer(255)->notNull(),
            'updatedAt'=>$this->dateTime()->notNull(),
            'updatedFrom'=>$this->integer(255)->notNull(),
        ]);

        $this->addForeignKey('fk_project_task_time_idProjectTask', '{{%project_task_time}}', 'idProjectTask', '{{%project_task}}', 'id', 'RESTRICT');
        $this->createIndex('idx_project_task_time_idProjectTask', '{{%project_task_time}}', 'idProjectTask');
        $this->createIndex('idx_project_task_time_owner', '{{%project_task_time}}', 'owner');

        $this->createTable('{{%customer}}', [
            'id'=>$this->primaryKey(),
            'name'=>$this->string(255)->notNull(),
            'address'=>$this->string(255)->notNull(),
            'plz'=>$this->string(255)->notNull(),
            'city'=>$this->string(255)->notNull(),
            'kdnr'=>$this->string(255)->notNull(),
            'note'=>$this->string(255)->notNull(),
        ]);
        $this->createIndex('idx_customer_name', '{{%customer}}', 'name');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_project_title', '{{%project}}');
        $this->dropIndex('idx_project_state', '{{%project}}');
        $this->dropIndex('idx_project_owner', '{{%project}}', 'owner');
        $this->dropTable('{{%project}}');

        $this->dropForeignKey('fk_project_task_comment_idProjectTask', '{{%project_task_comment}}');
        $this->dropIndex('idx_project_task_comment_idProjectTask', '{{%project_task_comment}}');
        $this->dropTable('{{%project_task_comment}}');

        $this->dropForeignKey('fk_project_task_idProject', '{{%project_task}}');
        $this->dropIndex('idx_project_task_idProject', '{{%project_task}}');
        $this->dropTable('{{%project_task}}');

        $this->dropIndex('idx_project_task_time_owner', '{{%project_task_time}}');
        $this->dropIndex('idx_project_task_time_idProjectTask', '{{%project_task_time}}');
        $this->dropForeignKey('fk_project_task_time_idProjectTask', '{{%project_task_time}}');
        $this->dropTable('{{%project_task_time}}');

        $this->dropTable('{{%customer}}');
        $this->dropTable('{{%project_category}}');

    }
}
