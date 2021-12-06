from MazeDriver.database import db, pin_table
from MazeDriver.entity.pin import *
import string
import random

class Pin_Control:

    def GetPin(self):
        query = pin_table.query.all()
        if query:
            return query
        else:
            return None

    def GeneratePin(self):
        if pin_table.query.all():
            pin_table.query.delete()
            print("pin deleted")

        pin = ''.join(random.choice(string.digits) for x in range(8))
        query = pin_table(pin=pin)
        db.session.add(query)
        db.session.commit()

    def comparePin(self, pin):
        query = pin_table.query.all()
        if pin == query[0].pin:
            return True
        return False
