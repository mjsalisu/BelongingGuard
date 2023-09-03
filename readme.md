## BelongingGuard API Projects for SWE4203

### STEP ONE:

Create a virtual environment: `python -m venv venv`

### STEP TWO:

Activate your virtual environment:

- Windows: `venv\Scripts\activate`
- Mac: `source venv/bin/activate`

### STEP THREE:

Install all dependencies from requirements file with: `pip install -r requirements.txt`

### STEP FOUR

Within .env file, substitute "your_database_uri" with your specific database URL, like `sqlite:////tmp/test.db`, `mysql://username:password@server/test_db`, or any other applicable format.

### STEP FIVE

Starts the server: `fs start`

### STEP SIX

To add or remove a blueprint name, for instance "api", use: `fs add api` or `fs remove api`
