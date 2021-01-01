<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Helpers\Common;
use App\Helpers\Http;
use chatapi\WhatsApp\Client;

use App\Helpers\Config;

class AccountController
{
    public static function add()
    {
        $postData = \Flight::request()->data->getData();

        $me = Http::get($postData['url'] . "me?token=" . $postData['token']);

        if(isset($me->name)) {
            $success = Config::set('accounts.users', $postData);

            if($success) {
                $responseData = [
                    'status' => true,
                    'message' => "[SUCCESS] Пользователь " . $me->name. '(' .$postData['user_id']. ')' . " успешно добавлен"
                ];
            } else {
                $responseData = [
                    'status' => false,
                    'message' => "[ERROR] Ошибка при добавлении пользователя " . $me->name. '(' .$postData['user_id']. ')' . ", возможно он уже был добавлен"
                ];
            }
        } else {
            $responseData = [
                'status' => false,
                'message' => "[ERROR] Данные для авторизации пользователя ". $postData['user_id'] ." неверные"
            ];
        }

        return \Flight::json($responseData);
    }

    public static function remove()
    {
        $postData = \Flight::request()->data->getData();

        if(Config::remove('accounts.users.' . $postData['user_id'])) {
            $responseData = [
                'status' => true,
                'message' => "[SUCCESS] Пользователь " . $postData['user_id'] . " успешно удален"
            ];
        } else {
            $responseData = [
                'status' => false,
                'message' => "[ERROR] Ошибка при удаление пользователя " . $postData['user_id']
            ];
        }

        return \Flight::json($responseData);
    }
    
    public static function getAll()
    {
        $secret = explode('=', explode('?', \Flight::request()->url)[1]);
        if($secret[1] !== APP_SECRET) {
            return \Flight::json([
                "status" => false,
                "message" => "Неверный параметр " . $secret[0]
            ]);
        }
        
        $users = Config::get('accounts.users');
        
        return \Flight::json($users);
    }
}