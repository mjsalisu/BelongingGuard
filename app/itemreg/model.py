from app import db

class Itemreg(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    userID = db.Column(db.Integer, db.ForeignKey('User.id'))
    user = db.relationship("User")
    trackingID = db.Column(db.String)
    checkInBy = db.Column(db.Integer, db.ForeignKey('User.id'))
    checkInDate = db.Column(db.DateTime)
    checkInNote = db.Column(db.String)
    isCheckIn = db.Column(db.Boolean, default=False)
    
    checkOutBy = db.Column(db.Integer, db.ForeignKey('User.id'))
    checkOutDate = db.Column(db.DateTime)
    checkOutNote = db.Column(db.String)
    isCheckOut = db.Column(db.Boolean, default=False)

    created_at = db.Column(db.DateTime, default=db.func.now())
    updated_at = db.Column(db.DateTime, default=db.func.now())
    is_deleted = db.Column(db.Boolean, default=False)

    def save(self):
        db.session.add(self)
        db.session.commit()

    def update(self):
        self.updated_at = db.func.now()
        db.session.commit()
    
    def delete(self):
        self.is_deleted = True
        self.updated_at = db.func.now()
        db.session.commit()

    @classmethod
    def get_by_id(cls, id):
        return cls.query.filter_by(id=id, is_deleted=False).first()
    
    @classmethod
    def get_all(cls):
        return cls.query.filter_by(is_deleted=False).all()
    
    @classmethod
    def create(cls, userID):
        itemreg = cls()
        itemreg.save()
        return itemreg