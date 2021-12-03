from application import db
import string
import random


class pin_table(db.Model):
    Id = db.Column(db.Integer(), primary_key=True)
    pin = db.Column(db.String(length=50), nullable=False, unique=True)


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
    

    def testCase1():
        Id = pin_table.Id
        pin = pin_table.pin
        x = Pin_Control.GetPin(self=pin_table.Id)
        print("\nTest Case 1: Get all pins from Pin Class and pin_table database\n")
        assert x, "ID Object 1"
        print(x)

    def testCase2():
        try:
            print("\nTest Case 2: Generate New Pin to insert into pin_table database\n")
            assert Pin_Control.GeneratePin(self=1), "New Pin inserted"
            print(Pin_Control.GetPin(self=1))
        except AssertionError as error:
            print(error)
    def testCase3():
        try:
            fakepin = 11212
            assert Pin_Control.comparePin(fakepin,pin=pin_table.pin)
        except AssertionError as error:
            print(error)



Pin_Control.testCase1()
Pin_Control.testCase2()
Pin_Control.testCase3()