from app import ma
from app.itemreg.model import *
from app.itemreg.model import Itemreg
from app.user.schema import UserSchema

class ItemregSchema(ma.SQLAlchemyAutoSchema):
    class Meta:
        model = Itemreg
        exclude = ('is_deleted',)

        include_relationships = True
        include_fk = True
    user = ma.Nested(UserSchema)