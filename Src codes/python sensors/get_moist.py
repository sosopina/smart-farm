#!/usr/bin/env python3

import sqlite3
import RPi.GPIO as GPIO
import os
import time
import glob

speriod = (1.5)
dbname = '/home/pi/current_values/moistbase.db'

def get_moist():
  f = open("/home/pi/current_values/yl_69.txt", 'r')
  moistvalue=f.read()
  f.close()
  return float(moistvalue)


def log_moist(moist):
  conn = sqlite3.connect(dbname)
  curs = conn.cursor()
  curs.execute("INSERT INTO moistt values(datetime('now'), (?))", (moist,))
  conn.commit()
  conn.close()


def display_data():
  conn = sqlite3.connect(dbname)
  curs = conn.cursor()

  for row in curs.execute("SELECT * FROM moistt"):
    print(str(row[0])+" | "+str(row[1]))

  conn.close()


def main():
  while True:
    moist = get_moist()
    if moist != None:
      print("moist="+str(moist))
    else:

      temperature = get_temp()
      print("moist="+str(moist))
    log_moist(moist)
    display_data()
    time.sleep(speriod)

if __name__ == '__main__':
  main()

