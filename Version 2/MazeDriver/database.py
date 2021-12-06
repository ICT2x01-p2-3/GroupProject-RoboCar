
from flask_sqlalchemy import SQLAlchemy
from flask_wtf.csrf import CSRFProtect
from flask import Flask
from sqlalchemy import Table, Column, Integer, String, MetaData
csrf = CSRFProtect()
FOLDER_LOCATION = 'static/images/db'

app = Flask(__name__)
csrf.init_app(app)
app.config.update(
    DEBUG=True,
    SQLALCHEMY_DATABASE_URI= 'sqlite:///mazedriver.db',
    SECRET_KEY="secret1stheb3st",
    UPLOAD_FOLDER= FOLDER_LOCATION
)
db = SQLAlchemy(app)

##############################################
##             Challenge Table              ##
##############################################
class Challenge_table(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(50), nullable=False, unique=True)
    difficulty = db.Column(db.Integer, nullable=False)
    solution = db.Column(db.String(200))
    maze = db.Column(db.String(200))

    def __repr__(self):
        return "<Challenge %r>" % self.id


##############################################
##             Admin Table                  ##
##############################################
class admin_table(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(50), nullable=False, unique=True)
    password = db.Column(db.String(200))

    def __repr__(self):
        return "<Admin %r>" % self.id

##############################################
##               Pin Table                  ##
##############################################
class pin_table(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    pin = db.Column(db.String(50), nullable=False, unique=True)

    def __repr__(self):
        return "<Pin %r>" % self.id

##############################################
##               Score Table                ##
##############################################
class score_table(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(50), nullable=False, unique=True)
    score = db.Column(db.Integer, nullable=False)

    def __repr__(self):
        return "<Score %r>" % self.id



db.create_all()