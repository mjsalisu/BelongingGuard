from flask import Flask
from flask_sqlalchemy import SQLAlchemy
from flask_marshmallow import Marshmallow
from flask_migrate import Migrate
from flask_cors import CORS

# App Config
app = Flask(__name__, )
app.config.from_object('config')
db = SQLAlchemy(app)
ma = Marshmallow(app)
CORS(app)


# Celery
from app.celery import make_celery
celery = make_celery(app)

# Database
from config import secret
app.secret_key = secret
migrate = Migrate(app, db)


# Controllers
from app.user.controller import bp as user_bp
app.register_blueprint(user_bp)
from app.avatar.controller import bp as avatar_bp
app.register_blueprint(avatar_bp)
from app.logs.controller import bp as logs_bp
app.register_blueprint(logs_bp)
from app.itemreg.controller import bp as itemreg_bp
app.register_blueprint(itemreg_bp)
from app.idproof.controller import bp as idproof_bp
app.register_blueprint(idproof_bp)
from app.itemmovement.controller import bp as itemmovement_bp
app.register_blueprint(itemmovement_bp)

# Error handlers
# from .error_handlers import *