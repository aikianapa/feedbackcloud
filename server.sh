#!/bin/bash

flag="0";
for line in $(ps -A -f | grep server.php) 
do 
	if  [ "$line" = "./server.php" ]
		then flag="1";
	fi
done
if [ "$flag" = "0" ]
	then 
		echo "Starting server";
		cd /var/www/html
		nohup php ./server.php >> /var/log/chatserver.log 2>&1 &
	else 
		echo "Server already started!";
fi
