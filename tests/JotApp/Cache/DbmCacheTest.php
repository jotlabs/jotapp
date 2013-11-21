<?php

use JotApp\Cache\DbmCache;

class DbmCacheTest extends PHPUnit_Framework_TestCase {
    private $cache;

    public function setUp() {
        $this->cache = new DbmCache();
        $this->cache->setFilePath('/tmp/unit-test-' . time() . '.db');
    }

    public function tearDown() {
        $this->cache->close();
    }

    public function testClassExists() {
        $this->assertTrue(class_exists('JotApp\Cache\DbmCache'));
        $this->assertNotNull($this->cache);
        $this->assertTrue(is_a($this->cache, 'JotApp\Cache\DbmCache'));
        $this->assertTrue(is_a($this->cache, 'JotApp\Cache\Cache'));

    }
   
    public function testExists() {
        $key = 'unit-test-key';

        $this->assertFalse($this->cache->exists($key));

    } 

    public function testSetExists() {
        $key   = 'unit-test-key';
        $value = time();

        $this->cache->set($key, $value);
        $this->assertTrue($this->cache->exists($key));

        $response = $this->cache->get($key);
        $this->assertEquals($value, $response);

        $value = 'New value ' + $value;
        $this->cache->set($key, $value);

        $response = $this->cache->get($key);
        $this->assertEquals($value, $response);
        

    }

}

?>
