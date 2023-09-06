
FROM python:3.9

# Install supervisor, bash, and sqlite3
RUN apt-get update && apt-get install -y supervisor bash sqlite3

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

# Upgrade databases using Flask-Migrate
RUN flask db upgrade

# Expose port 80
EXPOSE 80

# Run the application using Gunicorn instead of the manage.py file
CMD supervisord -c supervisord.conf