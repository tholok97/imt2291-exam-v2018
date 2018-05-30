<?php

/**
 * Returns result of "$db->getAircraft" as json
 * TAKEN FROM TASK 4
 */

require_once dirname(__FILE__) . '/../DB.php';

header("Access-Control-Allow-Origin: http://localhost:8081");

// prepare database
$db = new DB();

// try and fetch aircraft from database
$ret = $db->getAircraft();

echo json_encode($ret);
