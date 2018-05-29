<?php

require_once dirname(__FILE__) . '/vendor/autoload.php';
require_once dirname(__FILE__) . '/DB.php';

// setup twig environment
$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader);
$twigArguments = array();


// if recieved post from form -> try and insert into db
if (isset($_POST['name'])) {

    // if name is empty -> print message and continue execution
    if ($_POST['name'] == '') {

        $twigArguments['message'] = 'Data ble ikke lagret. Du må gi fartøyet et navn';

    } else {

        // set fpv (if set in post, should be true)
        $fpv = 0;
        if (isset($_POST['fpv'])) {
            $fpv = 1;
        }

        // set camera (if set in post, should be true)
        $camera = 0;
        if (isset($_POST['camera'])) {
            $camera = 1;
        }

        // prepare db object
        $db = new DB();

        // insert into db
        $ret = $db->insertVessel(
            $_POST['name'],
            $fpv,
            $camera
        );

        // if insertion failed, display DB error message to user
        // if success -> show success message
        if ($ret['status'] != 'ok') {

            // show error message from DB and exit
            $twigArguments['message'] = 'Data ble ikke lagret. Melding fra database: ' . $ret['message'];

        } else {

            $twigArguments['message'] = 'Data ble lagret';

        }

    }
}


// render twig template with arguments
echo $twig->render('registerVessel.twig', $twigArguments);
