<?php

/**
 * Returns result of "$db->getBatteries" as json
 *
 * NOTE: Filtering is done at the client side
 */

require_once dirname(__FILE__) . '/DB.php';

// prepare database
$db = new DB();

// try and fetch aircraft from database
$ret = $db->getBatteries();

echo json_encode($ret);
