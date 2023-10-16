from app import ma
from app.itemmovement.model import *
from app.itemmovement.model import Itemmovement

class ItemmovementSchema(ma.SQLAlchemyAutoSchema):
    class Meta:
        model = Itemmovement
        exclude = ('is_deleted',)