<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrer batteri</title>
    <style>

/* Prettify form. Make align vertically using csss grid */
form {
    display: grid;
    grid-template-columns: 1fr 1fr;
    width: 500px;
    margin-bottom: 50px;
}

    </style>
</head>
<body>
    
    <h1>Registrer nytt batteri</h1>

    <!-- form for adding battery -->
    <form method="post" action="">
        <label for="id">Id (1-1000):</label>                        <input name="id" type="number">
        <label for="cells">Celler (1-24):</label>                   <input name="cells" type="number">
        <label for="capacity">Kapasitet (mAh, 50-20000):</label>    <input name="capacity" type="number">
        <label for="crating">C-rating (1-200):</label>              <input name="crating" type="number">
        <label for="purchasedate">Purchase date:</label>            <input name="purchasedate" type="date">
        <input type="submit" value="Lagre informasjon">
    </form>

</body>
</html>



<?php

require_once dirname(__FILE__) . '/DB.php';

/**
 * Prints given message with some formatting
 */
function printMessage($msg) {
    echo '<i>' . $msg . '</i>';
}

// if received post request from form -> try and insert into db
if (    isset($_POST['id']) &&
        isset($_POST['cells']) &&
        isset($_POST['capacity']) &&
        isset($_POST['crating']) &&
        isset($_POST['purchasedate'])) {

    // store POST paramters as variables
    $id = $_POST['id'];
    $cells = $_POST['cells'];
    $capacity = $_POST['capacity'];
    $crating = $_POST['crating'];
    $purchaseDate = $_POST['purchasedate'];


    // assert that parameters are within bounds 
    if (  !($id >= 1        && $id <= 1000 &&
            $cells >= 1     && $cells <= 24 &&
            $capacity >= 50 && $capacity <= 20000 &&
            $crating >= 1   && $crating <= 200)) {

        // input is invalid. print message and exit
        printMessage('Data ble ikke lagret. Ugyldig input. Sikre at alt er innenfor de gitte intervallene');
        exit();

    }

    // prepare db object
    $db = new DB();

    // insert into db (db will handle incorrect formatting)
    $ret = $db->insertBattery(
        $_POST['id'],
        $_POST['cells'],
        $_POST['capacity'],
        $_POST['crating'],
        $_POST['purchasedate']
    );

    // if insertion failed, display DB error message to user
    if ($ret['status'] != 'ok') {

        // show error message from DB and exit
        printMessage('Data ble ikke lagret. Melding fra database: ' . $ret['message']);
        exit();
    }

    // if got this far -> inserted!
    printMessage('Data ble lagret');
}
