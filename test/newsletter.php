<?php
use PHPUnit\Framework\TestCase;

require __DIR__ . "/../src/Newsletter.php";

final class NewsletterTest extends TestCase
{
    public function testAdult(): void
    {
        $this->assertTrue(isAdult(18));
        $this->assertTrue(isAdult(25));
        $this->assertFalse(isAdult(17));
    }

    public function testEmail(): void
    {
        $this->assertTrue(isValidEmail("a@b.com"));
        $this->assertFalse(isValidEmail(""));
        $this->assertFalse(isValidEmail("pas-un-email"));
    }
}
