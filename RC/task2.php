<?php

require_once dirname(__FILE__) . '/vendor/autoload.php';

// setup twig environment
$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader);
$twigArguments = array();


// TBA:
// handle post from form



// render twig template with arguments
echo $twig->render('registerVessel.twig', $twigArguments);
