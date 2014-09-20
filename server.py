'''
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

This is an example server for PHP to connect to.
'''
import socket

print("Python Server.")

tcp_ip = "127.0.0.1"
tcp_port = 3193
buffer_length = 64

while 1:
    s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    s.bind((tcp_ip, tcp_port))
    s.listen(1)

    conn, addr = s.accept()
    print("Remote user connected! ", addr)
    while 1:
        try:
            data = conn.recv(buffer_length).decode("utf-8")
            if not data:
                            break
            print("Received: ", data)
            conn.send(bytes("good", "UTF-8"))
        except:
            print("Receiving error. Remote connection may have been lost.")
            break
    conn.close()
