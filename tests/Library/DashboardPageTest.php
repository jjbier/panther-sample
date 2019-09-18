<?php

namespace App\Tests\Library;

use App\Tests\FunctionalTestCase;

class DashboardPageTest extends FunctionalTestCase
{

    public function testShowNews()
    {
        $client = self::createPantherClient();
        $crawler = $client->request('GET', '/admin/');
    }
}