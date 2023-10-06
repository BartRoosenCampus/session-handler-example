<?php

namespace App\Services;

class Session
{
    const sessionFilePath = './session/';

    const TIMESTAMP = 'timestamp';
    const COLOR     = 'color';
    const USER      = 'user';

    private static array $keys = [self::TIMESTAMP, self::COLOR, self::USER];

    public static function add(string $key, mixed $value)
    {
        if (self::isValidKey($key) && self::isValidValue($value)) {
            self::start();
            $_SESSION[$key] = is_object($value) ? serialize($value) : $value;
        }
    }

    public static function get(string $key): mixed
    {
        self::start();

        if (self::isValidKey($key) && isset($_SESSION[$key])) {
            if (is_array($_SESSION[$key]) || !@unserialize($_SESSION[$key])) return $_SESSION[$key];

            return unserialize($_SESSION[$key]);
        }

        return false;
    }

    public static function itemExits(string $key): bool
    {
        self::start();

        return isset($_SESSION[$key]);
    }

    private static function start()
    {
        if (!file_exists(self::sessionFilePath)) mkdir(self::sessionFilePath);

        if (session_status() === PHP_SESSION_NONE) {
            session_save_path(self::sessionFilePath);
            ini_set('session.gc_probability', 1);
            session_start();
        }

        if (empty($_SESSION[self::TIMESTAMP])) {
            $_SESSION[self::TIMESTAMP] = time();
        } else {
            if (time() - (int)$_SESSION[self::TIMESTAMP] >= 10) {
                session_regenerate_id();
                self::removeObsoleteSessionFiles();
            }
        }
    }

    private static function stop()
    {
        session_destroy();
    }

    private static function isValidKey($key): bool
    {
        return in_array($key, self::$keys);
    }

    public static function show(): array
    {
        self::start();

        return $_SESSION;
    }

    private static function isValidValue(mixed $value): bool
    {
        // no array of objects allowed
        if (is_array($value)) {
            foreach ($value as $item) {
                if (is_object($item)) return false;
            }
        }

        return true;
    }

    private static function removeObsoleteSessionFiles()
    {
        $files = scandir(self::sessionFilePath);
        foreach ($files as $file) {
            if ('sess_' . session_id() !== $file && '.' !== $file && '..' !== $file) {
                unlink(sprintf('%s%s',self::sessionFilePath, $file ));
            }
        }
    }
}