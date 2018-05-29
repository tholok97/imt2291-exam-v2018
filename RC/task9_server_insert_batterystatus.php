<?php

require_once dirname(__FILE__) . '/DB.php';

// prepare DB
$db = new DB();

// insert into DB
$ret_insertBatteryStatus = $db->insertBatterystatus(
    $_POST['craftid'],
    $_POST['batteryid'],
    $_POST['flighttime'],
    $_POST['remainingcapacity'],
    $_POST['date']
);

// return ret as json
echo json_encode($ret_insertBatteryStatus);
