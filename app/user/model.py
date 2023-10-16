from operator import or_
import jwt, string, secrets, bcrypt
from datetime import datetime
from app import app, db, secret

class User(db.Model):
    __tablename__ = 'users'
    id = db.Column(db.Integer, primary_key=True)
    fullname = db.Column(db.String, nullable=False)
    regNumber = db.Column(db.String, nullable=False, unique=True)
    phoneNumber = db.Column(db.String, nullable=False, unique=True)
    emailAddress = db.Column(db.String, nullable=False, unique=True)
    password = db.Column(db.String, nullable=False)
    isVerified = db.Column(db.Boolean, default=False)
    isAdmin = db.Column(db.Boolean, default=False)
    created_at = db.Column(db.DateTime, default=db.func.now())
    updated_at = db.Column(db.DateTime)
    
    def save(self):
        db.session.add(self)
        db.session.commit()
    
    def update(self):
        self.updated_at = db.func.now()
        db.session.commit()
    
    def generate_password(self):
        alphabet = string.ascii_letters + string.digits
        password = ''.join(secrets.choice(alphabet) for i in range(10))
        return password
    
    def hash_password(self):
        self.password = bcrypt.hashpw(self.password.encode('utf-8'), bcrypt.gensalt()).decode('utf-8')
    
    def check_password(self, password):
        return bcrypt.checkpw(password.encode('utf-8'), self.password.encode('utf-8'))
    
    def generate_token(self):
        payload = {
            'exp': app.config.get('JWT_REFRESH_TOKEN_EXPIRES'),
            'iat': datetime.utcnow(),
            'sub': self.id,
            'fullname': self.fullname,
            'emailAddress': self.emailAddress,
            'isAdmin': self.isAdmin
        }
        return jwt.encode(payload, secret, algorithm='HS256')
    
    def update_password(self, old_password, new_password):
        if self.is_verified(old_password):
            self.password = new_password
            self.hash_password()
            self.update()
            return True
        return False
    
    def reset_password(self, new_password):
        self.password = new_password
        self.hash_password()
        self.update()

    @classmethod
    def get_users(cls):
        return cls.query.filter_by().all()
        
    @classmethod
    def get_by_id(cls, id):
        return cls.query.filter_by(id=id).first()
    
    @classmethod
    def get_by_regNumber(cls, regNumber):
        return cls.query.filter_by(regNumber=regNumber).first()
    
    @classmethod
    def get_by_phoneNumber(cls, phoneNumber):
        return cls.query.filter_by(phoneNumber=phoneNumber).first()
    
    @classmethod
    def get_by_email(cls, emailAddress):
        return User.query.filter(User.emailAddress==emailAddress).first()
    
    # @classmethod
    # def get_by_regNo_or_phone_or_email(cls, regNumber=None, phoneNumber=None, emailAddress=None):
    #     return cls.query.filter(or_(cls.regNumber==regNumber, cls.phoneNumber==phoneNumber, cls.emailAddress==emailAddress)).first()
    
    @classmethod
    def create(cls, fullname, regNumber, phoneNumber, emailAddress, password):
        user = cls(fullname=fullname, regNumber=regNumber, phoneNumber=phoneNumber, emailAddress=emailAddress, password=password)
        user.hash_password()
        user.save()
        return user