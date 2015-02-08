<?php

	require_once '../vendor/autoload.php';

	class SocialConfigTest extends PHPUnit_Framework_TestCase{
		protected $config;

		public function setup()
		{
			$this->config = Social\SocialConfig::init();
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
			$config = $this->config->getConfig($configIndex);
			$this->assertTrue(is_array($config));
		}

		public function badConfigsArrayProvider()
		{
			return array(array(58), array(5050));
		}

		/**
		 * @expectedException Social\SocialConfigException
		 * @dataProvider badConfigsArrayProvider
		 */
		public function testConfigThrowsSocialConfigException($configIndex)
		{
			$config = $this->config->getConfig($configIndex);
		}

		
	}

?>