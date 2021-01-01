<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: GET,PUT,POST,DELETE');

set_time_limit(0);

require_once __DIR__ . '/vendor/autoload.php';


define("ROOT_PATH", __DIR__);
define("APP_SECRET", "your_secret_key");

Flight::route('/', function(){
    echo "
        <a href='/api/v1/whatsapp/send'>Отправка #1</a> <br>
        <a href='/api/v1/whatsapp/test/send'>Отправка #2</a> <br>
        <a href='/api/v1/whatsapp/add'>Добавление пользователя</a> <br>
        <a href='/api/v1/whatsapp/remove'>Удаление пользователя</a> <br>
        <a href='/api/v1/whatsapp/get?secret=APP_SECRET'>Список пользователей</a>
    ";
});

Flight::route('POST /api/v1/whatsapp/send', ['App\Controllers\WhatsappController','send']);

Flight::route('POST /api/v1/whatsapp/add', ['App\Controllers\AccountController','add']);
Flight::route('POST /api/v1/whatsapp/remove', ['App\Controllers\AccountController','remove']);
Flight::route('POST /api/v1/whatsapp/get', ['App\Controllers\AccountController', 'getAll']);

Flight::before('json', function () {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET,PUT,POST,DELETE');
    header('Access-Control-Allow-Headers: Content-Type');
});

Flight::route('GET /api/v1/whatsapp/test.1', function () {
    Flight::json(['test' => '1']);
});

Flight::start();