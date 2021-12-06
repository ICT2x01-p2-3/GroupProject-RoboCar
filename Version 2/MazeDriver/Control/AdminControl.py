import re
from MazeDriver.database import db, admin_table
from MazeDriver.entity.admin import *
import hashlib

class admin_control:

    def validation(self, email, password):
        error = None
        # Validation
        if not password or not password.strip():
            error = True
        elif not re.fullmatch(r'[A-Za-z0-9@#$%^&+=]{8,}', password):
            error = True

        if not email or not email.strip() or '@' not in email:
            error = True
        elif not (re.fullmatch(r'\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b', email)):
            error = True
            # SQL Login
        return error

    def login(self, email,password):
        if not self.validation(email,password):
            query = admin_table.query.filter_by(name=email).first()
            if query:
                hashed_pwd = query.password
                if hashlib.sha256(password.encode()).hexdigest() == hashed_pwd:
                    return True

        return False

    def register(self, email,password):
        if not self.validation(email, password):
            hash_pwd = hashlib.sha256(password.encode()).hexdigest()
            print(hash_pwd)
            query = admin_table(name=email, password=hash_pwd)
            db.session.add(query)
            db.session.commit()
            print("Successfully Registered!")
