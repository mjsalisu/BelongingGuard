from flask import Blueprint
from app.route_guard import auth_required

from app.idproof.model import *
from app.idproof.schema import *

bp = Blueprint('idproof', __name__)

@bp.post('/idproof')
@auth_required()
def create_idproof():
    idproof = Idproof.create()
    return IdproofSchema().dump(idproof), 201

@bp.get('/idproof/<int:id>')
@auth_required()
def get_idproof(id):
    idproof = Idproof.get_by_id(id)
    if idproof is None:
        return {'message': 'Idproof not found'}, 404
    return IdproofSchema().dump(idproof), 200

@bp.patch('/idproof/<int:id>')
@auth_required()
def update_idproof(id):
    idproof = Idproof.get_by_id(id)
    if idproof is None:
        return {'message': 'Idproof not found'}, 404
    idproof.update()
    return IdproofSchema().dump(idproof), 200

@bp.delete('/idproof/<int:id>')
@auth_required()
def delete_idproof(id):
    idproof = Idproof.get_by_id(id)
    if idproof is None:
        return {'message': 'Idproof not found'}, 404
    idproof.delete()
    return {'message': 'Idproof deleted successfully'}, 200

@bp.get('/idproofs')
@auth_required()
def get_idproofs():
    idproofs = Idproof.get_all()
    return IdproofSchema(many=True).dump(idproofs), 200