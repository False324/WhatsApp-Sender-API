<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Helpers\Common;
use chatapi\WhatsApp\Client;

use App\Helpers\Excel;
use App\Helpers\Config;

class WhatsappController
{
    public static function send() {
        $req = \Flight::request()->data->getData();

        $messageFiles = $req['messages'];
        $url = $req['file'];
        $sleep = $req['sleep'];
        $user_id = $req['user_id'];
        $country_code = $req['country_code'];

        $messages[] = file($messageFiles[0]);
        $messages[] = file($messageFiles[1]);

        $path = ROOT_PATH . '/data/olx.xls';

        Common::downloadFile($url, $path);

        $exel = new Excel($path);
        $numbers = $exel->getXlsReciever($country_code);
        $account = Common::getAccount($user_id);

        if(!isset($account['url'])) {
            return \Flight::json([
                'status' => false,
                'message' => "Не удалось найти аккаунт с идентификатором $user_id"
            ]);
        }

        $client = Client::getInstance([
            "url" => $account['url'],
            "token" => $account['token']
        ]);

        $num = array_slice($numbers, rand(0, count($numbers) - 3), 2);
        $results = [];

        foreach ($num as $number => $url) {
            $res = $client->sendMessage([
                "phone" => $number,
                "body"  => $url
            ]);

            $results[$number][] = [
                'message' => $res->sent ? "Текст сообщения: $url" : "Не удалось отправить сообщение: $url"
            ];
            sleep($sleep);
            foreach ($messageFiles as $key => $value) {
                $message = Common::getRandomFirstMessage(file($value));

                $res = $client->sendMessage([
                    "phone" => $number,
                    "body"  => $message
                ]);

                $results[$number][] = [
                    'message' => $res->sent ? "Текст сообщения: $message" : "Не удалось отправить сообщение: $url"
                ];
                sleep($sleep);
            }
        }


        return \Flight::json($results);
    }
}