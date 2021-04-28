<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserUnitTest extends TestCase
{
    public function testIsTrue()
    {   
        $user = new User();

        $user->setEmail('true@test.be')
             ->setFirstname('firstname')
             ->setLastname('lastname')
             ->setPassword('password')
             ->setPseudo('pseudo')
             ->setPhoneNumber('0123456789');

        $this->assertTrue($user->getEmail() === 'true@test.be');
        $this->assertTrue($user->getFirstname() === 'firstname');
        $this->assertTrue($user->getLastname() === 'lastname');
        $this->assertTrue($user->getpassword() === 'password');
        $this->assertTrue($user->getPseudo() === 'pseudo');
        $this->assertTrue($user->getPhoneNumber() === '0123456789');
    }

    public function testIsFalse()
    {
        $user = new User();

        $user->setEmail('true@test.be')
             ->setFirstname('firstname')
             ->setLastname('lastname')
             ->setPassword('password')
             ->setPseudo('pseudo')
             ->setPhoneNumber('0123456789');

        $this->assertFalse($user->getEmail() === 'false@test.be');
        $this->assertFalse($user->getFirstname() === 'false');
        $this->assertFalse($user->getLastname() === 'false');
        $this->assertFalse($user->getpassword() === 'false');
        $this->assertFalse($user->getPseudo() === 'false');
        $this->assertFalse($user->getPhoneNumber() === 'false');
    }

    public function testIsEmpty()
    {
        $user = new User();

        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getFirstname());
        $this->assertEmpty($user->getLastname());
        $this->assertEmpty($user->getpassword());
        $this->assertEmpty($user->getPseudo());
        $this->assertEmpty($user->getPhoneNumber());
    }
}
