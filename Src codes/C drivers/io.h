#ifndef IO_H_
#define IO_H_


#define PB0 "17"
#define PB1 "18"
#define PB2 "22"
#define PB3 "23"
#define PC1 "24"
#define PC2 "25"
#define PB6 "26"
#define PB7 "27"

#define LOW  0
#define HIGH 1
#define IN   1
#define OUT  0

struct S_GPIO_LINE {
    char id_number[4];
    int direction;
    int value;
};
typedef struct S_GPIO_LINE S_GPIO_LINE;

int load_gpio_line(S_GPIO_LINE *ps_line, char id_number[4], int i_direction);
int set_gpio_direction(S_GPIO_LINE *ps_line, int i_direction);
int set_gpio_line(S_GPIO_LINE *ps_line, int value);
int get_gpio_line(S_GPIO_LINE *ps_line);

#endif /*IO_H_*/

