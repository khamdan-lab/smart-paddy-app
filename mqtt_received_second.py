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
   client.subscribe("smartpaddy/polindra/11011711010711911100014012")

def on_message(client, userdata, msg):
   try:
        str = msg.payload.decode()
        print('success')
        print(str)
   except :
        print("Format json error")

def main():
   cursor = conn.cursor()
   client = mqtt.Client()
   client.on_connect = on_connect
   client.on_message = on_message
   client.connect("iot.mushonnip.me", 1883,60)
   client.loop_forever()

main()
