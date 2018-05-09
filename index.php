<?php
session_start();
require_once "start.php";

try{
    $route = new Route();
    $route->start();
} catch (\ErrorException $e) {
    echo $e->getMessage();
}
