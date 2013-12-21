<?php
namespace JotApp\Utils;

class UrlUtils {


    public static function isValidDomain($domain) {
        $isValid = preg_match('/^[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z0-9]{2,})$/i', $domain);

        return (bool)$isValid;
    }

}

?>
