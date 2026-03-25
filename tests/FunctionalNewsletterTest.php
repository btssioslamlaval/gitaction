<?php
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\WebDriverExpectedCondition;

final class FunctionalNewsletterTest extends TestCase
{
    private $driver;

    protected function setUp(): void
    {
        $seleniumUrl = $_ENV['SELENIUM_URL'] ?? getenv('SELENIUM_URL') ?: 'http://localhost:4444';

        $options = new ChromeOptions();
        $options->addArguments([
            '--headless',
            '--no-sandbox',
            '--disable-dev-shm-usage',
        ]);

        $capabilities = DesiredCapabilities::chrome();
        $capabilities->setCapability(ChromeOptions::CAPABILITY, $options);

        $this->driver = RemoteWebDriver::create($seleniumUrl, $capabilities);
    }

    protected function tearDown(): void
    {
        if ($this->driver) {
            $this->driver->quit();
        }
    }

    public function testNewsletterAcceptsAdultWithValidEmail(): void
    {
        $appUrl = $_ENV['APP_URL'] ?? getenv('APP_URL') ?: 'http://localhost:8000';
        $this->driver->get($appUrl);
        $this->driver->findElement(WebDriverBy::id('age'))->sendKeys("20");
        $this->driver->findElement(WebDriverBy::id('email'))->sendKeys("test@test.com");
        $this->driver->findElement(WebDriverBy::id('btn'))->click();

        $this->driver->wait(10, 500)->until(
            WebDriverExpectedCondition::visibilityOfElementLocated(
                WebDriverBy::id('result')
            )
        );

        $result = $this->driver->findElement(WebDriverBy::id('result'))->getText();
        $this->assertEquals("Inscription acceptée", $result);
    }
}