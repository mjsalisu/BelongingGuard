from app import ma
from app.avatar.model import *

class AvatarSchema(ma.SQLAlchemyAutoSchema):
    class Meta:
        model = Avatar
        exclude = ('is_deleted',)