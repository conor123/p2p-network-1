<?php

// Function to get the client IP address
function get_client_ip() 
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function get_my_ip()
{
	if(isset($_SERVER["SERVER_ADDR"])){
		// Web
		echo "> Web Server Detected" . PHP_EOL;
        return $_SERVER["SERVER_ADDR"];

    } else {
	    // Running CLI
	    if(stristr(PHP_OS, 'WIN')) {

	    	//echo "> Windows OS Detected" . PHP_EOL;
	        //  Rather hacky way to handle windows servers
	        exec('ipconfig', $catch);

	        //+echo "> IP Config Content: " . implode($catch) . PHP_EOL;

	        //var_dump($catch);

	        foreach($catch as $line) {

				//echo "> IP Config line: " . $line . PHP_EOL;

		        if(eregi('IPv4 Address', $line)) {

		        	//echo "> IPv4 Address line: " . $line . PHP_EOL;
		        	
		            // Have seen exec return "multi-line" content, so another hack.
		            if(count($lineCount = split(':', $line)) == 1) {

			            list($t, $ip) = split(':', $line);
			            $ip = trim($ip);

		            } else {

			            $parts = explode('IPv4 Address', $line);
			            $parts = explode('Subnet Mask', $parts[1]);
			            $parts = explode(': ', $parts[0]);
			            $ip = trim($parts[1]);

			            //echo '> IP is '.$ip."\n";

			            return $ip;
		            }

		            if(ip2long($ip > 0)) {

			            echo 'My IP is '.$ip."\n";

			            return $ip;

		            } else {

		            	echo "> ERROR! IP Not analysed Correctly" . PHP_EOL;

		            	//; // TODO: Handle this failure condition.
		            }
		            
		        } else {

		        	//echo "> ERROR! No Match!" . PHP_EOL;

		        	//return false;

		        }
	        }

	        echo "> End of IP Data!" . PHP_EOL;

	    } else {
	    	echo "> Linux OS Detected" . PHP_EOL;
	        $ifconfig = shell_exec('/sbin/ifconfig eth0');
	          preg_match('/addr:([\d\.]+)/', $ifconfig, $match);
	        return $match[1];
	    }
    }
}