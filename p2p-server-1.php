<?php
/*
* server.php
*/


/*
* Init
*/

//127.0.0.1
//1337




$my_ip_address = getHostByName(getHostName());

$alt_ip_address = "192.168.75.186";

$port = 1337;

$server = stream_socket_server("tcp://$my_ip_address:$port", $errno, $errorMessage);


echo "\n>>> Reporting for duty\n\n";

echo "> My IP: " . $my_ip_address . PHP_EOL;

/*
* Code
*/
if ($server === false) {
    throw new UnexpectedValueException("Could not bind to socket: $errorMessage");
} else {

  echo "> Server is OK: " . $server . PHP_EOL;

}

for (;;) {

    echo "> Listening for Client..." . PHP_EOL;

    $client = @stream_socket_accept($server);

    if ($client) {
        
	echo "> Message Received from Client" . PHP_EOL;
        stream_copy_to_stream($client, $client);
        fclose($client);
    }
}



/*
* Finally
*/

echo "\n>>> End of Program!\n\n";
