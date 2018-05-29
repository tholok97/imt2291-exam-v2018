<?php

require_once dirname(__FILE__) . '/vendor/autoload.php';
require_once dirname(__FILE__) . '/DB.php';

// setup twig environment
$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader);
$twigArguments = array();


// TBA: handle form post


// render twig template with arguments
echo $twig->render('registerBatteryStatus.twig', $twigArguments);
