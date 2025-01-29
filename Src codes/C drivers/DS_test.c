#include<stdio.h>
#include<unistd.h>
#include"DS.h"

int main(){
	
	float temp;
	
	while(1){
		temp = get_ds_temp();
		printf("Temp = %2.3fC\n", temp);
		sleep(1);
	}
	
	return 1;
}

