import sqlite3
import random
import time
from datetime import datetime

# Connect to the database or create a new one if it doesn't exist
conn = sqlite3.connect('/home/pi/current_values/pressurebase.db')
c = conn.cursor()

# Generate and store pressure values every 1 second
for _ in range(15):  # Adjust the range as per your requirements
    # Generate a random pressure value between 1016 and 1011 hPa
    pressure_value = random.uniform(1011, 1016)

    # Get the current date and time
    current_date = datetime.now().strftime('%Y-%m-%d %H:%M:%S')

    # Insert the values into the database
    c.execute("INSERT INTO pressure (timestamp, pressure_value) VALUES (?, ?)",
              (current_date, pressure_value))
    
    # Commit the changes to the database
    conn.commit()

    # Wait for 1 second before generating the next value
    time.sleep(1)

# Close the connection to the database
conn.close()
