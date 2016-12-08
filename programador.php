<?php

define(ARDUINO_PORT, "/dev/ttyACM0");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//$ stty -F /dev/ttyACM0 cs8 9600 ignbrk -brkint -imaxbel -opost -onlcr -isig -icanon -iexten -echo -echoe -echok -echoctl -echoke noflsh -ixon -crtscts
//sudo chmod 777 /dev/ttyACM0

$server_address = "http://www.verdor.cl/controlador";
$request_page = "/request.php";
$listener_page = "/listener.php";

$urlRequest = $server_address . $request_page;
$urlListener = $server_address . $listener_page;

$respuesta = file_get_contents($urlRequest);
$tarea = json_decode($respuesta, true);
$seguir = true;
$sleepTime = 30;
//$arduino_port = "/dev/ttyACM0";

while ($seguir){
if (isset($tarea)) {
    switch ($tarea["comando"]) {
        case "acc":
            actuador($tarea["pin"], $tarea["valor"]);
            break;
        case "med":
            sensor($tarea["pin"]);
            break;
        case "inf":
            break;
	case "exit":
	    break;		
        default:
            break;
    }
}
sleep($sleepTime);
}

function actuador($pin, $valor) {
    $orden = "acc," . $pin . "," . $valor;
    $serial = fopen(ARDUINO_PORT, "w+");
    if (!$serial) {
        echo "error";
        die();
    }
    sleep(2);
    fwrite($serial, $orden);
    sleep(2);
    fclose($serial);
}

function sensor($pin) {
    $orden = "med," . $pin . "," . "0";
    global $urlListener;
    $response = "";
    $serial = fopen(ARDUINO_PORT, "w+");
    if (!$serial) {
        echo "error";
        die();
    }
    sleep(2);
    fwrite($serial, $orden);
    sleep(2);
    while (!feof($serial)) {
        $response = fgets($serial);
        break;
    }
    //$data = json_decode($response,true);
    $url = $urlListener . "?data=" . $response;
    file_get_contents($url);
    fclose($serial);
}
