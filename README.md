 Social
========

Consume multiple API's from social networks easily! Essentially,
Social handles most of the confusing and hard work for you so you can begin your API calls sooner.


  Social Networks Suported
----------------------------

# Facebook's SDK v4

For now, only Facebook is being supported. Serveral API's will be supported in the future. Currently uses the Facebook\FacebookRedirectLoginHelper for sessions. 

Installation:

	 install Composer globally and use the "composer install" command

Use:

Beginning with Social is not difficult. A better understanding of the node and endpoint structures of the supported API's in question can be helpful.

1) Enter valid app id's and app secrets in the Networks\config.ini file
2) Make sure a session exists or start one
3) Create a Social object by simply typing

		$social   = Social\Social::init();

4) Specify which social network / API you want. (Only Facebook is available now).

		$facebook = $social->network('facebook');

Note: A SocialException is thron Upon failure or if the network requested is invalid.

5) 	Use the "request" method to send your API calls. A strict minimum of pre-written API calls or requests will ever be created per API. Only isSignedIn, getLoginURL and getLogoutURl methods are available for Facebook and the same as Facebook's.

		// Yay, You got a Graph API so quickly!
		$facebook->request('/me');

Simple examples:

	...

	// Facebook require sessions
	session_start();

	use Social\SocialException;

	$social   = Social\Social::init();
	
	try{
		$facebook = $social->network('facebook');
	}catch(SocialException $ex){
		// ...
	}

	// Show sign-in link if user is not signed-in
	// callback url must respect same Facebook app settings
	if (!$facebook->isSignedIn("http://yourcallbackurl.com/"))
	{
		echo "Login Facebook <a href='{$facebook->getLoginURL()}' title='Login Facebook'>here</a>.";
	}else{
		$me = $facebook->request("/me");
		
		//...
	} 

    

    // Here is how request matches up with the 
    // example shown by Facebook at 
    // https://developers.facebook.com/docs/php/howto/postwithgraphapi/4.0.0

  	try {

    $response = (new FacebookRequest(
      $session, 'POST', '/me/feed', array(
        'link' => 'www.example.com',
        'message' => 'User provided message'
    )
    ))->execute()->getGraphObject();

	// Social's version
	$post = array();
    $post['link'] => 'www.example.com';
    $post['message'] => 'User provided message';
    
	$facebook->request("/me/feed", $post);

	// or 

	$facebook->request("/me/feed", array('link' => 'www.example.com', 'message' => 'User provided message'));

That's a whole lot simpler Wasn't? Not much strain on the eyes too!