<?php

namespace JotApp\Cache;

interface Cache {

    public function exists($key);
    public function get($key);
    public function set($key, $value);
    public function delete($key);

}


?>
