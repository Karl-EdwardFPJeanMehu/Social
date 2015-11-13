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

		/**
		 * sample invalid network names
		 * @return array
		 */
		public function inputInvalidNetworks()
		{
			return [
				['tumblr','facebrooks','twit', [], " "]
			];
		}

		/**
		 * ensures invalid networks throws SocialException
		 * 
		 * @expectedException Social\SocialException
		 * @dataProvider inputInvalidNetworks 
		 */
		public function testNetworkThrowsSocialException($network)
		{
			$network = $this->social->network($network);
		}

		/**
		 * Ensure valid object is returned for valid networks
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
