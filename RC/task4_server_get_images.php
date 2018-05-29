<?php

/**
 * Returns result of "$db->getAircraftImageIdsAndFilenames" as json
 */

require_once dirname(__FILE__) . '/DB.php';

// prepare database
$db = new DB();

// try and fetch aircraft from database
$ret = $db->getAircraftImageIdsAndFilenames();

echo json_encode($ret);
