# klaud9 test
cd backend
composer install
sqlite3 app.db < resources/sql/schema.sql
php -S localhost:9001 -t web/

cd frontend
npm install
npm install react-slick
npm install slick-carousel
npm start

Front will work on localhost:3000

Username klaud9
Password klaud9
