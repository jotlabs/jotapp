<?php

use JotApp\Utils\PasswordUtils;

class PasswordUtilsTest extends PHPUnit_Framework_TestCase {

    public function testHashPassword() {
        $password = 'qwertyuiop';
        $expect   = '$P$';

        $hash = PasswordUtils::hashPassword($password);
        $this->assertEquals($expect, substr($hash, 0, 3));
    }

    public function testCheckPassword() {
        $password = 'qwertyuiop';
        $expected = '$P$Dw8lpGa7PGLJtJir8IjcYSalRHKxkj.';
        $this->assertTrue(PasswordUtils::checkPassword($password, $expected));
    }

}

?>
