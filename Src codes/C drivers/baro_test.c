#include<stdio.h>
#include<unistd.h>
#include"baro.h"

int main(){
	float pression;

		pression = get_pression();
		printf("%4.3f\n", pression);
		sleep(1);

	return 1;
}
