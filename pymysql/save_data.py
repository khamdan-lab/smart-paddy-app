
import json
from matplotlib.pyplot import connect
import pymysql
json_data=open("data.json").read()
json_obj=json.loads(json_data)

conn = pymysql.connect(
   host     ="localhost",
   user     ="khamdan",
   password ="Kh@mdan1",
   db       ="json_example"
)

cursor = conn.cursor()
data = {"person": "Gilang","year": 2017,"company": "Alibaba"}
# for item in json_obj:
#    person=item.get("person")
#    year=item.get("year")
#    company = item.get("company")
#    cursor.execute("insert into json_file(person,year,company) value (%s,%s,%s)",(person,year,company))
person=data.get("person")
year=data.get("year")
company = data.get("company")
cursor.execute("insert into json_file(person,year,company) value (%s,%s,%s)",(person,year,company))
conn.commit()
conn.close




