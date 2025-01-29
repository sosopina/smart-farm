#!/usr/bin/env python3

import sqlite3
import RPi.GPIO as GPIO
import os
import time
import glob

speriod = (1.5)
dbname = '/home/pi/current_values/tempbase.db'


f = open("/sys/bus/w1/devices/28-3cfdf649c14f/w1_slave", 'r')
lines = f.read()
tempvalue = float(lines[-6:-1]) / 1000
f.close()
print(tempvalue)

