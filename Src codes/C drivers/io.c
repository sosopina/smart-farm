#include <string.h>
#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>

#include "io.h"

/* ********************************** */
/* LOAD_GPIO_LINE                     */
/* Initialisation of a GPIO line      */
/* ********************************** */
int load_gpio_line(S_GPIO_LINE *ps_line, char id_number[4], int i_direction)
{
    FILE *p_gpio_line;

    /* Exporting GPIO line */
    if ((p_gpio_line = fopen("/sys/class/gpio/export", "w")) == NULL)
    {
        printf("Cannot open export file.\n");
        exit(1);
    }
    rewind(p_gpio_line);
    strcpy(ps_line->id_number, id_number);
    fwrite(&ps_line->id_number, sizeof(char), 2, p_gpio_line);
    fclose(p_gpio_line);

    set_gpio_direction(ps_line, i_direction);

    return 0;
}

/* ****************************************** */
/* SET_GPIO_DIRECTION                         */
/* Sets the direction (IN/OUT) of a GPIO line */
/* ****************************************** */
int set_gpio_direction(S_GPIO_LINE *ps_line, int i_direction)
{
    FILE *p_gpio_direction;
    char gpio_direction[35];

    sprintf(gpio_direction, "/sys/class/gpio/gpio%s/direction", ps_line->id_number);

    /* Setting line direction */
    if ((p_gpio_direction = fopen(gpio_direction, "w+")) == NULL)
    {
        printf("Cannot open direction file.\n");
        exit(1);
    }
    rewind(p_gpio_direction);
    if (i_direction)
    {
        fputc((int)'i', p_gpio_direction);
        fputc((int)'n', p_gpio_direction);
        ps_line->direction = 1;
    }
    else
    {
        fputc((int)'o', p_gpio_direction);
        fputc((int)'u', p_gpio_direction);
        fputc((int)'t', p_gpio_direction);
        ps_line->direction = 0;
    }

    fclose(p_gpio_direction);

    return 0;
}

/* ***************************** */
/* SET_GPIO_LINE                 */
/* Sets the value of a GPIO line */
/* ***************************** */
int set_gpio_line(S_GPIO_LINE *ps_line, int value)
{
    FILE *p_gpio_value;
    char gpio_value[35];
    char c_value[2];

    if (ps_line->direction == 0)
    {
        sprintf(gpio_value, "/sys/class/gpio/gpio%s/value", ps_line->id_number);

        /* Setting value */
        if ((p_gpio_value = fopen(gpio_value, "w")) == NULL)
        {
            printf("Cannot open value file.\n");
            exit(1);
        }
        rewind(p_gpio_value);
        sprintf(c_value, "%d", value);
        ps_line->value = value;
        fwrite(&c_value, sizeof(char), 1, p_gpio_value);
        fclose(p_gpio_value);
    }
    else
    {
        printf("Wrong access.\n");
        exit(1);
    }
    return 0;
}

/* ****************************************** */
/* GET_GPIO_LINE                              */
/* Gets value of a GPIO line                  */
/* ****************************************** */
int get_gpio_line(S_GPIO_LINE *ps_line)
{
    FILE *p_gpio_value;
    char gpio_value[35];
    int value = 0;

    if (ps_line->direction == 1)
    {
        sprintf(gpio_value, "/sys/class/gpio/gpio%s/value", ps_line->id_number);

        /* Getting value */
        if ((p_gpio_value = fopen(gpio_value, "r")) == NULL)
        {
            printf("Cannot open value file.\n");
            exit(1);
        }

        value = fgetc(p_gpio_value) - 48;

        fclose(p_gpio_value);
    }
    else
    {
        printf("Wrong access.\n");
        exit(1);
    }

    return value;
}

