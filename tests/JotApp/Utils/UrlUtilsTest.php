<?php

use JotApp\Utils\UrlUtils;

class UrlUtilsTest extends PHPUnit_Framework_TestCase {
    protected $validDomains = array(
        'example.com',
        'example.co.uk',
        'example.uk',
        't.co',
        'bit.ly',
        'google.search'
    );

    protected $invalidDomains = array(
        'example',
        'example.c-m',
        '.example.com'
    );

    public function testValidDomains() {
        foreach($this->validDomains as $domain) {
            $this->assertTrue(UrlUtils::isValidDomain($domain));
        }
    }

    public function testInvalidDomains() {
        foreach($this->invalidDomains as $domain) {
            $this->assertFalse(UrlUtils::isValidDomain($domain));
        }
    }

}

?>
