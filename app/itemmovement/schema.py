from app import ma
from app.itemmovement.model import *
from app.itemmovement.model import Itemmovement
from app.itemreg.schema import ItemregSchema

class ItemmovementSchema(ma.SQLAlchemyAutoSchema):
    class Meta:
        model = Itemmovement
        exclude = ('is_deleted',)

        include_relationships = True
        include_fk = True
    item = ma.Nested(ItemregSchema)