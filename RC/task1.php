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
        <label for="id">Id:</label>                         <input name="Id" type="number">
        <label for="cells">Celler:</label>                  <input name="cells" type="number">
        <label for="capacity">Kapasitet (mAh):</label>      <input name="capacity" type="number">
        <label for="crating">C-rating:</label>              <input name="crating" type="number">
        <label for="purchasedate">Purchase date:</label>    <input name="purchasedate" type="date">
        <input type="button" value="Lagre informasjon">
    </form>

</body>
</html>


<?php

// TBA





