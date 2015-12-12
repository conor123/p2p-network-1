<?php
/*
* P2P N1 Test
*/

require 'lib/ip.functions.php';


/*
* Init
*/
$my_ip_address = getHostByName(getHostName());


/*
* Status Reporting
*/
echo ">>> P2P-N1 Node Reporting for duty.\n";
echo "> My IP Address is: " . $my_ip_address . PHP_EOL;

