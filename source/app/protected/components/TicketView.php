<?php

    class TicketView
        extends CWidget
    {
        public $model;

        public $topic_head;

        public $comments = [];

        public function run ()
        {
            $this->render ('ticketView');
        }

    }

?>