<?php
/*
* Functions:
* > Accepts Requests to Join Network
* > Manages a list of devices on network by ip address
*/

/*
* Set up & Init
*/
require "lib/functions/ip.functions.php";
require "lib/functions/socket.functions.php";
require "lib/functions/print.functions.php";

define("VERSION", "V0.1.0");

$server_on = true;

$exit_level = 0;

$my_ip_address = get_my_ip();

$port = 1337;
// Socket resource
$server_socket = stream_socket_server("tcp://$my_ip_address:$port", $errno, $errorMessage);

$client_message = "";

/*
* Program
*/
initial_info($my_ip_address, $port);



while($server_on){

	$client_message = listen_for_client($server_socket);

	print_message($client_message);
	
}

/*
* Finally
*/

final_info();

exit($exit_level);