<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);


$server_address="http://192.168.1.85/aplicacion-web-v2";
$request_page = "/request.php";

$url=$server_address.$request_page;

$response = file_get_contents($url);

echo "data:";
echo $response;
echo "<br>";
//var_dump($response);
$object = json_decode($response, true);


