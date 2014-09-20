<?php

/*
 * Copyright (C) 2014 mitchfizz05
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * A PHP client socket object.
 *
 * @author mitchfizz05
 */
class psock {
    // Depends on the size of data being sent. Higher buffer value for more data.
    public $bufferSize = 512;
    
    // The raw PHP socket object.
    public $socketObj;
    
    /**
     * Create a new socket object.
     */
    public function __construct() {
	$this->socketObj = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    }
    
    /**
     * Connects to the remote host.
     * @param string $host The remote hosts IP or hostname.
     * @param int $port The port to connect to.
     * @return boolean Connection success?
     */
    public function connect($host, $port) {
	// Resolve host to IP, if it isn't already an IP.
	$host = gethostbyname($host);
	
	// Check that port is valid.
	if ($port > 65535 or $port < 1) {
	    // Port out of range.
	    return false;
	}
	
	// Connect to the remote host.
	$result = socket_connect($this->socketObj, $host, $port);
	if ($result === false) {
	    // Failed to connect.
	    return false;
	} else {
	    // Connected.
	    return true;
	}
	
    }
    
    /**
     * Sends data through a socket.
     * Remember to connect the socket first.
     * Throws error on failure.
     * @param string $data The data to be sent over the socket.
     * @return boolean Data sent?
     */
    public function send($data) {
	// Write data to socket stream.
	$result = socket_write($this->socketObj, $data, strlen($data));
	
	if ($result === false) {
	    // Failed to send data.
	    return false;
	} else {
	    // Sent.
	    return true;
	}
    }
    
    /**
     * Receive data from the socket.
     * This will block the PHP script until complete.
     * @return object Returns data received, false if failed, or a blank string if reached end of stream.
     */
    public function receive() {
	$data = socket_read($this->socketObj, $this->bufferSize);
	
	if ($data === false) {
	    // Failed to receive data. Return false.
	    return false;
	} else {
	    // Return data.
	    return $data;
	}
    }
    
    /**
     * Close the socket.
     * Once closed it can no longer be used.
     */
    public function close() {
	socket_close($this->socketObj);
    }
}

// The PSocks version.
define('PSOCKS_VERSION', 1.0);
