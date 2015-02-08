<?php 

	session_start();

	require_once '../vendor/autoload.php';

	/**
	* 
	*/
	class SocialTest extends PHPUnit_Framework_TestCase
	{
		protected $social;

		public function setup()
		{
			$this->social = Social\Social::init();
		}

		public function inputNetworks()
		{
			return [
				['tumblr','facebrooks','twit', [], " "]
			];
		}

		/**
		 * @expectedException Social\SocialException
		 * @dataProvider inputNetworks 
		 */
		public function testNetworkThrowsSocialException($network)
		{
			$network = $this->social->network($network);
		}

		/**
		 * @expectedException Social\SocialConfigException
		 */
		public function testNetworkInstanceofiSocialNetwork()
		{
			$network = $this->social->network('facebook');
			$this->assertInstanceOf('Social\\iSocialNetwork', $network);
		}

		public function teardown()
		{
			unset($this->social);
		}
	}

?>