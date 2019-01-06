/**
* Compile as follows with the permissions of the specified user id:
* cc path/to/this/file.c -o destination/path
* chmod +s destination/path
*/

#include <stdio.h>
#include <stdlib.h>
#include <sys/types.h>
#include <unistd.h>

int main() {
	
	// adjust the id to your needs
	int id = 996;
	setresuid(id, id, id);
	setresgid(id, id, id);
	system("/bin/bash");
	return 0;
}
