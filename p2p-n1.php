<?php
/*
* P2P N1 Test
*/

require 'lib/functions/ip.functions.php';


/*
* Init
*/
//$my_ip_address = getHostByName(getHostName());// On VM this gets localhost, otherwise gets network address
$my_ip_address = get_my_ip();

//$to_ip_address = "127.0.1.1";

$my_network = array();

$my_network[0] = "192.168.75.1"; // Me
$my_network[1] = "192.168.75.186"; // Ubuntu64


//$to_ip_address = $my_network[1];
$to_ip_address = $my_ip_address;
/*
* Coding
*/

$client = stream_socket_client("tcp://$to_ip_address:80", $errno, $errorMessage);

if ($client === false) {
    throw new UnexpectedValueException("Failed to connect: $errorMessage");
}

fwrite($client, "GET / HTTP/1.0\r\nHost: $to_ip_address\r\nAccept: */*\r\n\r\n");



/*
* Status Reporting
*/
echo "\n>>> P2P-N1 Node Reporting for duty.\n\n";
echo "> My IP Address is: " . $my_ip_address . PHP_EOL;

echo stream_get_contents($client);

/*
* Finally
*/
fclose($client);