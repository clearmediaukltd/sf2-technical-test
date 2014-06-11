<?php

namespace EA\GitHubAPISearchBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
	/** 
	 * Checks to see if our search url is password protected
	 * and then logs in, and checks whether we're redirected to the
	 * correct "search" page
	 */
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/search');

        // redirects to the login page
        $crawler = $client->followRedirect();

        // submits the login form
        $form = $crawler->selectButton('Login')->form(array('_username' => 'admin', '_password' => 'adminpass'));
        $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertGreaterThan(0, $crawler->filter('html:contains("Search GitHub")')->count());
    }

}
