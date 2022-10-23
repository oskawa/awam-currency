<?php

/**
 * Singleton - renvoi toujours la même instance mysqli
 */
class Database extends mysqli
{
    private static $instance = null;
    // db connection config vars
    private $user = 'root';
    private $pass = '';
    private $dbName = 'awam_php';
    private $dbHost = 'localhost';


    private function __construct()
    {
        parent::__construct($this->dbHost, $this->user, $this->pass, $this->dbName);
        if (mysqli_connect_error()) {
            exit('Connect Error (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
        }
        mysqli_set_charset($this, "utf8");
    }


    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}
