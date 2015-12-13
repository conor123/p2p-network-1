<?php

function listen_for_client($server_socket)
{
	echo "\n>> Listening for Client connection..." . PHP_EOL;

    $client = @stream_socket_accept($server_socket);

    if ($client) {
        
    	echo "> Receiving Message from Client:" . PHP_EOL;

    	$sock_data = fread($client, 1024);

    	//echo $sock_data . PHP_EOL;
        //echo json_decode($sock_data) . PHP_EOL;
    	echo "> Message Received. Over." . PHP_EOL;
    	//echo fwrite($client, "Hello! The time is ".date("n/j/Y g:i a")."\n");
        //echo stream_copy_to_stream($client, $client) . PHP_EOL;
    	//$pkt = stream_socket_recvfrom($client, 1, 0, $peer);
    	//echo $pkt . PHP_EOL;

        fclose($client);

        return $sock_data;
    }
}