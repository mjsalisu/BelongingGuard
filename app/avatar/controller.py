from flask import Blueprint
from app.avatar.model import Avatar
from app.avatar.schema import AvatarSchema
from app.route_guard import auth_required

from app.avatar.model import *
from app.avatar.schema import *

bp = Blueprint('avatar', __name__)

@bp.post('/avatar')
@auth_required()
def create_avatar():
    avatar = Avatar.create()
    return AvatarSchema().dump(avatar), 201

@bp.get('/avatar/<int:id>')
@auth_required()
def get_avatar(id):
    avatar = Avatar.get_by_id(id)
    if avatar is None:
        return {'message': 'Avatar not found'}, 404
    return AvatarSchema().dump(avatar), 200

@bp.patch('/avatar/<int:id>')
@auth_required()
def update_avatar(id):
    avatar = Avatar.get_by_id(id)
    if avatar is None:
        return {'message': 'Avatar not found'}, 404
    avatar.update()
    return AvatarSchema().dump(avatar), 200

@bp.delete('/avatar/<int:id>')
@auth_required()
def delete_avatar(id):
    avatar = Avatar.get_by_id(id)
    if avatar is None:
        return {'message': 'Avatar not found'}, 404
    avatar.delete()
    return {'message': 'Avatar deleted successfully'}, 200

@bp.get('/avatars')
@auth_required()
def get_avatars():
    avatars = Avatar.get_all()
    return AvatarSchema(many=True).dump(avatars), 200