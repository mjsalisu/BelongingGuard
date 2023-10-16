from app import ma
from app.logs.model import *
from app.logs.model import Logs
from app.user.schema import UserSchema

class LogsSchema(ma.SQLAlchemyAutoSchema):
    class Meta:
        model = Logs
        exclude = ('is_deleted',)

        include_relationships = True
        include_fk = True
    user = ma.Nested(UserSchema)