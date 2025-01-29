#include<fcntl.h>
#include<stdio.h>
#include<stdlib.h>
#include<unistd.h>
#include<string.h>
#include<sys/select.h>
#include"DS.h"

float get_ds_temp(void){
	int fd;
	char *path = "/sys/bus/w1/devices/w1_bus_master1/28-3cfdf649c14f/w1_slave";
	struct timeval tv;
	char buffer[1000];
	if ((fd = open(path,O_RDONLY)) < 0){
		perror("err\n");
		exit(EXIT_FAILURE);
	}

int len=read(fd, buffer, sizeof(buffer));//
char temp[10];
strncpy(temp, buffer+len-6, 5);//destination src lentgh
// copies the 5 characters from the buffer array starting from the position len-6 into the temp array.
float tt;
tt = atof(temp)/1000;
close(fd);
sleep(1);
return tt;
}


