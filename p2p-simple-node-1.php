<?php
/*
* Simple Node 1
*/
require "lib/functions/ip.functions.php";


/*
* Init & Setup
*/
$seed_nodes = array();

$peer = $seed_nodes[0] = "192.168.1.103";

$port = 1337;

$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

$my_ip_address = get_my_ip();

$authentication_token = "Password1s";

$my_socket_data = array(
  'my_ip_address'=> $my_ip_address, 
  'port'=> $port,
  'auth_token' => $authentication_token
);

$my_socket_data_as_serialized_json = serialize(json_encode($my_socket_data));

/*
* Program
*/

echo "> Connecting to socket... " . PHP_EOL;

if($sockconnect = socket_connect($sock, $peer, $port)){

  echo "> Connected to socket OK" . PHP_EOL;

} else {

  echo "> Error Connecting to socket!" . PHP_EOL;

  exit(0);
}

//$msg = '<test>Xml data</test>';

$msg = $my_socket_data_as_serialized_json;

echo "> Writing to socket: " . PHP_EOL;

socket_write($sock, $msg, strlen($msg));

socket_close($sock);

/*
* finally
*/
echo "> Program terminating!" . PHP_EOL;

exit(0);
