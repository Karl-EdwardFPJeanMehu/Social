<?php

	/* Copyright (c) 2014 Karl-Edward F P Jean-Mehu
		
	* 	Permission is hereby granted, free of charge, to any person obtaining a copy
	* 	of this software and associated documentation files (the "Software"), to deal
	* 	in the Software without restriction, including without limitation the rights
	* 	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	* 	copies of the Software, and to permit persons to whom the Software is
	* 	furnished to do so, subject to the following conditions:
		
	* 	The above copyright notice and this permission notice shall be included in all
	* 	copies or substantial portions of the Software.
		
	* 	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	* 	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	* 	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	* 	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	* 	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	* 	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
	* 	SOFTWARE.
	*/

	namespace Social;

	/**
	 * Class Social
	 *
	 * @package  Social
	 * @author Karl-Edward F P Jean-Mehu <karlej99@yahoo.com>
	 */
	class Social {
		// make this a singleton
		use tSingleton;
		// private static $instance = null;

		// private function __construct(){}

		// // singleton constructor
		// public static function init(){
		// 	if(is_null(self::$instance)){
		// 		self::$instance = new social();
		// 	}

		// 	return self::$instance;
		// }

		/**
		 * class network
		 *
		 * creates instance of requested network API 
		 * @param  string $requestedNetwork name of supported network
		 * @return object 					instance of requested network
		 */
		public function network($requestedNetwork){

			if(is_string($requestedNetwork)){

				// prepend required prefix and capitalize
				// class name
				$requestedNetwork = 'Soc'. strtoupper(substr($requestedNetwork, 0, 1)) . substr($requestedNetwork, 1);

				// set directory for networks
				$file = __DIR__ .'/Networks/'. $requestedNetwork .'.php';
				$file = str_replace('\\', DIRECTORY_SEPARATOR, $file);

				// if file exists create and return an object instance
				// for requested network
				try{
					if (file_exists($file)){
						$requestedNetwork_class = 'Social\\Networks\\'. $requestedNetwork;

						return new $requestedNetwork_class();
					}else{
						throw new SocialException('Invalid Social network requested');
					} 
				}catch(SocialException $ex){
					echo $ex->getMessage();
				}
			}
		}
	}
	
?>