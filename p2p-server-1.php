<?php
/*
* server.php
*/
require "lib/functions/ip.functions.php";

/*
* Init
*/
echo "\n>>> P2P Server 1 Reporting for duty\n\n";

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

$peer = "192.168.75.187";



/*
* SAve my network data
*/
$my_network_data = array(
    'my_ip_address'=> $my_ip_address, 
    'port'=> $port);


$fp = fopen('network/my-data.json', 'w');
fwrite($fp, json_encode($my_network_data));
fclose($fp);

$my_message = "";

$my_message = serialize(json_encode($my_network_data));

/*
* Code
*/
if ($server === false) {
    throw new UnexpectedValueException("Could not bind to socket: $errorMessage");
} else {

  echo "> Server is OK: " . $server . PHP_EOL;

}

$counter_1 = 0;

for (;;) {

    if($counter_1 === 0){

        echo "> Counter is 0: " . PHP_EOL;
        $counter_1++;

        $sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        echo "> Connecting to socket: " . PHP_EOL;
        $sockconnect = socket_connect($sock, $peer, $port);

        $msg = '<test>Xml data</test>';

        echo "> Writing to socket: " . PHP_EOL;
        socket_write($sock, $msg, strlen($msg));
        socket_close($sock);

        //exec("curl --data $my_message 192.168.75.187:1337");

        continue;

    } 

    

    echo "> Listening for Client connection..." . PHP_EOL;

    $client = @stream_socket_accept($server);

    if ($client) {
        
    	echo "> Message Received from Client" . PHP_EOL;
    	$sock_data = fread($client, 1024);
    	echo $sock_data . PHP_EOL;
        //echo json_decode($sock_data) . PHP_EOL;
    	echo "> Message Received. Over." . PHP_EOL;
    	//echo fwrite($client, "Hello! The time is ".date("n/j/Y g:i a")."\n");
            //echo stream_copy_to_stream($client, $client) . PHP_EOL;
    	//$pkt = stream_socket_recvfrom($client, 1, 0, $peer);
    	//echo $pkt . PHP_EOL;

        fclose($client);
    }

    



    echo "> Sending message to peer $peer" . PHP_EOL;

    //exec('curl --data "Hi from Win 8" $peer:1337');

    exec("curl --data $my_message 192.168.75.187:1337");
}



/*
* Finally
*/

echo "\n>>> End of Program!\n\n";
