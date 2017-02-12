<?php

    // This is the database connection configuration.
    return array (
        // 'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
        // uncomment the following lines to use a MySQL database

        'connectionString' => 'mysql:host=yiiticketdocker_mysql_1;dbname=site',
        'emulatePrepare'   => true,
        'username'         => 'site',
        'password'         => 'site',
        'charset'          => 'utf8',
    );