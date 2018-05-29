<?php

/**
 * Returns thumbnail of given aircraft
 * Expects _GET paramter: craftid
 */

require_once dirname(__FILE__) . '/DB.php';

// prepare db
$db = new DB();

// fetch thumbnail
$ret = $db->getAircraftThumbnail($_GET['craftid']);

// if everything went right -> echo image
// if not, return some debug text
if ($ret['status'] == 'ok') {

    header('Content-type: ' . $ret['mimeType']);
    echo $ret['thumbnail'];
} else {
    echo 'something went wrong.. ' . $ret['message'];
}

