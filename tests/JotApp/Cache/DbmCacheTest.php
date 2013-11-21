<?php

use JotApp\Cache\DbmCache;

class DbmCacheTest extends PHPUnit_Framework_TestCase {
    private $cache;

    public function setUp() {
        $this->cache = new DbmCache();
    }

    public function testClassExists() {
        $this->assertTrue(class_exists('JotApp\Cache\DbmCache'));
        $this->assertNotNull($this->cache);
        $this->assertTrue(is_a($this->cache, 'JotApp\Cache\DbmCache'));
        $this->assertTrue(is_a($this->cache, 'JotApp\Cache\Cache'));

    }
    

}

?>
