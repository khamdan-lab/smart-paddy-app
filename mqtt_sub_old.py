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
        timestamp = datetime.now()
        cursor = conn.cursor()
        device_id=data.get("id")
        latitude =data.get("lat")
        longitude =data.get("on")
        temperature=data.get("temp")
        humidity=data.get("humd")
        soil_moisture=data.get("som")
        soil_ph=data.get("sph")
        light_intensity=data.get("light")
        wind_speed=data.get("ws")
        cursor.execute("insert into data_sensors(device_id,temperature,humidity,soil_moisture,ph,light_intensity,wind_speed,latitude,longitude,created_at) values (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",(device_id,temperature,humidity,soil_moisture,soil_ph,light_intensity,wind_speed,latitude,longitude,timestamp))
        conn.commit()
        conn.close
        print('success')
        print("Date and time is:", timestamp)
        print(data)
   except :
        print("Format json error")

def main():
   cursor = conn.cursor()
   client = mqtt.Client()
   client.on_connect = on_connect
   client.on_message = on_message
   client.connect("test.mosquitto.org", 1883,60)
   client.loop_forever()

main()
