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
            'http://localhost:4444',
            DesiredCapabilities::chrome()
        );
    }

    protected function tearDown(): void
    {
        if ($this->driver) {
            $this->driver->quit();
        }
    }

    public function testNewsletterAcceptsAdultWithValidEmail(): void
    {
        $this->driver->get("http://host.docker.internal:8000");

        $this->driver->findElement(WebDriverBy::id('age'))->sendKeys("20");
        $this->driver->findElement(WebDriverBy::id('email'))->sendKeys("test@test.com");
        $this->driver->findElement(WebDriverBy::id('btn'))->click();

        $result = $this->driver->findElement(WebDriverBy::id('result'))->getText();

        $this->assertEquals("Inscription acceptée", $result);
    }
}