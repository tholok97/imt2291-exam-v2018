<?php

require_once dirname(__FILE__) . '/vendor/autoload.php';
require_once dirname(__FILE__) . '/DB.php';

// setup twig environment
$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader);
$twigArguments = array();


// TBA: handle form post


// DEBUG fake arguments:
$twigArguments['aircraftArray'] = [
    ["id" => "1", "text" => "superaircraft"],
    ["id" => "2", "text" => "anotherone"],
    ["id" => "3", "text" => "third"]
];

$twigArguments['batterypackArray'] = [
    ["id" => "1", "text" => "bpack"],
    ["id" => "2", "text" => "bpack2"],
    ["id" => "3", "text" => "alsdkfj"]
];

$twigArguments['date'] = "2018-05-29";


// render twig template with arguments
echo $twig->render('registerBatteryStatus.twig', $twigArguments);
