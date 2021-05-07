<?php

namespace App\Tests;

use DateTime;
use App\Entity\City;
use App\Entity\User;
use App\Entity\Coment;
use App\Entity\Blogpost;
use PHPUnit\Framework\TestCase;

class BlogpostUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $blogpost = new Blogpost();
        $datetime = new DateTime();
        $user = new User();
        $city = new City();

        $blogpost->setTitle('title')
                 ->setContent('content')
                 ->setPhoto('/photo')
                 ->setSlug('slug')
                 ->setCreatedDate($datetime)
                 ->setUser($user)
                 ->setCity($city);

        $this->assertTrue($blogpost->getTitle() === 'title');
        $this->assertTrue($blogpost->getContent() === 'content');
        $this->assertTrue($blogpost->getPhoto() === '/photo');
        $this->assertTrue($blogpost->getSlug() === 'slug');
        $this->assertTrue($blogpost->getCreatedDate() === $datetime);
        $this->assertTrue($blogpost->getUser() === $user);
        $this->assertTrue($blogpost->getCity() === $city);
    }

    public function testIsFalse()
    {
        $blogpost = new Blogpost();
        $datetime = new DateTime();
        $user = new User();
        $city = new City();

        $blogpost->setTitle('title')
                 ->setContent('content')
                 ->setPhoto('/photo')
                 ->setSlug('slug')
                 ->setCreatedDate($datetime)
                 ->setUser($user)
                 ->setCity($city);

        $this->assertFalse($blogpost->getTitle() === 'false');
        $this->assertFalse($blogpost->getContent() === 'false');
        $this->assertFalse($blogpost->getPhoto() === '/false');
        $this->assertFalse($blogpost->getSlug() === 'false');
        $this->assertFalse($blogpost->getCreatedDate() === new DateTime());
        $this->assertFalse($blogpost->getUser() === new User());
        $this->assertFalse($blogpost->getCity() === new City());
    }

    public function testIsEmpty()
    {
        $blogpost = new Blogpost();

        $this->assertEmpty($blogpost->getTitle());
        $this->assertEmpty($blogpost->getContent());
        $this->assertEmpty($blogpost->getPhoto());
        $this->assertEmpty($blogpost->getSlug());
        $this->assertEmpty($blogpost->getCreatedDate());
        $this->assertEmpty($blogpost->getId());
        $this->assertEmpty($blogpost->getUser());
        $this->assertEmpty($blogpost->getCity());
    }

    public function testAddGetRemoveComent()
    {
        $blogpost = new Blogpost();
        $coment = new Coment();

        $this->assertEmpty($blogpost->getComents());

        $blogpost->addComent($coment);
        $this->assertContains($coment, $blogpost->getComents());

        $blogpost->removeComent($coment);
        $this->assertEmpty($blogpost->getComents());
    }
}
