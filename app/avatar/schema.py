from app import ma
from app.avatar.model import *
from app.avatar.model import Avatar
from app.user.schema import UserSchema

class AvatarSchema(ma.SQLAlchemyAutoSchema):
    class Meta:
        model = Avatar
        exclude = ('is_deleted',)

        include_relationships = True
        include_fk = True
    user = ma.Nested(UserSchema)