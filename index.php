<?php
// 328/quiz/index.php
// this file holds the controller for Fat-Free

// turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// require the autoload file
require_once('vendor/autoload.php');

// instantiate the F3 framework Base class
$f3 = Base::instance();

// define a default route
$f3->route('GET /', function ($f3) {
    // add a views for the page
    // first create a template
    $view = new Template();
    //direct views to that template
    echo $view->render('views/home.html');

});

// define the survey page route, GET|POST accepted
$f3->route('GET|POST /survey', function ($f3){
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $fruits = $_POST['fruits'];
        $name = $_POST['name'];

        // set the data to the session
        $f3->set('SESSION.fruits', $fruits);
        $f3->set('SESSION.name', $name);

        // send the user to summary
        $f3->reroute('/summary');
    }

    // create fruit array
    $fruits = array('apple', 'orange', 'banana', 'watermelon');
    $f3->set('fruits', $fruits);

    $view = new Template();
    // render the specific file we want
    echo $view->render('views/survey.html');
});

// set up the summary page
$f3->route('GET /summary', function ($f3) {
    // add a views for the page
    // first create a template
    $view = new Template();
    //direct views to that template
    echo $view->render('views/summary.html');

});

// Run fat-free
$f3->run();

?>