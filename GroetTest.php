<?php

namespace App;

require_once './vendor/autoload.php';

use Mockery;
use PHPUnit\Framework\TestCase;

class GroetTest extends TestCase
{
    public function testGroetNaam()
    {
        require_once 'Groet.php';
        $input = 'Johnny';
        $mock = Mockery::mock('Groet');
        $mock->expects()
            ->greet($input)
            ->andReturn('Hallo Johnny.');
        $this->assertEquals('Hallo Johnny.', $mock->greet($input));
    }
    public function testGroetVriend()
    {
        require_once 'Groet.php';
        $input = null;
        $mock = Mockery::mock('Groet');
        $mock->expects()
            ->greet($input)
            ->andReturn('Hallo vriend.');
        $this->assertEquals('Hallo vriend.', $mock->greet($input));
    }
    public function testGroetCap()
    {
        require_once 'Groet.php';
        $input = 'HOMER';
        $mock = Mockery::mock('Groet');
        $mock->expects()
            ->greet($input)
            ->andReturn('HALLO HOMER!');
        $this->assertEquals('HALLO HOMER!', $mock->greet($input));
    }
    public function testGroetGroepTwo()
    {
        require_once 'Groet.php';
        $input = ['Homer', 'Jerry', 'Harry'];
        $mock = Mockery::mock('Groet');
        $mock->expects()
            ->greet($input)
            ->andReturn('Hallo Homer en Jerry.');
        $this->assertEquals('Hallo Homer en Jerry.', $mock->greet($input));
    }
    public function testGroetGroepMoreThanTwo()
    {
        require_once 'Groet.php';
        $input = ['Homer', 'Jerry', 'Harry'];
        $mock = Mockery::mock('Groet');
        $mock->expects()
            ->greet($input)
            ->andReturn('Hallo Homer, Jerry en Harry.');
        $this->assertEquals('Hallo Homer, Jerry en Harry.', $mock->greet($input));
    }
    public function testGroetGroepMoreThanTwoCapNoCap()
    {
        require_once 'Groet.php';
        $input = ['Homer', 'Jerry', 'Harry', 'MAN', 'TEST'];
        $mock = Mockery::mock('Groet');
        $mock->expects()
            ->greet($input)
            ->andReturn('Hallo Homer, Jerry en Harry. EN HALLO MAN EN TEST!');
        $this->assertEquals('Hallo Homer, Jerry en Harry. EN HALLO MAN EN TEST!', $mock->greet($input));
    }
    public function testGroetKommaInString()
    {
        require_once 'Groet.php';
        $mock = Mockery::mock('Groet');
        $input = ['Homer, Jerry', 'Harry', 'MAN', 'TEST'];
        $mock = Mockery::mock('Groet');
        $mock->expects()
            ->greet($input)
            ->andReturn('Hallo Homer, Jerry en Harry. EN HALLO MAN EN TEST!');
        $this->assertEquals('Hallo Homer, Jerry en Harry. EN HALLO MAN EN TEST!', $mock->greet($input));
    }
}