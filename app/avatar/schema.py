from app import ma
from app.avatar.model import *
from app.avatar.model import Avatar

class AvatarSchema(ma.SQLAlchemyAutoSchema):
    class Meta:
        model = Avatar
        exclude = ('is_deleted',)