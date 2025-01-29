#!/usr/bin/env python3

import sqlite3
import RPi.GPIO as GPIO
import os
import time
import glob

speriod = (1.5)
dbname = '/home/pi/current_values/tempbase.db'

def get_temp():
  f = open("/sys/bus/w1/devices/28-3cfdf649c14f/w1_slave", 'r')
  lines = f.read()
  tempvalue = float(lines[-6:-1]) / 1000
  f.close()
  return tempvalue


def log_temperature(temp):
  conn = sqlite3.connect(dbname)
  curs = conn.cursor()
  curs.execute("INSERT INTO temps values(datetime('now'), (?))", (temp,))
  conn.commit()
  conn.close()


def display_data():
  conn = sqlite3.connect(dbname)
  curs = conn.cursor()

  for row in curs.execute("SELECT * FROM temps"):
    print(str(row[0])+" | "+str(row[1]))

  conn.close()


def main():
  GPIO.setmode(GPIO.BCM)
  GPIO.setup(4, GPIO.IN)
  while True:
    temperature = get_temp()
    if temperature != None:
      print(str(temperature))
    else:

      temperature = get_temp()
      print("temperature="+str(temperature))
    log_temperature(temperature)
    display_data()
    time.sleep(speriod)

if __name__ == '__main__':
  main()

