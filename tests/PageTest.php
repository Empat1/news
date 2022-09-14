<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PageTest extends WebTestCase
{
    public function testHomePage(): void
    {

        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertResponseStatusCodeSame(200);
        $this->assertPageTitleContains('Новостной сайт Черемисина.');
        $this->assertCount(5, $crawler->filter('.carousel-item'));
        $link = $crawler->selectLink('Главная страница')->link();
        $client->click($link);
        $this->assertResponseStatusCodeSame(200);
        $this->assertPageTitleContains('Домашняя страница');
    }

    public function testLogin(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $link = $crawler->selectLink('Login')->link();
        $client->click($link);
        $this->assertResponseStatusCodeSame(200);
        $this->assertPageTitleContains('Log in!');
        $falseUserData = ['_username' => 'Неправильный пользователь',
            '_password' => 'Неправильный пароль'];
        $client->submitForm('Авторизоваться', $falseUserData);
        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertSelectorTextContains('.alert.alert-danger', 'Invalid credentials.');
        $trueUserData = ['_username' => 'User1',
            '_password' => 'password1'];
        $client->submitForm('Авторизоваться', $trueUserData);
        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertPageTitleContains('Домашняя страница');
    }

}
