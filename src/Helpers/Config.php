<?php


namespace App\Helpers;


class Config
{
    /**
     * Retrieves a group config items.
     *
     * @param $items
     * @return bool
     * @throws \Exception
     */
    public static function get($items)
    {
        $items = explode('.', trim($items));
        $config = self::file($items[0]);
        if (count($items) > 1) {
            unset($items[0]);
            foreach($items as $item) {
                if (isset($config[$item])) {
                    $config = $config[$item];
                }
            }
        }

        return $config;
    }

    public static function set($keys = 'accounts.users', $data) {
        $items = explode('.', trim($keys));
        $config = self::file($items[0]);
        if(count($items) > 1) {
            if(!empty($data['user_id'])) {
                if(!isset($config[$items[1]][$data['user_id']])) {
                    $config[$items[1]][$data['user_id']] = Common::arrayExclude($data, ['user_id']);
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        return self::save($items[0], $config);
    }

    public static function remove($keys) {
        $items = explode('.', trim($keys));
        $config = self::file($items[0]);

        if(count($items) > 1) {
            if(isset($config[$items[1]][$items[2]])) {
                unset($config[$items[1]][$items[2]]);
            } else {
                return false;
            }
        }

        return self::save($items[0], $config);
    }

    /**
     * @param string $config
     * @return bool|mixed
     */
    public static function file($config = 'accounts')
    {
        $path = sprintf('%s/src/Configs/%s.json', ROOT_PATH, $config);
        // Check that the file exists before we attempt to load it.
        if (file_exists($path)) {
            // Get items from the file.
            return json_decode(file_get_contents($path), true);
        }
        // File load unsuccessful.
        return false;
    }

    private static function save($configName = 'accounts', $config) {
        $path = sprintf('%s/src/Configs/%s.json', ROOT_PATH, $configName);
        if (file_exists($path)) {
            file_put_contents($path, json_encode($config));
            return true;
        }
        // File load unsuccessful.
        return false;
    }
}