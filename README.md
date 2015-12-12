# p2p-network-1
# run server as 
php p2p-server-1.php
# Commuicat from another client terminal on localhost
echo "Hello World" | nc 127.0.1.1 1337
# If we use the external ip address we need to set it accordingly so we can commuicate from other machines on the network
# We can curl from another (windows) machine with data
curl --data "Hi!" 192.168.75.186:1337
# Make a Telnet connection
o 192.168.75.186 1337
# Hit a letter - it will send but the connection will then terminate
