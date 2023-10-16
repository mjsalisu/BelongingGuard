from flask import Blueprint
from app.route_guard import auth_required

from app.itemmovement.model import *
from app.itemmovement.schema import *

bp = Blueprint('itemmovement', __name__)

@bp.post('/itemmovement')
@auth_required()
def create_itemmovement():
    itemmovement = Itemmovement.create()
    return ItemmovementSchema().dump(itemmovement), 201

@bp.get('/itemmovement/<int:id>')
@auth_required()
def get_itemmovement(id):
    itemmovement = Itemmovement.get_by_id(id)
    if itemmovement is None:
        return {'message': 'Itemmovement not found'}, 404
    return ItemmovementSchema().dump(itemmovement), 200

@bp.patch('/itemmovement/<int:id>')
@auth_required()
def update_itemmovement(id):
    itemmovement = Itemmovement.get_by_id(id)
    if itemmovement is None:
        return {'message': 'Itemmovement not found'}, 404
    itemmovement.update()
    return ItemmovementSchema().dump(itemmovement), 200

@bp.delete('/itemmovement/<int:id>')
@auth_required()
def delete_itemmovement(id):
    itemmovement = Itemmovement.get_by_id(id)
    if itemmovement is None:
        return {'message': 'Itemmovement not found'}, 404
    itemmovement.delete()
    return {'message': 'Itemmovement deleted successfully'}, 200

@bp.get('/itemmovements')
@auth_required()
def get_itemmovements():
    itemmovements = Itemmovement.get_all()
    return ItemmovementSchema(many=True).dump(itemmovements), 200