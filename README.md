## Introduction to Project

This project involves the development of a robotic car and a gamified feedback system that communicates with the car. The purpose of the project is aimed for students ages 8-12 to have an exciting way to engage them with feedback in numerous different ways. The feedback system is expected to provide an interactive, simple and visual way for the students to identify the data of the robotic car using a web portal. Furthermore, the data(statuses) of the car should be simple to see on the web interface in a dashboard.
## How to Run
To run the program, please install the following prerequisites, followed by running app.py in the folder MazeDriver
### Prerequisites
- Flask 
- Flask-SQLAlchemy
- Flask-WTF
- Jinja2
- SQLAlchemy
- WTForms
- Werkzeug
- pip
- setuptools

## BlackBox Testing
In blackbox testing, we tested our website using the SSD and test case list from our M2.

![SSD](https://user-images.githubusercontent.com/77533235/144831738-c18013e1-bb03-4dc8-945f-b058516ee965.JPG)


![testcase1](https://user-images.githubusercontent.com/77533235/144831416-82312781-d6c2-4da7-b2eb-001443e28c77.JPG)

![testcase2](https://user-images.githubusercontent.com/77533235/144831418-41d8405f-6824-4ecd-afaa-564bf85d44cf.JPG)



[![IMAGE ALT TEXT HERE](https://img.youtube.com/vi/RlCnHZbNePE/0.jpg)](https://www.youtube.com/watch?v=RlCnHZbNePE)

## WhiteBox Testing
Meaningful Classes chosen: Challenge.py and PinControl.py
In python flask, the library used for whitebox testing is PyTest
PyTest uses the library called "coverage" to run statement coverages using "assert" function

How to use coverage:
pip install coverage
create a test case method (use assert)
python -m coverage run <class.py> <secondclass.py>
python -m coverage report (generates the report for statement coverage)

Video Demo of WhiteBox Testing:

https://user-images.githubusercontent.com/77533235/144742757-c337a35b-f1d8-460b-ad35-64b7e8af24c3.mp4

## GitFlow
![gitflow](https://user-images.githubusercontent.com/28554582/144847244-68bfd1c6-ff2a-4a51-ac45-0d7314de2277.png)

## Problems
- Lack of Technical skills
- insufficient information on the product
- Defects from the car
- Integration Issue
- Getting to know each member

### How do we tackle such problems?
To solve the problems, the team decided to spend at least 1 week researching and learning the features of the car and its API used for the web application. While the IS student will research the security features that can be implemented on the web application and wireless communication (wifi). The way forward for the second week is for the team to start integrating the car with the web application and setting up the web application.

