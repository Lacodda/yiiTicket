<?php

    class m170208_130255_create_tickets_comments_table
        extends CDbMigration
    {
        public function safeUp ()
        {
            $this->createTable (
                'tickets_comments',
                array (
                    'id'          => 'pk',
                    'date_create' => 'datetime DEFAULT CURRENT_TIMESTAMP',
                    'ticket_id'   => 'integer NOT NULL',
                    'user_id'     => 'integer NOT NULL',
                    'topic_head'  => 'integer NOT NULL DEFAULT \'0\'',
                    'text'        => 'text NOT NULL',
                ),
                'ENGINE=InnoDB CHARSET=utf8'
            );

            $this->addForeignKey ("tickets_comments_ticket_id", "tickets_comments", "ticket_id", "tickets", "id", "CASCADE", "RESTRICT");
            $this->addForeignKey ("tickets_comments_user_id", "tickets_comments", "user_id", "users", "id", "CASCADE", "RESTRICT");
        }

        public function safeDown ()
        {
            $this->dropTable ('tickets_comments');
        }
    }