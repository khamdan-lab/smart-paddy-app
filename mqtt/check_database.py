import psycopg2

try:
    connection = psycopg2.connect(user="postgres",
                                  password="root",
                                  host="127.0.0.1",
                                  port="5432",
                                  database="sensor")
    cursor = connection.cursor()

    print("Connect Database")

except (Exception, psycopg2.Error) as error:
    print("Not Connect", error)

finally:
    # closing database connection.
    if connection:
        cursor.close()
        connection.close()
        print("PostgreSQL connection is closed")