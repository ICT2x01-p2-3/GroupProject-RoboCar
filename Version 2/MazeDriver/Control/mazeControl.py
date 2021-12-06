
class maze_control():

    def __init__(self, map, solution):
        self.solution = solution
        self.dmap = []
        for x in map:
            temp = []
            for y in x:
                temp.append(y)
            self.dmap.append(temp)

    def get_car(self):
        if self.solution[0] != "":
            for row in range(len(self.dmap)):
                for cell in range(len(self.dmap[row])):
                    if self.dmap[row][cell] == "2":
                        return [row,cell]
        return None

    def move_car(self, row, cell):
        success = None
        error = None

        if self.solution[0] == "Forward":
            if self.dmap[row - 1][cell] != "1" or self.dmap[row - 1][cell] != "3":
                self.dmap[row][cell] = "0"
                self.dmap[row - 1][cell] = "2"
            elif self.dmap[row - 1][cell] == "3":
                success = 1
            else:
                error = 1

        elif self.solution[0] == "Backward":
            if self.dmap[row + 1][cell] != "1" or self.dmap[row + 1][cell] != "3":
                self.dmap[row][cell] = "0"
                self.dmap[row + 1][cell] = "2"
            elif self.dmap[row + 1][cell] == "3":
                success = 1
            else:
                error = 2

        elif self.solution[0] == "Right":
            if self.dmap[row][cell + 1] != "1" or self.dmap[row][cell + 1] != "3":
                self.dmap[row][cell] = "0"
                self.dmap[row][cell + 1] = "2"
            elif self.dmap[row][cell + 1] == "3":
                success = 1
            else:
                error = 3

        elif self.solution[0] == "Left":
            if self.dmap[row][cell - 1] != "1" or self.dmap[row][cell - 1] != "3":
                self.dmap[row][cell] = "0"
                self.dmap[row][cell - 1] = "2"
            elif self.dmap[row][cell - 1] == "3":
                success = 1
            else:
                error = 4

        return [self.dmap,self.solution,success,error]

