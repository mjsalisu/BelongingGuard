from flask import Blueprint, g, jsonify, request, render_template

from app.user.model import User
from app.user.schema import UserSchema
from app.route_guard import auth_required
bp = Blueprint('user', __name__)
isError = True

@bp.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        email = request.form.get('email')
        password = request.form.get('password')
        
        user = User.get_by_email(email)
        if user is None:
            mgs = 'User not found'
            return render_template('login.html', result_message=mgs, isError=isError), 404
        if not user.check_password(password):
            msg = 'Wrong password'
            return render_template('login.html', result_message=mgs, isError=isError), 401

        token = user.generate_token()
        result_message = jsonify({'token': token, 'user': UserSchema().dump(user)}), 200
        return render_template('login.html', result_message=result_message), 401
    else:
        return render_template('login.html')
    
@bp.route('/register', methods=['GET', 'POST'])
def register():
    if request.method == 'POST':
        fullname = request.form.get('fullname') 
        regNumber = request.form.get('regNumber')
        phoneNumber = request.form.get('phoneNumber') 
        emailAddress = request.form.get('emailAddress')
        password = request.form.get('password')

        if fullname and regNumber and phoneNumber and emailAddress and password:
            user = User.get_by_email(emailAddress)
            if user is not None:
                msg = 'A user is already registered with the same phone number, or email address.'
                return render_template('register.html', result_message=msg, isError=isError), 400
            user = User.create(fullname, regNumber, phoneNumber, emailAddress, password)
            if user is not None:
                msg = 'User created successfully, please login'
                return render_template('login.html', result_message=msg, isError=isError), 201
        else:
            msg = 'One or more fields are invalid'
            return render_template('register.html', result_message=msg, isError=isError), 400
    else:
        return render_template('register.html')
    
@bp.patch('/reset-password')
@auth_required()
def reset_password():
    new_password = request.json.get('password')
    if not new_password:
        return jsonify({'message': 'Password is required'}), 400
    elif len(new_password) < 4:
        return jsonify({'message': 'Password must be at least 4 to 8 characters long'}), 400
    g.user.reset_password(new_password)
    return jsonify({'message': 'Password updated successfully'}), 200

@bp.get('/users')
# @auth_required()
def users():
    user = User.get_users()
    if user is None:
        return jsonify({'message': 'Users not found'}), 404
    return jsonify({'user': UserSchema(many=True).dump(user)}), 200
