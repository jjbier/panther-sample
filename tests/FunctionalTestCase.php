<?php

namespace App\Tests;

use Symfony\Component\Panther\Client as PantherClient;
use Symfony\Component\Panther\PantherTestCase;

class FunctionalTestCase extends PantherTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->logIn();
    }

    protected static function createPantherClient(array $options = [], array $kernelOptions = []): PantherClient
    {
        return parent::createPantherClient(['external_base_uri' => 'https://console.xebook.es']);;
    }

    protected function logIn()
    {
        $client = self::createPantherClient();
        $crawler = $client->request('GET', '/');
        if($client->getCurrentURL() == 'https://sso.xebook.es:8443/casx/login?service=https%3A%2F%2Fconsole.xebook.es%2Fadmin%2F') {
            $usernameInput = $crawler->filter('input[id=username]');
            $passwordInput = $crawler->filter('input[id=password]');
            $loginButton   = $crawler->filter('input[name=submit]');
            $usernameInput->sendKeys($_ENV['CONSOLE_USERNAME']);
            $passwordInput->sendKeys($_ENV['CONSOLE_USERNAME']);
            $loginButton->click();
            $this->assertEquals('https://console.xebook.es/admin/', $client->getCurrentURL());
        }
    }
}