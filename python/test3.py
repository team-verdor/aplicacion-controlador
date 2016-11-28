import serial
import time
import json

try:
    print "Trying..."
    arduino = serial.Serial('/dev/ttyACM0',9600)
    time.sleep(2)
    arduino.flush()
except:
    print "Failed to connect"

sleeptime = 0.1
speed = 0

while True:
    try:
        #open a file
        fo = open("command.txt","r+")
        speed = fo.read()
        #close opend file
        fo.close()

        arduino.write('inf')
        time.sleep(sleepTime)
    except:
        print "Failed !"
