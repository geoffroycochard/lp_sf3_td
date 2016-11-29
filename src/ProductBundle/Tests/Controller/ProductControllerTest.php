<?php

namespace ProductBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'products');
    }

    public function testSingle()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'product');
    }

}
