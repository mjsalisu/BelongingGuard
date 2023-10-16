from app import ma
from app.itemmovement.model import *

class ItemmovementSchema(ma.SQLAlchemyAutoSchema):
    class Meta:
        model = Itemmovement
        exclude = ('is_deleted',)