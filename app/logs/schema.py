from app import ma
from app.logs.model import *

class LogsSchema(ma.SQLAlchemyAutoSchema):
    class Meta:
        model = Logs
        exclude = ('is_deleted',)