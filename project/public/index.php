<?php

header("Access-Control-Allow-Origin: *"); // Temporary fix for CORS; but in production, must set specific URL
header('Access-Control-Allow-Methods: GET, PUT, POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require('../vendor/autoload.php');

use Pecee\SimpleRouter\SimpleRouter;

/* Load external routes file */
require_once '../routes/routes.php';

/**
 * The default namespace for route-callbacks, so we don't have to specify it each time.
 * Can be overwritten by using the namespace config option on your routes.
 */

// Start the routing
SimpleRouter::start();