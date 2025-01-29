#!/usr/bin/env python3

import sqlite3
import RPi.GPIO as GPIO
import os
import time
import glob

speriod = (1.5)
dbname = '/home/pi/current_values/moistbase.db'

f = open("/home/pi/current_values/yl_69.txt", 'r')
moistvalue=f.read()
f.close()
print(float(moistvalue))

