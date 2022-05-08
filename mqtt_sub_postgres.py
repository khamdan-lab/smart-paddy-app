from multiprocessing.connection import Client
from datetime import datetime
import paho.mqtt.client as mqtt
from matplotlib.pyplot import connect
import psycopg2 
import json

conn = psycopg2.connect(user="postgres",
                            password="root",
                            host="127.0.0.1",
                            port="5432",
                            database="sensor")

def on_connect(client, userdata, flags, rc):
   print("connecting mqtt"+str(rc))
   client.subscribe("esp32/temphum")


def on_message(client, userdata, msg):
   try:
      data = json.loads(msg.payload.decode())
      dt = datetime.now()
      print("Date and time is:", dt)
      print(data)
      # cursor = conn.cursor()
      # device_id=data.get("device_id")
      # temperature=data.get("temperature")
      # humidity=data.get("humidity")
      # soil_moisture=data.get("soil_moisture")
      # soil_ph=data.get("soil_ph")
      # light_intensity=data.get("light_intensity")
      # wind_speed=data.get("wind_speed")
      # wind_direction=data.get("wind_direction")
      # cursor.execute("insert into data_sensors(device_id,temperature,humidity,soil_moisture,ph,light_intensity,wind_speed,wind_direction) values (%s,%s,%s,%s,%s,%s,%s,%s)",(device_id,temperature,humidity,soil_moisture,soil_ph,light_intensity,wind_speed,wind_direction))
      # conn.commit()
      # conn.close
      # print('success')
      # print(data)
   except :
      print('Data error')

def main():
   cursor = conn.cursor()
   client = mqtt.Client()
   client.on_connect = on_connect
   client.on_message = on_message
   client.connect("test.mosquitto.org", 1883,60)      
   client.loop_forever()
   
main()
