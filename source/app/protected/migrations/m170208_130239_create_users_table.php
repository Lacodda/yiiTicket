<?php

    class m170208_130239_create_users_table
        extends CDbMigration
    {
        public function safeUp ()
        {
            $this->createTable (
                'users',
                array (
                    'id'            => 'pk',
                    'date_create'   => 'datetime DEFAULT CURRENT_TIMESTAMP',
                    'date_modified' => 'datetime DEFAULT CURRENT_TIMESTAMP',
                    'login'         => 'string NOT NULL',
                    'password'      => 'string NOT NULL',
                    'role'          => 'string NOT NULL',
                    'email'         => 'string NOT NULL',
                    'UNIQUE KEY `login` (`login`)',
                    'UNIQUE KEY `email` (`email`)',
                ),
                'ENGINE=InnoDB CHARSET=utf8'
            );
        }

        public function safeDown ()
        {
            $this->dropTable ('users');
        }
    }