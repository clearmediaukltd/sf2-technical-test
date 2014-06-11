<?php

namespace EA\GitHubAPISearchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
	private $api_endpoint = 'https://api.github.com/users/USER_NAME/repos';	// Must have 'USER_NAME' in it for str_replace

	/**
	 * Loads the main search page
	 *
	 * @param void
	 * @return rendered twig template
	 * @access public
	 */
    public function indexAction()
    {
        return $this->render('EAGitHubAPISearchBundle:Default:index.html.twig');
    }

	/**
	 * Return a ajax response
	 *
	 * @param void
	 * @return Response
	 * @access public
	 */
	public function searchAction($username) 
	{
	 	$return = $this->_do_api_request($username);
		return new Response($return, 200, array('Content-Type' => 'application/json')); // make sure it has the correct content type
	}

	/**
	 * performs the actual API call
	 *
	 * @param string
	 * @return string
	 * @access private
	 */
	private function _do_api_request($username)
	{
		$api_endpoint = $this->_apply_username_to_api_url($username);
		$ch = curl_init();	
		curl_setopt($ch, CURLOPT_URL, $api_endpoint);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, 'LinkvaultApi');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$res = curl_exec($ch);
		curl_close($ch);
		return $res;
	}

	/**
	 * replaces the search string 'USER_NAME' with the supplied username
	 *
	 * @param string
	 * @return string
	 * @access private
	 */
	private function _apply_username_to_api_url($username)
	{
		$api_url = str_replace('USER_NAME', $username, $this->api_endpoint);

		return $api_url;
	}

}

/* End of file: DefaultController.php */