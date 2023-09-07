<?php
require_once __DIR__ . '/../utils/validation-functions.php';

use PHPUnit\Framework\TestCase;

class ValidationFunctionsTest extends TestCase {

    public function testValidateUsername() {
        $this->assertNull(validateUsername('JohnDoe'));
        $this->assertEquals('Username must be between 4 and 20 characters.', validateUsername('JD'));
    }

}
