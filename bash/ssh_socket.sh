#!/bin/bash
user= remoteuser;
server= remoteserver;
SSHSOCKET="~/.ssh/$user@$server";
# create sockdet
ssh (-p openPort) -M -f -N -o ControlPath=$SSHSOCKET $user@$server;

# The options have the following meaning:

  #  -M instructs SSH to become the master, i.e. to create a master socket that will be used by the slave connections
  #  -f makes SSH to go into the background after the authentication
  #  -N tells SSH not to execute any command or to expect an input from the user; that’s good because we want it only to manage and keep open the master connection and nothing else
#    -o ControlPath=$SSHSOCKET – this defines the name to be used for the socket that represents the master connection; the slaves will use the same value to connect via it

#Thanks to -N and -f the SSH master connection will get out of the way but will stay open and such usable by subsequent ssh/scp invocations. This is exactly what we need in a shell script. If you just do something manually than you can leave out -N and -f and use directly this connection for whatever you need while you can also open a slave connection in another terminal window. Just don’t forget that once the master connection exits slaves won’t work.

#check if socket is available
if ! [ $( ls ~/.ssh/ | grep $USERATSERVER) ]; then
	STATUSCODE=5;
fi

ssh -o ControlPath=$SSHSOCKET $user@$server 'command';

ssh -o ControlPath=$SSHSOCKET $user@$server 'ls';

# close socket
ssh -S $SSHSOCKET -O exit $user@$server;




