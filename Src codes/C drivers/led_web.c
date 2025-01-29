#include<stdio.h>
#include<stdlib.h>
#include<string.h>
#include<unistd.h>

#include<time.h>

#include "io.h"

int main(int argc, char* argv[]){
	S_GPIO_LINE s_line7, s_line8, s_line9, s_line10, s_line11;
	int sw = 1;
	
	if(argc!=3){
		printf("usage: \n");
		printf("\t web_led <led> <on/off>\n");
		printf("<led> : number betwen 0-3\n");
		printf("<on/off> : 1=on, 0=off\n");
		return 1;
	}
	
	int led=atoi(argv[1]);
	int onoff=atoi(argv[2]);
	
	switch(led){
		case 0: load_gpio_line(&s_line8, PB0, OUT);
			s_line7 = s_line8;
			break;
		
		case 1: load_gpio_line(&s_line9, PB1, OUT);
			s_line7 = s_line9;
			break;
		
		case 2: load_gpio_line(&s_line10, PB2, OUT);
			s_line7 = s_line10;
			break;
		
		case 3: load_gpio_line(&s_line11, PB3, OUT);
			s_line7 = s_line11;
			break;
		
		default:
			printf("<led> betwen 0 and 3\n");
			return 1;
	}
	
	switch(onoff){
		case 0: set_gpio_line(&s_line7, !sw);
			break;
		
		case 1: set_gpio_line(&s_line7, sw);
			break;
		
		default:
			printf("<on/off> : 1=on, 0=off\n");
			return 1;
	}
}
