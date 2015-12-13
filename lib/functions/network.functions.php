<?php
/*
* Network Funcitons
*/
function process_client_message($client_message)
{
	global $authentication_token;

	echo "> Processing Client Message..." . PHP_EOL;

	//echo $client_message . PHP_EOL;

	$client_message = json_decode(unserialize($client_message));

	//var_dump($client_message);
	//var_dump($client_message_decoded);

	echo "> Client IP: " . $client_message->my_ip_address . PHP_EOL;

	global $network_devices_by_ip;

	global $blocked_network_devices_by_ip;

	//var_dump($blocked_network_devices_by_ip);

	//var_dump($client_message->my_ip_address);

	if (array_key_exists($client_message->my_ip_address, $blocked_network_devices_by_ip)) {

		echo "\n> WARNING: Blocked Deviced attempting to connect to network!";

	} else {

		if ($client_message->auth_token === $authentication_token) {

			unset($blocked_network_devices_by_ip[$client_message->my_ip_address]);
			
			$network_devices_by_ip[$client_message->my_ip_address] = true;

		} else {

			$blocked_network_devices_by_ip[$client_message->my_ip_address] = false;

			unset($network_devices_by_ip[$client_message->my_ip_address]);

			echo "\n> WARNING: Deviced Blocked attempting to connect to network with bad token!";

		}
		
	}

}