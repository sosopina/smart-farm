#!/usr/bin/env python3
import smbus2
import time

# Define I2C slave address of the Arduino Uno
address = 0x08

# Initialize I2C bus
bus = smbus2.SMBus(1)

# Request data from the Arduino Uno
data = bus.read_i2c_block_data(address, 0, 2)
    
# Combine the two bytes to form a single integer value
value = (data[0] << 8) | data[1]
    
# Print the moisture value in the file
file = open("/home/pi/current_values/yl_69.txt","w") 

file.truncate(0)
file.write(str(value)+"\n")
# close file
file.close()

