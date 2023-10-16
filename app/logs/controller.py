from flask import Blueprint
from app.route_guard import auth_required

from app.logs.model import *
from app.logs.schema import *

bp = Blueprint('logs', __name__)

@bp.post('/logs')
@auth_required()
def create_logs():
    logs = Logs.create()
    return LogsSchema().dump(logs), 201

@bp.get('/logs/<int:id>')
@auth_required()
def get_logs(id):
    logs = Logs.get_by_id(id)
    if logs is None:
        return {'message': 'Logs not found'}, 404
    return LogsSchema().dump(logs), 200

@bp.patch('/logs/<int:id>')
@auth_required()
def update_logs(id):
    logs = Logs.get_by_id(id)
    if logs is None:
        return {'message': 'Logs not found'}, 404
    logs.update()
    return LogsSchema().dump(logs), 200

@bp.delete('/logs/<int:id>')
@auth_required()
def delete_logs(id):
    logs = Logs.get_by_id(id)
    if logs is None:
        return {'message': 'Logs not found'}, 404
    logs.delete()
    return {'message': 'Logs deleted successfully'}, 200

@bp.get('/logss')
@auth_required()
def get_logss():
    logss = Logs.get_all()
    return LogsSchema(many=True).dump(logss), 200