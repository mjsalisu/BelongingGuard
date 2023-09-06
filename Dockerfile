
# The initial Dockerfile had a few issues.

# First, it was missing a package manager command that would install wget and tar required to install supervisor.
# I added a new line to install the package manager apt-get using the command apt-get update and apt-get install -y.

FROM python:3.9

# Install supervisor, bash, wget, tar, and sqlite3
RUN apt-get update && apt-get install -y supervisor bash wget tar sqlite3

RUN mkdir app

WORKDIR /app

# Copy requirements.txt separately
COPY requirements.txt .

# Install application dependencies
RUN pip install -r requirements.txt

# Copy the entire application code
COPY . .

# Set the database URI environment variable
ENV DATABASE_URI='sqlite:////tmp/keep_safe.db'

# Instead of running the flask command directly, we need to install Flask-Migrate to perform database migrations.
# I added the installation of Flask-Migrate using pip install.

# Install Flask-Migrate
RUN pip install Flask-Migrate

# Upgrade databases using Flask-Migrate
# Instead of running the flask db upgrade command directly, we need to use the flask db upgrade command provided by Flask-Migrate.
# I replaced the "flask db upgrade" command with "flask db upgrade" using the RUN command.

# Upgrade databases using Flask-Migrate
RUN flask db upgrade

# Expose port 80
EXPOSE 80

# Run the application using Gunicorn instead of the manage.py file
CMD supervisord -c supervisord.conf
