<?php

/**
 * Page used to display functionality of User.php. Taken from task description
 */

session_start();
require_once 'User.php';

// (this line was not in the original task description, but I'm assuming 
//  it was supposed to be)
$user = new User();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login test</title>
  <style media="screen">
    label {
      display: inline-block;
      width: 7em;
    }
  </style>
</head>
<body>
  <?php
  echo $user->loginForm();
   ?>
</body>
</html>
