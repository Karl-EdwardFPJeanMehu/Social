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

		/**
		 * class network
		 *
		 * creates instance of requested network API 
		 * @param  string $req_networkName name of supported network
		 * @return object 					instance of requested network
		 * @throws SocialException If requested network invalid
		 */
		public function network($req_networkName){

				// throw exception if param not string
				if (! is_string($req_networkName) || empty($req_networkName)){
					throw new SocialException("Invalid network requested.");
				}

				// prepend required prefix and capitalize
				// class name
				$req_networkName = ucfirst($req_networkName);

				$requestedNetwork = 'Soc'. $req_networkName;

				// set directory for networks
				$file = __DIR__ .'/Networks/Soc'. $req_networkName .'.php';
				$file = str_replace('\\', DIRECTORY_SEPARATOR, $file);

				// throw exception if file not exists 
				if (! file_exists($file))
				{
					throw new SocialNetworkException('Unsupported network requested.');
				} 

				// create iSocialNetwork object instance
				$req_networkClass = 'Social\\Networks\\Soc'. $req_networkName;

				// get required configurations
				$config = SocialConfig::getConfig($req_networkName);

				// return instance
				return new $req_networkClass($config);
		}
	}
	
?>