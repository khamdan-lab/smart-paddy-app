from multiprocessing.connection import Client
from datetime import datetime
import paho.mqtt.client as mqtt
from matplotlib.pyplot import connect
import psycopg2
import json
import os
from dotenv import load_dotenv
load_dotenv()

MQTT_USERNAME = os.getenv("MQTT_USERNAME")
MQTT_PASSWORD = os.getenv("MQTT_PASSWORD")

conn = psycopg2.connect(user="postgres",
                            password="root",
                            host="127.0.0.1",
                            port="5432",
                            database="sensor")

def on_connect(client, userdata, flags, rc):
   print("connected to mqtt"+str(rc))
   client.subscribe("smartpaddy/polindra/11011711010711911100014012")

def on_message(client, userdata, msg):
   try:
        data_str = msg.payload.decode()
        data = data_str.split(',')
        data_byte = len(data_str.encode("utf-8"))

        timestamp = datetime.now()
        cursor = conn.cursor()
        device_id=data[0]
        temperature=data[1]
        humidity=data[2]
        soil_moisture=data[3]
        soil_ph=data[4]
        water_ph=data[5]
        light_intensity=data[6]
        wind_speed=data[7]
        rainfall =data[8]
        latitude =data[9]
        longitude =data[10]
        cursor.execute("insert into data_sensors(device_id,temperature,humidity,soil_moisture,ph,ph_water,light_intensity,wind_speed,rainfall,latitude,longitude,created_at) values (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",(device_id,temperature,humidity,soil_moisture,soil_ph,water_ph,light_intensity,wind_speed,rainfall,latitude,longitude,timestamp))
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
   client.username_pw_set(MQTT_USERNAME, password=MQTT_PASSWORD)
   client.on_connect = on_connect
   client.on_message = on_message
   client.connect("iot.mushonnip.me", 1883,60)
   client.loop_forever()

main()
