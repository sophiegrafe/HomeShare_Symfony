<?php

namespace App\Tests;

use App\Entity\Blogpost;
use App\Entity\Coment;
use App\Entity\Stay;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\MakerBundle\Str;

class UserUnitTest extends TestCase
{
    public function testIsTrue()
    {   
        $user = new User();
        $stay = new Stay();
        $blogpost = new Blogpost();
        $coment =new Coment();



        $user->setEmail('true@test.be')
             ->setFirstname('firstname')
             ->setLastname('lastname')
             ->setPassword('password')
             ->setPseudo('pseudo')
             ->setPhoneNumber('0123456789')
             ->addStay($stay)
             ->addBlogpost($blogpost)
             ->addComent($coment);

        $this->assertTrue($user->getEmail() === 'true@test.be');
        $this->assertTrue($user->getFirstname() === 'firstname');
        $this->assertTrue($user->getLastname() === 'lastname');
        $this->assertTrue($user->getpassword() === 'password');
        $this->assertTrue($user->getPseudo() === 'pseudo');
        $this->assertTrue($user->getPhoneNumber() === '0123456789');
        $this->assertContains($stay, $user->getStays());
        $this->assertContains($blogpost, $user->getBlogposts());
        $this->assertContains($coment, $user->getComents());
    }

    public function testIsFalse()
    {
        $user = new User();
        $stay = new Stay();
        $blogpost = new Blogpost();
        $coment = new Coment();

        $user->setEmail('true@test.be')
             ->setFirstname('firstname')
             ->setLastname('lastname')
             ->setPassword('password')
             ->setPseudo('pseudo')
             ->setPhoneNumber('0123456789')
             ->addStay($stay)
             ->addBlogpost($blogpost)
             ->addComent($coment);

        $this->assertFalse($user->getEmail() === 'false@test.be');
        $this->assertFalse($user->getFirstname() === 'false');
        $this->assertFalse($user->getLastname() === 'false');
        $this->assertFalse($user->getpassword() === 'false');
        $this->assertFalse($user->getPseudo() === 'false');
        $this->assertFalse($user->getPhoneNumber() === 'false');
        $this->assertNotContains(new Stay(), $user->getStays());
        $this->assertNotContains(new Blogpost(), $user->getBlogposts());
        $this->assertNotContains(new Coment(), $user->getComents());
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
        $this->assertEmpty($user->getStays());
        $this->assertEmpty($user->getBlogposts());
        $this->assertEmpty($user->getComents());
        
    }
}
