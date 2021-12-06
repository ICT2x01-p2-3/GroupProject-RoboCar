class score():

    def __init__(self, name, score):
        self.name = name
        self.score = score


    def get_name(self):
        return self.name

    def get_score(self):
        return self.score

    def set_name(self, name):
        self.name = name
        return True

    def set_score(self, score):
        self.score = score
        return True
