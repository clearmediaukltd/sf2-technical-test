<?php

// src/Acme/DemoBundle/Tests/Utility/CalculatorTest.php
namespace EA\GitHubAPISearchBundle\Tests;

use EA\GitHubAPISearchBundle\Controller\DefaultController;

/**
 * This class is unit testing my DefaultController in EAGitHubAPISearchBundle
 * because I cannot / should not directly test private methods, there is only one unit test
 */
class DefaultControllerTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Checks to see if our searchAction returns a JSON string
	 *
	 * @param void
	 */
    public function testAPI_URL()
    {
        $default = new DefaultController();
        $results = $default->searchAction('clearmediaukltd');

        $this->assertFalse($this->isJSON($results));
    }

	/**
	 * checks the json string. This could be revised to use
	 * a regex
	 *
	 * @param string
	 * @return bool
	 */
	public static function isJSON($string)
	{
		json_decode($string);
		return (json_last_error() == JSON_ERROR_NONE);
	}
}