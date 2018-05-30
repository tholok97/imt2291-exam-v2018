<?php

/**
 * Returns ids of thumbnails of given aircraft
 */

require_once dirname(__FILE__) . '/../DB.php';

header("Access-Control-Allow-Origin: http://localhost:8081");

// prepare database
$db = new DB();

// try and fetch aircraft from database
$ret = $db->getAircraftThumbnails($_GET['craftid']);

echo json_encode($ret);
