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
}

    </style>
</head>
<body>
    
    <h1>Registrer nytt batteri</h1>

    <!-- form for adding battery -->
    <form method="post" action="">
        <label for="id">Id:</label>                         <input name="id" type="number">
        <label for="cells">Celler:</label>                  <input name="cells" type="number">
        <label for="capacity">Kapasitet (mAh):</label>      <input name="capacity" type="number">
        <label for="crating">C-rating:</label>              <input name="crating" type="number">
        <label for="purchasedate">Purchase date:</label>    <input name="purchasedate" type="date">
        <input type="submit" value="Lagre informasjon">
    </form>

</body>
</html>



<?php

require_once dirname(__FILE__) . '/DB.php';

// DEBUG
print_r($_POST);

// if received post request from form -> try and insert into db
if (    isset($_POST['id']) &&
        isset($_POST['cells']) &&
        isset($_POST['capacity']) &&
        isset($_POST['crating']) &&
        isset($_POST['purchasedate'])) {

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
            // TBA
        }
}
