<?php

use app\models\User;
use yii\db\Migration;

/**
 * Class m240813_163757_base_user
 */
class m240813_163757_base_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey()->unsigned(),
            'username'=>$this->string(255)->notNull(),
            'password'=>$this->string(255)->notNull(),
            'authKey'=>$this->string(255)->notNull(),
            'status'=>$this->integer(11)->notNull(),
            'accessToken'=>$this->string(255)->notNull(),
            'email'=>$this->string(255)->notNull()->defaultValue(''),
            'createdAt'=>$this->dateTime()->notNull(),
            'createdFrom'=>$this->integer(255)->notNull(),
            'updatedAt'=>$this->dateTime()->notNull(),
            'updatedFrom'=>$this->integer(255)->notNull(),
        ]);
        $user = new User();
        $user->username = 'admin';
        $user->password = Yii::$app->security->generatePasswordHash('admin123');
        $user->authKey = Yii::$app->security->generateRandomString();
        $user->accessToken = Yii::$app->security->generateRandomString();
        $user->status = User::STATUS_ACTIVE;
        $user->createdAt = date('Y-m-d H:i:s');
        $user->createdFrom = 0;
        $user->updatedAt = date('Y-m-d H:i:s');
        $user->updatedFrom = 0;
        $user->save();

        $auth = Yii::$app->authManager;

        $superuserRole = $auth->createRole('superuser');
        $auth->add($superuserRole);
        $auth->assign($superuserRole, User::findOne(['username'=>'admin'])->id);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }

}
