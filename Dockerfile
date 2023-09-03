
FROM python:3.9

# Install supervisor and bash
RUN apt-get update && apt-get install -y supervisor bash

RUN mkdir app

# Removed cd app as it is unnecessary 

WORKDIR /app

# Copy requirements.txt separately before copying the application code
COPY requirements.txt .

# Install application dependencies
RUN pip install -r requirements.txt

# Copy the entire application code
COPY . .

# Uncomment and add environment variables here
# ARG DATABASE_URI
# ENV DATABASE_URI=${DATABASE_URI}
# Added comment for clarity

# Run Flask database upgrade
RUN flask db upgrade

# Updated the command to run the manage.py file
CMD python manage.py

# Expose port 80
EXPOSE 80

# Start supervisor with the specified configuration file
CMD bash -c "supervisord -c supervisord.conf" 
# Updated the command to use bash and added a comment for clarity
