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
    private const DEFAULT_DSN = 'mysql:dbname=imt2291_eksamen2018;host=127.0.0.1';
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
    function insertBattery($id, $cells, $capacity, $cRating, $purchaseDate) {

        // prepare ret
        $ret['status'] = 'fail';
        $ret['message'] = null;


        // try and insert into db
        try {

            // prepare insert statement
            $stmt = $this->dbh->prepare('
INSERT INTO batteries (id, cells, capacity, maxDischarge, purchaseDate) 
VALUES (:id, :cells, :capacity, :maxDischarge, :purchaseDate)'
            );

            // bind with given paramters
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':cells', $cells);
            $stmt->bindParam(':capacity', $capacity);
            $stmt->bindParam(':maxDischarge', $cRating);
            $stmt->bindParam(':purchaseDate', $purchaseDate);

            // try and execute statement and react to success/fail
            if ($stmt->execute()) {

                // statement executed, but was something actually inserted?
                if ($stmt->rowCount() > 0) {
                    $ret['status'] = 'ok';
                } else {
                    $ret['message'] = "Statement executed right, but no rows were inserted: ";
                }

            } else {
                $ret['message'] = "Statement didn't execute right : " . $stmt->errorInfo()[2];
            }

        } catch (PDOException $ex) {
            $ret['status'] = 'fail';
            $ret['message'] = "Something went wrong when inserting: " . $ex->getMessage();
        }

        return $ret;
    }
}
