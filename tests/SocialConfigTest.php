<?php

	class SocialConfigTest extends PHPUnit_Framework_TestCase{
		protected $_config;

		public function setup()
		{
			$this->_config = Social\SocialConfig::init();
		}

		public function testIstSingletonInstance()
		{
			$traits_used = class_uses($this->_config);
			$this->assertTrue(in_array('Social\tSingleton', $traits_used));
		}

		public function ConfigArrayProvider()
		{
			return array(array('Facebook'), array('Twitter'));
		}

		/**
		 * @dataProvider ConfigArrayProvider
		 */
		public function testConfigIsArray($configIndex)
		{
			$config = $this->_config->getConfig($configIndex);
			$this->assertTrue(is_array($config));
		}

		public function badConfigArrayProvider()
		{
			return array(array(58), array(5050));
		}

		/**
		 * @dataProvider BadConfigArrayProvider
		 * @expectedException Social\SocialConfigException
		 */
		public function testBadConfigIsArray($configIndex)
		{
			$config = $this->_config->getConfig($configIndex);
			$this->assertTrue(is_array($config));
		}
	}

?>
