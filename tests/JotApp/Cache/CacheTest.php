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
        $response = NULL;

        if ($this->exists($key)) {
            $response = $this->cache[$key];
        }

        return $response;
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

    public function testKeyExists() {
        $key = 'unit-test-key';
        $this->assertFalse($this->cache->exists($key));
        
        $this->cache->set($key, 1);
        $this->assertTrue($this->cache->exists($key));

        $this->cache->delete($key);
        $this->assertFalse($this->cache->exists($key));
    }

    public function testCacheGetSet() {
        $key = 'unit-test-key';
        $value = time();

        $this->cache->set($key, $value);

        $response = $this->cache->get($key);
        $this->assertEquals($value, $response);

        $newValue = 'NEW ' . $value;
        $this->cache->set($key, $newValue);

        $response = $this->cache->get($key);
        $this->assertEquals($newValue, $response);

        $this->cache->delete($key);
        $response = $this->cache->get($key);
        $this->assertNull($response);
    }

}

?>
