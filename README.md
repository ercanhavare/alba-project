# AlbaProject
<p>This project is interview challenge. 
Using one of popular PHP framework called "Laravel 7". <br> 
For the project setup please follow below steps: </p>

### 1) Clone project from github 
<p> https://github.com/ercanhavare/alba-project </p>

### 2) Build docker
<p> docker-compose build && docker-compose up -d </p>
<p> make folder ~/project/mysql </p>
<p> make foled ~/project/redis </p>

### 3) Give permissions of folder
<p>
sudo chown -R username:username /path <br>
sudo chmod -R 777 /path <br>
</p>

### 4) Configuration of Laravel
<p> composer install </p>
<p> ~/project/src/.env </p>

<p>
DB_CONNECTION=mysql <br>
DB_HOST=mysql <br>
DB_PORT=3306 <br>
DB_DATABASE=homestead <br>
DB_USERNAME=homestead <br>
DB_PASSWORD=secret
</p>

<p>
REDIS_HOST=redis <br>
REDIS_PASSWORD=null <br>
REDIS_PORT=6379 <br>
REDIS_CLIENT=predis <br>
</p>  

<p> docker-compose exec php php artisan migrate:fresh --seed </p>
<p> docker-compose exec php php artisan passport:install </p>

### 5) Open postman for test, you can use postman collection
<p> http://localhost:8080 </p>

### 6) UML Diagram
<p> https://github.com/ercanhavare/alba-project/wiki/UML-Diagram </p>

### 7) Postman Collection
<p> https://github.com/ercanhavare/alba-project/wiki/Postman-Collection </p>





