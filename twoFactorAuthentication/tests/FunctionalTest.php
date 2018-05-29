<?php

/**
 * Functionally test site. 
 * Code inspired heavily by my groups solution to project 1
 */

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Constraint\IsType;
use Behat\Mink\Element\DocumentElement;
use Behat\Mink\Element\NodeElement;


require_once dirname(__FILE__) . '/../User.php';

class FunctionalTests extends TestCase {
    protected $baseUrl = 'http://localhost:8080/index.php';
    protected $session;

    // store page as property to allow for helper functions
    private $page;

    // test username and password
    private $testUsername = "user";
    private $testPassword = "pwd";


    protected function setup() {
        $driver = new \Behat\Mink\Driver\GoutteDriver();
        $this->session = new \Behat\Mink\Session($driver);
        $this->session->start();
    }

    /**
     * Test if site is even at given URL 
     */
    function testSiteIsAtURL() {

        // visit the page
        $this->session->visit($this->baseUrl);
        $this->page = $this->session->getPage();

        // check if initial login form exists
        $this->assertInstanceOf(
            NodeElement::Class,
            $this->page->find('css', '#thisIdIsUsedForTesting'),
            'Page should contain test element. (body)'
        );

    }

    /**
     * Test that we initially are not logged in
     *
     * @depends testSiteIsAtURL
     */
    function testInitiallyNotLoggedIn() {

        // visit the page
        $this->session->visit($this->baseUrl);
        $this->page = $this->session->getPage();

        // check if login form exists
        $this->assertInstanceOf(
            NodeElement::Class,
            $this->page->find('css', '#loginForm'),
            'We are not logged in, so the site should show us a login form'
        );
    }

    /**
     * Helper function that logs us into the site
     * After this function the page should show a verification form
     */
    function loginToSite() {

        // enter username, password
        $this->page->find('css', 'input[name="username"]')->setValue($this->testUsername);
        $this->page->find('css', 'input[name="password"]')->setValue($this->testPassword);
        
        // submit
        $this->page->find('css', '#loginForm')->submit();
        
        // refresh page
        $this->page = $this->session->getPage();
    }

    /**
     * Helper function that fills out verification form
     * After this function the page should show a logout link
     */
    function verify() {

        // determine verification code
        $verificationCode = $this->page->find('css', '#verificationCode')->getText();
        
        // enter code
        $this->page->find('css', 'input[name="verification_code"]')->setValue($verificationCode);

        // submit
        $this->page->find('css', '#verificationForm')->submit();
        
        // refresh page
        $this->page = $this->session->getPage();
    }

    /**
     * Test that after correctly typing username and password, the form for 
     * verification code is shown. Correctly entering verification code logs us in
     *
     * @depends testInitiallyNotLoggedIn
     */
    function testFullLogin() {

        // visit the page
        $this->session->visit($this->baseUrl);
        $this->page = $this->session->getPage();

        // login to site using helper function
        $this->loginToSite();

        // assert that site now shows verification form
        $this->assertInstanceOf(
            NodeElement::Class,
            $this->page->find('css', '#verificationForm'),
            'Logged in. Page should now show verification form'
        );

        // verify using helper function
        $this->verify();

        // assert that site now shows logout link
        $this->assertInstanceOf(
            NodeElement::Class,
            $this->page->find('css', '#logoutLink'),
            'Verified. Page should now show logout link'
        );
    }

    /**
     * Test that pressing the logout link actually logs us out
     *
     * @depends testFullLogin
     */
    function testLogout() {

        
    }
}
