from app import ma
from app.idproof.model import *

class IdproofSchema(ma.SQLAlchemyAutoSchema):
    class Meta:
        model = Idproof
        exclude = ('is_deleted',)