<?php

namespace App\Tests;
use Symfony\Component\Panther\PantherTestCase;

class LoginPageTest extends PantherTestCase
{
    public function testLogin()
    {
        $client = static::createPantherClient(['external_base_uri' => 'https://console.xebook.es']);
        $crawler = $client->request('GET', '/');
        $this->assertEquals('https://sso.xebook.es:8443/casx/login?service=https%3A%2F%2Fconsole.xebook.es%2Fadmin%2F', $client->getCurrentURL());
        $usernameInput = $crawler->filter('input[id=username]');
        $passwordInput = $crawler->filter('input[id=password]');
        $loginButton   = $crawler->filter('input[name=submit]');
        $usernameInput->sendKeys($_ENV['CONSOLE_USERNAME']);
        $passwordInput->sendKeys($_ENV['CONSOLE_USERNAME']);
        $loginButton->click();
        $this->assertEquals('https://console.xebook.es/admin/', $client->getCurrentURL());
    }
}
