<?php


namespace App\Helpers;


class Http
{
    public static function get($url) {
        $ch = curl_init();
        $headers = [
            'Accept: application/json',
            'Content-Type: application/json',

        ];
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        return json_decode($result);
    }
}