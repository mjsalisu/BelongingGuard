import sys
sys.dont_write_bytecode = True

from datetime import datetime
# timestamp = datetime.now()

from app import app

@app.route("/")
def index():
    return {'name':"BelongingGuard", 'version':"0.0.1", 'timestamp':datetime.now(), 'status':"OK"}

@app.route('/health')
def health():
    # TODO do some checks here to confirm everything works
    return {'timestamp':datetime.now(), 'status':'OK'}, 200

if __name__ == '__main__':
    app.run(debug=True)