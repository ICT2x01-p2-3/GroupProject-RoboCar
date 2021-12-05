#from MazeDriver import maze

#from sqlalchemy.ext.declarative import declarative_base


class Challenge:

    def __init__(self, name, difficulty, solution, maze):
        self.name = name
        self.difficulty = difficulty
        self.solution = solution
        self.maze = maze

    def get_id(self, id):
        return self.id

    def get_name(self, name):
        return self.name

    def get_difficulty(self):
        return self.difficulty

    def get_solution(self):
        return self.solution

    def get_maze(self):
        return self.maze

    def set_id(self, id):
        self.id = id
        return True

    def set_difficulty(self, difficulty):
        self.difficulty = difficulty
        return True
    
    def set_solution(self, solution):
        self.solution = solution
        return True

    def set_maze(self, maze):
        self.maze = maze
        return True

