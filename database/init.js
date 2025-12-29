db = db.getSiblingDB('youcode');
db.createCollection('users');
db.users.insertOne({ username: 'admin', password: 'admin' });
