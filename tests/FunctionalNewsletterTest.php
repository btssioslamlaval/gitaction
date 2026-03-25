<?php
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;

final class FunctionalNewsletterTest extends TestCase
{
    private $driver;

    protected function setUp(): void
    {
        $this->driver = RemoteWebDriver::create(
            'http://selenuim:4444/wd/hub',
            DesiredCapabilities::chrome()
        );
    }

    protected function tearDown(): void
    {
        $this->driver->quit();
    }

    public function testNewsletterAcceptsAdultWithValidEmail()
    {
        $this->driver->get("http://localhost:8000");

        $this->driver->findElement(WebDriverBy::id('age'))->sendKeys("20");
        $this->driver->findElement(WebDriverBy::id('email'))->sendKeys("test@test.com");
        $this->driver->findElement(WebDriverBy::id('btn'))->click();

        $result = $this->driver->findElement(WebDriverBy::id('result'))->getText();

        $this->assertEquals("Inscription acceptée", $result);
    }
}
