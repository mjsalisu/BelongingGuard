from app import ma
from app.idproof.model import *
from app.idproof.model import Idproof

class IdproofSchema(ma.SQLAlchemyAutoSchema):
    class Meta:
        model = Idproof
        exclude = ('is_deleted',)