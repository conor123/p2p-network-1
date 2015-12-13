<?php
/*
* server.php
*/
require "lib/ip.functions.php";

/*
* Init
*/
echo "\n>>> P2P Server 1 Reporting for duty\n\n";
//127.0.0.1
//1337




//$my_ip_address = getHostByName(getHostName());// Not relianble for networking - gives VM Ethernet adapter, we need Wireless Lan adapter
$my_ip_address = get_my_ip();

//echo "> IP Easy: " . gethostbyname(php_uname('n'));
//$alt_ip_address = "192.168.75.186";//Ubuntu
//$alt_ip_address = "192.168.1.103";// Win
//$alt_ip_address = $my_ip_address;

$port = 1337;
// Socket resource
$server = stream_socket_server("tcp://$my_ip_address:$port", $errno, $errorMessage);




//echo "> My IP: " . $my_ip_address . PHP_EOL;
echo "> My Stream Socket IP: " . $my_ip_address . PHP_EOL;
echo "> My Stream Socket Port: " . $port . PHP_EOL;

/*
* Code
*/
if ($server === false) {
    throw new UnexpectedValueException("Could not bind to socket: $errorMessage");
} else {

  echo "> Server is OK: " . $server . PHP_EOL;

}

for (;;) {

    echo "> Listening for Client connection..." . PHP_EOL;

    $client = @stream_socket_accept($server);

    if ($client) {
        
	echo "> Message Received from Client" . PHP_EOL;
	$sock_data = fread($client, 1024);
	echo $sock_data . PHP_EOL;
	echo "> Message Complete" . PHP_EOL;
	//echo fwrite($client, "Hello! The time is ".date("n/j/Y g:i a")."\n");
        //echo stream_copy_to_stream($client, $client) . PHP_EOL;
	//$pkt = stream_socket_recvfrom($client, 1, 0, $peer);
	//echo $pkt . PHP_EOL;

        fclose($client);
    }
}



/*
* Finally
*/

echo "\n>>> End of Program!\n\n";
