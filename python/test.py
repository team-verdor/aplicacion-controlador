#!/usr/bin/python
import time
import serial

arduinoPort = serial.Serial('/dev/ttyACM0',9600,timeout=1)
time.sleep(2)
arduinoPort.write('inf')
getSerialValue = arduinoPort.readline()
print '\nRetorno: %s' % (getSerialValue)
arduinoPort.close()
