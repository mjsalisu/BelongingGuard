import re

def is_valid_text(text):
    return bool(re.match(r'^[A-Za-z\s]+$', text))

def is_valid_email(email):
    return bool(re.match(r'^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$', email))

def is_valid_password(password):
    return bool(re.match(r'^(?=.*[a-zA-Z\d]).{4,}$', password))

# Test the validation functions
# fullname = "Jamilu Salisu"
# email = "jamilusalis@gmail.com"
# password = "Admin@123"

# if is_valid_text(fullname) and is_valid_email(email) and is_valid_password(password):
#     print("All fields are valid.")
# else:
#     print("One or more fields are invalid.")