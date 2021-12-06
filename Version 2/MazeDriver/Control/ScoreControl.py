from MazeDriver.database import db, score_table


class score_Control:

    def GetScore(self):
        return score_table.query.all()

    def SetScore(self, name, score):
        query = score_table.query.filter_by(name=name)
        if query:
            query.score = score
            db.session.commit()
        else:
            query = score_table(name=name, score=score)
            db.session.add(query)
            db.session.commit()
