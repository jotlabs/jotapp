<?php

include 'DefaultFeatureFlags.php';

class FeatureFlagsTest extends PHPUnit_Framework_TestCase {

    public function testDefaultFlags() {
        $flags = DefaultFeatureFlags::getInstance();
        $this->assertNotNull($flags);

        $this->assertTrue($flags->positiveFlag);
        $this->assertFalse($flags->negativeFlag);
        $this->assertNull($flags->undefinedFlag);

        $this->assertTrue(isset($flags->positiveFlag));
        $this->assertTrue(isset($flags->negativeFlag));
        $this->assertFalse(isset($flags->undefinedFlag));
    }

}

?>
