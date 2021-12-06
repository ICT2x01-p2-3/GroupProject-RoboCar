from MazeDriver.entity.challenge import *
from MazeDriver.database import db, Challenge_table

class Challenge_Control:

    def add_challenge(self, name, solution, difficulty,file):
        result = Challenge(name, difficulty, solution, file)
        query = Challenge_table(name=result.name, difficulty=result.difficulty, solution=result.solution, maze=result.maze)
        db.session.add(query)
        db.session.commit()
        print("Row Added successfully!")


    def delete_challenge(self, id):
        Challenge_table.query.filter_by(id=id).delete()
        db.session.commit()


    def challenge_details(self):
        return Challenge_table.query.all()


    def select_challenge(self, id):
        results = {}
        query = Challenge_table.query.filter_by(id = id).first()
        if query:
            results['name']= query.name
            results['difficulty'] = query.difficulty
            f = open(query.maze,'r')
            line = f.readline()
            grid = line.split(",")
            results['grid'] = grid
            return results
        else:
            return None



