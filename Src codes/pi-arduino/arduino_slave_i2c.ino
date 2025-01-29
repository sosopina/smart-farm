#include <Wire.h>

// Define I2C slave address
#define SLAVE_ADDRESS 0x08

// Define analog input pin for the moisture sensor
#define MOISTURE_PIN A0

// Initialize the I2C communication
void setup()
{
    Wire.begin(SLAVE_ADDRESS);
    Wire.onRequest(requestEvent);
}

// Read the moisture value and send it to the master
void requestEvent()
{
    int moisture = analogRead(MOISTURE_PIN);
    byte data[2];
    moisture = map(moisture, 0, 1023, 100, 0);
    data[0] = (moisture >> 8) & 0xFF;
    data[1] = moisture & 0xFF;
    Wire.write(data, 2);
}

void loop()
{
 
}
