"""
The flask application package.
"""
from os import environ
from flask import redirect, url_for, jsonify
from MazeDriver.Control import ChallengeControl, PinControl, ScoreControl, AdminControl
from flask import render_template, request
from datetime import datetime
from werkzeug.utils import secure_filename
import os
from database import app


ccontrol = ChallengeControl.Challenge_Control()
pcontrol = PinControl.Pin_Control()
scontrol = ScoreControl.score_Control()
acontrol = AdminControl.admin_control()
ALLOWED_EXTENSIONS = {'txt'}

def allowed_file(filename):
    return '.' in filename and \
           filename.rsplit('.', 1)[1].lower() in ALLOWED_EXTENSIONS

##############################################
##                Student                   ##
##############################################
@app.route('/', methods=['GET','POST'])
def student():
    if request.method == "GET":
        return render_template('index.html',title='Student Page',year=datetime.now().year)
    if request.method == "POST":
        pin = request.form.get('pin')
        if pcontrol.comparePin(pin):
            return redirect(url_for('studentSelect'))
        else:
            return render_template('index.html',title='Student Page',error=True, year=datetime.now().year)

@app.route('/studentDashboard', methods=['GET'])
def studentSelect():
    if request.method == "GET":
        return render_template('UserDashboard.php',title='Student Page',year=datetime.now().year)


@app.route('/studentScoreboard', methods=['GET'])
def studentScore():
    if request.method == "GET":
        data = scontrol.GetScore()
        return render_template('Scoreboard.php', title='Student ScoreBoard', data=data, year=datetime.now().year)


@app.route('/studentChallenge', methods=['GET','POST'])
def studentChallenge():
    if request.method == "GET":
        data = ccontrol.challenge_details()
        return render_template('User_Challenge.php', title='Student Challenge', data=data, year=datetime.now().year)
    if request.method == "POST":
        id = request.form.get('id')
        data = ccontrol.select_challenge(id)
        if data:
            #print(data)
            return render_template('VirtualMap.php', title='Student Challenge', data=data, year=datetime.now().year)
        return redirect(url_for('studentChallenge'))


@app.route('/studentSubmit', methods=['GET','POST'])
def studentSubmit():
    print("hello")
    if request.method == "POST":
        print("test")
        query = request.get_json()
        print(query)
        return render_template('VirtualMap.php', title='Student Challenge', data=data, year=datetime.now().year)






##############################################
##                Test                      ##
##############################################
@app.route('/studentBlock', methods=['GET'])
def test():
    if request.method == "GET":
        return render_template('Blockly.html', title='Student Challenge', year=datetime.now().year)



##############################################
##             Admin Login                  ##
##############################################
@app.route('/admin', methods=['GET','POST'])
def admin_login():
    if request.method == "GET":
        return render_template('Admin_login.html',title='Admin Page',year=datetime.now().year)
    elif request.method == "POST":
        email = request.form.get('username')
        password = request.form.get('password')
        if acontrol.login(email, password):
            return redirect(url_for('dashboard_render'))
        else:
            return render_template('Admin_login.html',title='Admin Page',error=True,year=datetime.now().year)

@app.route('/dashboard', methods=['GET'])
def dashboard_render():
    if request.method == "GET":
        return render_template('Admindashboard.php', title='Admin Dashboard', year=datetime.now().year)


##############################################
##            Admin Pin Route               ##
##############################################
@app.route('/pin', methods=['GET'])
def pinPage():
    if request.method == "GET":
        data = None
        result = pcontrol.GetPin()
        if result:
            data = result[0].pin
        return render_template('pin_page.php', title='Admin Pin Generator', data=data, year=datetime.now().year)
    else:
        return redirect(url_for('pinPage'))

@app.route('/generate_pin', methods=['POST'])
def GeneratePin():
    if request.method == "GET":
        return redirect(url_for('pinPage'))
    elif request.method == "POST":
        pcontrol.GeneratePin()
        return redirect(url_for('pinPage'))

##############################################
##       Admin Challenges Renderer          ##
##############################################
@app.route('/Challenge', methods=['GET','POST'])
def ChallengeBoundary():
    if request.method == "GET":
        table = ccontrol.challenge_details()
        return render_template('Admin_Challenge.php', title='Admin Challenge C2',data=table, year=datetime.now().year)
    elif request.method == "POST":
        print('hello')


@app.route('/add_Challenge', methods=['GET','POST'])
def addChallenge():
    if request.method == "GET":
        return render_template('AddChallenge.php', title='Challenge', year=datetime.now().year)
    elif request.method == "POST":
        challenge_name = request.form.get('ChallengeName')
        solution = request.form.get('Solution')
        difficulty = request.form.get('Difficulty')

        if not challenge_name or not solution or not difficulty:
            return render_template('AddChallenge.php', title='Challenge', error=1, year=datetime.now().year)

        # Check for File
        if 'fileToUpload' not in request.files:
            print('No file part')
            return render_template('AddChallenge.php', title='Challenge', error=2, year=datetime.now().year)
        file = request.files['fileToUpload']
        if file.filename == '':
            print('No selected file')
            return render_template('AddChallenge.php', title='Challenge', error=3, year=datetime.now().year)

        if file and allowed_file(file.filename):
            filename = secure_filename(file.filename)
            file_loc = os.path.join(app.config['UPLOAD_FOLDER'], filename)
            file.save(file_loc)

        else:
            return render_template('AddChallenge.php', title='Challenge', error=4, year=datetime.now().year)

        # some validation method #
        ccontrol.add_challenge(challenge_name,solution,difficulty,file_loc)
        return redirect(url_for('ChallengeBoundary'))


@app.route('/del_Challenge', methods=['GET', 'POST'])
def deleteChallenge():
    if request.method == "GET":
        return redirect(url_for('ChallengeBoundary'))
    elif request.method == 'POST':
        id = request.form.get('id')
        ccontrol.delete_challenge(id)
        return redirect(url_for('ChallengeBoundary'))




if __name__ == '__main__':
    HOST = environ.get('SERVER_HOST', 'localhost')
    try:
        PORT = int(environ.get('SERVER_PORT', '5555'))
    except ValueError:
        PORT = 5555
    app.run(HOST, PORT)




