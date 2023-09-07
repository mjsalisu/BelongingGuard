
FROM python:3.9

# Install supervisor and bash
RUN apt-get update && apt-get install -y supervisor bash

# Create a directory called `app`
RUN mkdir app

# Set the working directory to `/app`
WORKDIR /app

# Copy the `requirements.txt` file to the working directory
COPY requirements.txt .

# Install application dependencies
RUN pip install -r requirements.txt

# Copy the entire application code to the working directory
COPY . .

# Uncomment and add environment variables here
ARG DATABASE_URI
ENV DATABASE_URI='sqlite:////tmp/keep_safe.db'

# Install Flask in order to run Flask CLI commands
RUN pip install Flask

# Remove the following lines:
# - RUN flask db init
# - RUN flask db migrate -m "commit"
# - RUN flask db upgrade

# Updated the command to run the `manage.py` file
CMD python manage.py

# Expose port 80
EXPOSE 80

# Start supervisor with the specified configuration file
CMD bash -c "supervisord -c supervisord.conf"
