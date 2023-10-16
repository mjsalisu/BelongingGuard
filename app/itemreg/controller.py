from flask import Blueprint
from app.itemreg.model import Itemreg
from app.itemreg.schema import ItemregSchema
from app.route_guard import auth_required

from app.itemreg.model import *
from app.itemreg.schema import *

bp = Blueprint('itemreg', __name__)

@bp.post('/itemreg')
@auth_required()
def create_itemreg():
    itemreg = Itemreg.create()
    return ItemregSchema().dump(itemreg), 201

@bp.get('/itemreg/<int:id>')
@auth_required()
def get_itemreg(id):
    itemreg = Itemreg.get_by_id(id)
    if itemreg is None:
        return {'message': 'Itemreg not found'}, 404
    return ItemregSchema().dump(itemreg), 200

@bp.patch('/itemreg/<int:id>')
@auth_required()
def update_itemreg(id):
    itemreg = Itemreg.get_by_id(id)
    if itemreg is None:
        return {'message': 'Itemreg not found'}, 404
    itemreg.update()
    return ItemregSchema().dump(itemreg), 200

@bp.delete('/itemreg/<int:id>')
@auth_required()
def delete_itemreg(id):
    itemreg = Itemreg.get_by_id(id)
    if itemreg is None:
        return {'message': 'Itemreg not found'}, 404
    itemreg.delete()
    return {'message': 'Itemreg deleted successfully'}, 200

@bp.get('/itemregs')
@auth_required()
def get_itemregs():
    itemregs = Itemreg.get_all()
    return ItemregSchema(many=True).dump(itemregs), 200