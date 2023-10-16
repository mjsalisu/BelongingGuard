from app import ma
from app.itemreg.model import *
from app.itemreg.model import Itemreg

class ItemregSchema(ma.SQLAlchemyAutoSchema):
    class Meta:
        model = Itemreg
        exclude = ('is_deleted',)