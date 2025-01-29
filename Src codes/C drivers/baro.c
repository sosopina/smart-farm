#include<fcntl.h>
#include<stdio.h>
#include<stdlib.h>
#include<unistd.h>
#include<string.h>
#include<sys/select.h>
#include"baro.h"

float get_pression(void){
	int fd;
	char *path = "/home/pi/current_values/baro.txt";
	char buffer[500];
	if ((fd = open(path,O_RDONLY)) < 0){
		perror("err\n");
		exit(EXIT_FAILURE);
	}

int len=read(fd, buffer, sizeof(buffer));//
char temp[10];
strncpy(temp, buffer, 5);//destination src lentgh

float tt;
tt = atof(temp);
close(fd);
sleep(1);
return tt;
}
