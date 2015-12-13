<?php
function initial_info($my_ip_address, $port)
{
	echo "\n>>> Network Manager " . VERSION . "\n\n>>> REPORTING FOR DUTY\n\n";
	//echo "> My IP: " . $my_ip_address . PHP_EOL;
	echo "> My Stream Socket IP: " . $my_ip_address . PHP_EOL;

	echo "> My Stream Socket Port: " . $port . PHP_EOL;
}

function final_info()
{
	echo "> Exiting Program." . PHP_EOL;
}

function print_message($string)
{
	if (is_string($string)) {

		echo "> Message:" . PHP_EOL;

		echo $string . PHP_EOL;

	} else {

		echo "> ERROR: Not a string!" . PHP_EOL;

		return false;

	}

}

function display_network_devices()
{
	global $network_devices_by_ip;

	global $blocked_network_devices_by_ip;

	echo "\n>> Registered Network Devices" .  PHP_EOL;

	foreach ($network_devices_by_ip as $ip => $connected) {

		$status = $connected ? "True": "False";
		
		echo "> Network Device " . $ip . " is registered. Connetion status: " . $status . PHP_EOL;
	}

	echo "\n>> Blocked Network Devices" .  PHP_EOL;

	foreach ($blocked_network_devices_by_ip as $ip => $connected) {

		$status = $connected ? "True": "False";
		
		echo "> Network Device " . $ip . " is blocked. Connetion status: " . $status . PHP_EOL;
	}
}