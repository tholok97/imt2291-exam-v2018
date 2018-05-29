<?php

/**
 * Allows for easy interaction with the database in the exam
 */
class DB {

    private $dsn;
    private $user;
    private $password;
    private $dbh;

    // Used as default values in constructor. These shouldn't be in version 
    // control, but I put them here for simplicity, as security is not a focus in this exam
    private const DEFAULT_DSN = 'mysql:dbname=imt2291_project1_db;host=127.0.0.1';
    private const DEFAULT_USER = 'root';
    private const DEFAULT_PASSWORD = '';

    /**
     * Constructs new DB object
     *
     * @param $dsn
     * @param $user
     * @param $password
     */
    function __construct($dsn = DB::DEFAULT_DSN, $user = DB::DEFAULT_USER,
            $password = DB::DEFAULT_PASSWORD) {

        $this->dsn = $dsn;
        $this->user = $user;
        $this->password = $password;

        try {
            $this->dbh = new PDO($this->dsn, $this->user, $this->password);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    /**
     * Insert new battery into database
     *
     * @param $id
     * @param $cells
     * @param $capacity
     * @param $crating
     * @param $purchasedate
     *
     * @return assoc array with status and message
     */
    function insertBattery($id, $cells, $capacty, $crating, $purchasedate) {

        $ret['status'] = 'ok';
        $ret['message'] = null;

        // TBA

        return $ret;
    }
}
