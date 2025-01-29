import RPi.GPIO as GPIO
import time
import sqlite3
import os
import glob

speriod = (1.5)
dbname = '/home/pi/current_values/waterbase.db'

# Set the GPIO mode
GPIO.setmode(GPIO.BOARD)

# Define the GPIO pin number
sensor_pin = 10

# Set the GPIO pin as an input
GPIO.setup(sensor_pin, GPIO.IN)

try:
    while True:
        # Read the water level sensor value
        water_level = GPIO.input(sensor_pin)
        conn = sqlite3.connect(dbname)
        curs = conn.cursor()
        # print (water_level)
        # time.sleep(1)

        if water_level == GPIO.HIGH:
            print("Enough")
            curs.execute("INSERT INTO watertable VALUES (datetime('now'),'1')")
            conn.commit()
            time.sleep(1)
        else:
            print("Water Shortage")
            curs.execute("INSERT INTO watertable VALUES (datetime('now'),'0')")
            conn.commit()
            time.sleep(1)
except KeyboardInterrupt:
    # Cleanup GPIO settings
    GPIO.cleanup()

