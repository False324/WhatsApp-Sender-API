<?php

namespace App\Helpers;

class Common
{
    public static function arrayExclude($array, Array $excludeKeys){
        foreach($excludeKeys as $key){
            unset($array[$key]);
        }
        return $array;
    }

    public static function getAccount($userKey = "random") {
        if($userKey === "random") $userKey = array_rand(Config::get('accounts.users'), 1);
        $account = Config::get("accounts.users");

        return isset($account[$userKey]) ? $account[$userKey] : array_rand(Config::get('accounts.users'), 1);
    }

    public static function getRandomFirstMessage($array) {
        $key = array_rand($array, 1);
        $message = $array[$key];

        return $message;
    }

    public static function downloadFile($url, $path)
    {
        $newfname = $path;
        $file = fopen ($url, 'rb');
        if ($file) {
            $newf = fopen ($newfname, 'wb');
            if ($newf) {
                while(!feof($file)) {
                    fwrite($newf, fread($file, 1024 * 8), 1024 * 8);
                }
            }
        }
        if ($file) {
            fclose($file);
        }
        if ($newf) {
            fclose($newf);
        }
    }

}