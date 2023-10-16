from app import ma
from app.idproof.model import *
from app.idproof.model import Idproof
from app.user.schema import UserSchema

class IdproofSchema(ma.SQLAlchemyAutoSchema):
    class Meta:
        model = Idproof
        exclude = ('is_deleted',)

        include_relationships = True
        include_fk = True
    user = ma.Nested(UserSchema)