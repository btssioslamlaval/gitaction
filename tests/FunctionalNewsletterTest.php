use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverBy;

public function testNewsletterAcceptsAdultWithValidEmail(): void
{
    $appUrl = $_ENV['APP_URL'] ?? getenv('APP_URL') ?: 'http://localhost:8000';
    $this->driver->get($appUrl);

    $this->driver->findElement(WebDriverBy::id('age'))->sendKeys("20");
    $this->driver->findElement(WebDriverBy::id('email'))->sendKeys("test@test.com");
    $this->driver->findElement(WebDriverBy::id('btn'))->click();

    // ✅ Attendre que #result soit visible avant de lire son contenu
    $this->driver->wait(10, 500)->until(
        WebDriverExpectedCondition::visibilityOfElementLocated(
            WebDriverBy::id('result')
        )
    );

    $result = $this->driver->findElement(WebDriverBy::id('result'))->getText();
    $this->assertEquals("Inscription acceptée", $result);
}