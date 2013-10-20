<?php

namespace JotApp\Utils;

use Hautelook\Phpass\PasswordHash;

class PasswordUtils {
    private static $hashCost     = 10;
    private static $hashPortable = true;
    private static $hasher;

    public static function hashPassword($password) {
        $hasher = self::getHasher();
        $hash   = $hasher->HashPassword($password);
        return $hash;
    }

    public static function checkPassword($password, $hash) {
        $hasher = self::getHasher();
        $isMatch = $hasher->CheckPassword($password, $hash);
        return $isMatch;
    }

    public static function getHasher() {
        if (empty(self::$hasher)) {
            self::$hasher = new PasswordHash(self::$hashCost, self::$hashPortable);
        }
        return self::$hasher;
    }

    public static function createSessionId($string) {
        $sessionId = md5(uniqid('jot|' . $_SERVER['HTTP_HOST'] . '|' . $string . '|'));
        return $sessionId;
    }

}

?>
