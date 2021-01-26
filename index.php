<?php
// this is the CONTROLLER

// turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// require autoload file
require_once ('vendor/autoload.php');

// create an instance of the base class (fat-free framework)
$f3 = Base::instance();

// define a default route (home page)
$f3->route('GET /', function() {
	// create a new view, then sends it to the client
	$view = new Template();
	echo $view->render('views/home.html');
});

// define a default route (home page) again that takes 2 parameters for some reason?
$f3->route('GET /@first/$last', function($f3, $params) {
	echo 'Hello, '.$params['first'].' '.$params['last'];
});

// define a breakfast route
$f3->route('GET /breakfast', function() {
	// create a new view and send it to the client
	$view = new Template();
	echo $view->render('views/breakfast.html');
});

// define a breakfast route with a custom item???
$f3->route('GET /breakfast/@item', function($f3, $params) {
	// create a new view and send it to the client
	echo '<pre>';
	var_dump($params);
	echo '</pre>';

	$menu = array('eggs', 'waffles', 'pancakes');
	$item = $params['item'];

	if (in_array($item, $menu)) {
		switch ($item) {
			case 'eggs':
				$view = new Template();
				echo $view->render('views/eggs.html');
				break;
			case 'waffles':
				echo "Swedish or American?";
				break;
			case 'pancakes':
				$f3->reroute('https://www.thewafflehouse.com');
				break;
			default:
				$f3->error(404);
		}
		echo "Yes, we serve $item.";
	} else {
		echo "Sorry, we don't serve $item.";
	}

	//$view = new Template();
	//echo $view->render('views/breakfast.html');
});

// define a lunch route
$f3->route('GET /lunch', function() {
	// create a new view and send it to the client
	$view = new Template();
	echo $view->render('views/lunch.html');
});

// define a lunch/sandwich route
$f3->route('GET /lunch/sandwich', function() {
	// create a new view and send it to the client
	$view = new Template();
	echo $view->render('views/sandwich.html');
});

// run fat free HAS TO BE THE LAST THING IN FILE
$f3->run();
