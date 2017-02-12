<?php

    class m170208_130253_create_tickets_table
        extends CDbMigration
    {
        public function safeUp ()
        {
            $this->createTable (
                'tickets',
                array (
                    'id'            => 'pk',
                    'date_create'   => 'datetime DEFAULT CURRENT_TIMESTAMP',
                    'date_modified' => 'datetime DEFAULT CURRENT_TIMESTAMP',
                    'user_id'       => 'integer NOT NULL',
                    'department'    => 'string NOT NULL',
                    'topic'         => 'string NOT NULL',
                    'status'        => 'integer NOT NULL DEFAULT \'0\'',
                ),
                'ENGINE=InnoDB CHARSET=utf8'
            );

            $this->addForeignKey ("tickets_user_id", "tickets", "user_id", "users", "id", "CASCADE", "RESTRICT");
        }

        public function safeDown ()
        {
            $this->dropTable ('tickets');
        }
    }