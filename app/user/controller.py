from flask import Blueprint, g, jsonify, request, render_template

from app.user.model import User
from app.user.schema import UserSchema
from app.route_guard import auth_required
from app.validation import is_valid_email, is_valid_password, is_valid_text
bp = Blueprint('user', __name__)
isError = True

@bp.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        email = request.form.get('email')
        password = request.form.get('password')
        
        user = User.get_by_email(email)
        if user is None:
            return render_template('login.html', result_message='User not found', isError=isError), 404
        if not user.check_password(password):
            return render_template('login.html', result_message='Wrong password', isError=isError), 401

        token = user.generate_token()
        result_message = jsonify({'token': token, 'user': UserSchema().dump(user)}), 200
        return render_template('login.html', result_message=result_message), 401
    else:
        return render_template('login.html')
    
@bp.route('/register', methods=['GET', 'POST'])
def register():
    if request.method == 'POST':
        fullname = request.form.get('fullname')
        email = request.form.get('email')
        password = request.form.get('password')
        role = 'user'

        if is_valid_text(fullname) and is_valid_email(email) and is_valid_password(password):
            user = User.get_by_email(email)
            if user is not None:
                return render_template('register.html', result_message='User already exists', isError=isError), 400
            user = User.create(fullname, email, password, role)
            if user is not None:
                return render_template('register.html', result_message='User created'), 201
        else:
            return render_template('register.html', result_message='One or more fields are invalid', isError=isError), 400
    else:
        return render_template('register.html')

@bp.patch('/reset-password')
@auth_required()
def reset_password():
    new_password = request.json.get('password')
    if not new_password:
        return jsonify({'message': 'Password is required'}), 400
    elif len(new_password) < 6:
        return jsonify({'message': 'Password must be at least 6 characters'}), 400
    g.user.reset_password(new_password)
    return jsonify({'message': 'Password updated successfully'}), 200

@bp.get('/users')
# @auth_required()
def users():
    user = User.get_users()
    if user is None:
        return jsonify({'message': 'Users not found'}), 404
    return jsonify({'user': UserSchema(many=True).dump(user)}), 200
