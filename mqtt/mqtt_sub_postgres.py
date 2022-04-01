from multiprocessing.connection import Client
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
      # print(msg.payload.decode())
      data = json.loads(msg.payload.decode())
    #   print(data)
      cursor = conn.cursor()
      temperature=data.get("temperature")
      humidity=data.get("humidity")
      soil_moisture=data.get("soil_moisture")
      soil_ph=data.get("soil_ph")
      light_intensity=data.get("light_intensity")
      wind_speed=data.get("wind_speed")
      wind_direction=data.get("wind_direction")
      cursor.execute("insert into data_sensors(temperature,humidity,soil_moisture,ph,light_intensity,wind_speed,wind_direction) values (%s,%s,%s,%s,%s,%s,%s)",(temperature,humidity,soil_moisture,soil_ph,light_intensity,wind_speed,wind_direction))
      conn.commit()
      conn.close
      print('success')
   except ValueError:
      print('error' + ValueError)

cursor = conn.cursor()
client = mqtt.Client()
client.on_connect = on_connect
client.on_message = on_message
client.connect("test.mosquitto.org", 1883,60)      
client.loop_forever()


