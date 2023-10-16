from app import ma
from app.itemreg.model import *

class ItemregSchema(ma.SQLAlchemyAutoSchema):
    class Meta:
        model = Itemreg
        exclude = ('is_deleted',)