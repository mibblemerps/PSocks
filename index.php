<!DOCTYPE html>
<!--
Copyright (C) 2014 mitchfizz05

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>PSockets</title>
    </head>
    <body>
	<?php
	    require_once 'psocks/psocks.php';
	    
	    // Create socket.
	    $sock = new psock();
	    
	    // Connect to remote host.
	    $sock->connect('localhost', 3193);
	    
	    // Set buffer size.
	    $sock->bufferSize = 64; // Only needs to be small for little text messages. Default is 512.
	    
	    // Send data.
	    $sock->send(isset($_GET['msg']) ? $_GET['msg'] : 'Hello world - this is a test.');
	    
	    // Receive data.
	    $data = $sock->receive();
	    if ($data == 'good') {
		echo 'Sent data';
	    } else {
		echo 'Server replied with malformed response';
	    }
	    
	    // Close socket.
	    $sock->close();
	?>
    </body>
</html>
