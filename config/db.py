import os
# Database configuration
SQLALCHEMY_DATABASE_URI='sqlite:////tmp/keep_safe.db'

# SQLALCHEMY_DATABASE_URI= os.environ.get('DATABASE_URI')
SQLALCHEMY_TRACK_MODIFICATIONS = False
