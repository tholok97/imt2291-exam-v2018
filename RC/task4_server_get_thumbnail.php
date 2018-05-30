<?php

/**
 * Returns thumbnail of given aircraft
 * Expects _GET paramter: craftid
 */

require_once dirname(__FILE__) . '/DB.php';

// prepare db
$db = new DB();

// fetch thumbnail
//
// THIS FUNCTIONCALL RETURNS _THUMBNAIL_ WITH ID EQUAL TO CRAFTID. Read the task 
// description wrong. Though thumbnails were indexed on crafid... See TODO in README
$ret = $db->getAircraftThumbnail($_GET['craftid']);

// if everything went right -> echo image
// if not, return some debug text
if ($ret['status'] == 'ok') {

    header('Content-type: ' . $ret['mimeType']);
    echo $ret['thumbnail'];
} else {
    echo 'something went wrong.. ' . $ret['message'];
}

