from types import DynamicClassAttribute
from flask_sqlalchemy import SQLAlchemy
app.config["SQLALCHEMY_DATABASE_URI"] = 'sqlite:///mazedriver.db'
db = SQLAlchemy(app)
import string
import random
class Pin_Control:

    def GetPin(self):
        return pin_table.query.all()

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
