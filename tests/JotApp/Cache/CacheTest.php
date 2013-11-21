<?php

use JotApp\Cache\Cache;

class UnitTestCache implements Cache {
    private $cache;

    public function __construct() {
        $this->cache = array();
    }

    public function exists($key) {
        return array_key_exists($key, $this->cache);
    }
    
    public function get($key) {
        return $this->cache[$key];
    }

    public function set($key, $value) {
        $this->cache[$key] = $value;
    }

    public function delete($key) {
        unset($this->cache[$key]);
    }

}

class CacheTest extends PHPUnit_Framework_TestCase {
    private $cache;

    public function setUp() {
        $this->cache = new UnitTestCache();
    }

    public function testClassExists() {
        $this->assertTrue(is_a($this->cache, 'UnitTestCache'));
        $this->assertTrue(is_a($this->cache, 'JotApp\Cache\Cache'));
    }

}

?>
