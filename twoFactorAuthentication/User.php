<?php

/**
 * Encapsulates functionality for dealing with authentication of a user
 */
class User {

    private $loggedIn = false;

    /**
     * When constructed: handle forms submissions and prepare $_SESSION['state']
     */
    function __construct() {

        // the session variable 'state' contains the current state of the user:
        // loggedOff, verifying or loggedIn

        // if state isn't set, set it to loggedOff
        if (!isset($_SESSION['state'])) {
            $_SESSION['state'] = 'loggedOff';
        }

        // if state is logged in, set property loggedIn to true
        // NOTE: Not really necessary with my solution, but had to add it for 
        //  tests in task 6 to make sense
        if ($_SESSION['state'] == 'loggedIn') {
            $this->loggedIn = true;
        }

        // handle forms 
        $this->handleForm();

    }


    /**
     * Present login functionality to user.
     * IF NOT LOGGED IN: show login form
     * IF IN PROCESS OF LOGGING IN: show two-factor authentication form
     * IF LOGGED IN: show logout link
     */
    function loginForm() {

        // switch on the state of the user
        switch ($_SESSION['state']) {


        case 'loggedOff':
            
            // user is logged off, show login form
            echo '
<form method="post" action="">
    <label for="username">Username: </label><input name="username" type="text">
    <label for="password">Password: </label><input name="password" type="password">
    <input type="submit" value="Log in">
</form>
            ';

            break;

        case 'verifying':

            // user is verifying, show verification form
            echo '
<form method="post" action="">
    <label for="verification_code">Verification code: </label>
    <input name="verification_code" type="number">
    <input type="submit" value="Log in">
</form>
</br>
<i>Psst! The code is ' . $_SESSION['verification_code'] . '</i>
            ';

            break;

        case 'loggedIn':

            // user is logged in, show logout button
            echo '
<form method="post" action="">
    <input name="logout" type="hidden">
    <input type="submit" value="Logout">
</form>
            ';

            break;
        default:
            break;
        }


    }

    /**
     * Handle any form events that might have occured (login, logout, verify)
     */
    function handleForm() {

        // handle login form post
        if (isset($_POST['username']) && isset($_POST['password'])) {

            // if username, password correct -> set state to verifying
            // NOTE: password should be hased and stored in db, but for this 
            //  exam we are allowed to simplify things.
            if ($_POST['username'] == 'user' && $_POST['password'] == 'pwd') {

                // change state to verifying and prepare verification code
                $_SESSION['state'] = 'verifying';
                $_SESSION['verification_code'] = rand();

            } else {
                // handle error
            }

            unset($_POST['username']);
            unset($_POST['password']);
        }

        // handle verification form post
        if (isset($_POST['verification_code'])) {

            // if code correct -> login
            // if not -> error
            if ($_POST['verification_code'] == $_SESSION['verification_code']) {

                $_SESSION['state'] = 'loggedIn';
                unset($_SESSION['verification_code']);
                $this->loggedIn = true;

            } else {
                // handle error
            }

            unset($_POST['verification_code']);
        }

        // handle logout event
        if (isset($_POST['logout'])) {
            $_SESSION['state'] = 'loggedOff';
            unset($_POST['logout']);
        }

    }

    /**
     * Is the user logged in?
     */
    function isLoggedIn() {
        return $this->loggedIn;
    }
}
