<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Constraint\IsType;

require_once dirname(__FILE__) . '/../User.php';

class UserManagerTest extends TestCase {

    /**
     * Assert that user is not logged in when User object is created
     */
    function testDefaultBehavior() {

        // create user object
        $user = new User();

        // assert 'state' session variable is not set to 'loggedIn'
        $this->assertNotEquals(
            'loggedIn',
            $_SESSION['state'],
            'state should not be loggedIn after constructing'
        );
    }

    /**
     * Assert that user is automatically logged in when correct session 
     * variable is set (state set to loggedIn)
     */
    function testAutomaticLogin() {

        // set state session variable to logged in
        $_SESSION['state'] = 'loggedIn';

        // create user object
        $user = new User();

        // assert 'state' session variable is not set to 'loggedIn'
        $this->assertTrue(
            $user->isLoggedIn(),
            'User should be logged in after providing correct session variable'
        );

    }

    /**
     * Assert that user login though POST paramters 'username' and 'password' 
     * is possible. Verification code should be generated, and loginForm() 
     * should show verifification form
     */
    function testLoginWithCredentials() {
        
        // set POST session variables for username and password to correct values
        $_POST['username'] = 'user';
        $_POST['password'] = 'pwd';

        // create user object
        // Should make state 'verifying', and generate verification token
        $user = new User();

        // assert 'state' session variable is set to 'verifying'
        $this->assertEquals(
            'verifying',
            $_SESSION['state'],
            'State should be verifying after successfully providing username/password'
        );

        // assert verification code set
        // (works because my verification code is a number)
        $this->assertInternalType(
            IsType::TYPE_INT,
            $_SESSION['verification_code'],
            'Verfication code should be generated as a '.
                    'number after successfully providng username/password'
        );

    }

    /**
     * Assert that user is logged in after providing correct 
     * verification through POST
     *
     * @depends testLoginWithCredentials
     */
    function testVerification() {

        // FIRST MAKE USER OBJECT GENERATES VERIFICATION CODE

        // set POST session variables for username and password to correct values
        $_POST['username'] = 'user';
        $_POST['password'] = 'pwd';

        // create user object
        // Should make state 'verifying', and generate verification token
        $user = new User();


        // NOW TEST IF USER CAN LOG IN USING VERIFICATION CODE
        
        // fetch the code and set to post argument
        $verification_code = $_SESSION['verification_code'];
        $_POST['verification_code'] = $verification_code;

        // simulate refresh of the page by making a new User object
        // User should be logged in
        $user = new User();

        // assert that user is now logged in
        $this->assertTrue(
            $user->isLoggedIn(),
            'User should be logged in after providing correct verification code through POST'
        );
    }

    /**
     * Assert that when logout GET parameter is set, the user is logged out, 
     * and SESSION variable indicating logged in is cleared
     */
    function testLogout() {

    }
}

