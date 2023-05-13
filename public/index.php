<?php
ob_start();
session_start();

use App\Core\Router;

require_once("../vendor/autoload.php");

(new Router());


ob_end_flush();
