<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';
require './config/db.php';

//authenticator


// routes
require './routes/product.php';
require './routes/login.php';


// run app
$app->run();

 ?>
