class pin():

    def __init__(self, pin):
        self.pin = pin


    def get_pin(self):
        return self.pin

    def set_pin(self, pin):
        self.pin = pin
        return True
