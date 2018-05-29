<?php

/**
 * Allows for easy interaction with the database in the exam
 */
class DB {

    private $dsn;
    private $user;
    private $password;
    private $dbh;

    /**
     * Constructs new DB object
     *
     * @param $dsn
     * @param $user
     * @param $password
     */
    private function __construct($dsn, $user, $password) {

        $this->dsn = $dsn;
        $this->user = $user;
        $this->password = $password;

        try {
            $this->dbh = new PDO($this->dsn, $this->user, $this->password);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
}
