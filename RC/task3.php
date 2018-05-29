<?php

require_once dirname(__FILE__) . '/vendor/autoload.php';
require_once dirname(__FILE__) . '/DB.php';

// setup twig environment
$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader);
$twigArguments = array();
$twigArguments['messages'] = array();
$twigArguments['batterypackArray'] = array();
$twigArguments['aircraftArray'] = array();

// prepare DB
$db = new DB();





// SETUP BATTERYPACK ARGUMENT

// get batterypacks from database
$ret_getBatterypacks = $db->getBatteries();

// if fail -> add message and continue
// if success -> fill twig arguments with batterypack info
if ($ret_getBatterypacks['status'] != 'ok') {

    // add message
    array_push(
        $twigArguments['messages'], 
        'Klarte ikke laste batteripakker... Melding fra datase: ' . $ret_getBatterypacks['message']
    );
} else {

    // add all batterypacks to twig arguments
    foreach ($ret_getBatterypacks['batteries'] as $batterypack) {

        // build display string for batterypack
        // Format taken from task description: "#<id> - <cells>cell/<capacity> mAh"
        $batteryText = '#' . $batterypack['id'] . ' - ' . $batterypack['cells'] . 
                'cell/' . $batterypack['capacity'] . ' mAh';

        // insert pack into twig arguments
        array_push(
            $twigArguments['batterypackArray'], 
            [
                'id' => $batterypack['id'], 
                'text' => $batteryText
            ]
        );
    }
}




// SETUP AIRCRAFT ARGUMENT

// get aircraft from database
$ret_getAircraft = $db->getAircraft();

// if fail -> add message and continue
// if success -> fill twig arguments with aircraft info
if ($ret_getAircraft['status'] != 'ok') {

    // add message
    array_push(
        $twigArguments['messages'], 
        'Klarte ikke laste fartøy... Melding fra datase: ' . $ret_getAircraft['message']
    );
} else {

    // add all aircraft to twig arguments
    foreach ($ret_getAircraft['aircraft'] as $aircraft) {
        array_push(
            $twigArguments['aircraftArray'], 
            [
                'id' => $aircraft['id'], 
                'text' => $aircraft['name']
            ]
        );
    }
}






// SETUP DATE ARGUMENT

// initial date should be current date
$date = date('Y-m-d');
$twigArguments['date'] = $date;















// HANDLE FORM POST

// if post incomming, handle it
if (isset($_POST['batteryid']) &&
        isset($_POST['craftid']) &&
        isset($_POST['flighttime']) &&
        isset($_POST['remainingcapacity']) &&
        isset($_POST['date'])) {

    // SHOULD ASSERT THAT $_POST['flighttime'] is properly formatted here, but 
    // leaving out for now to save time


    // insert into db
    $ret_insertBatteryStatus = $db->insertBatterystatus(
        $_POST['craftid'],
        $_POST['batteryid'],
        $_POST['flighttime'],
        $_POST['remainingcapacity'],
        $_POST['date']
    );


    // if not okay -> show message with info from db
    // if okay -> show success message
    if ($ret_insertBatteryStatus['status'] != 'ok') {
        array_push(
            $twigArguments['messages'],
            'Ingen date lagret. Noe gikk galt under registrering. Melding fra database: ' . $ret_insertBatteryStatus['message']
        );
    } else {
        array_push(
            $twigArguments['messages'],
            'Data ble satt inn'
        );
    }
}



// render twig template with arguments
echo $twig->render('registerBatteryStatus.twig', $twigArguments);
