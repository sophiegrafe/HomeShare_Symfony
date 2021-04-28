<?php

namespace App\Tests;

use App\Entity\Blogpost;
use DateTime;
use PHPUnit\Framework\TestCase;

class BlogpostUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $blogpost = new Blogpost();
        $datetime = new DateTime();

        $blogpost->setTitle('title')
                 ->setContent('content')
                 ->setPhoto('/photo')
                 ->setSlug('slug')
                 ->setCreatedDate($datetime);


        $this->assertTrue($blogpost->getTitle() === 'title');
        $this->assertTrue($blogpost->getContent() === 'content');
        $this->assertTrue($blogpost->getPhoto() === '/photo');
        $this->assertTrue($blogpost->getSlug() === 'slug');
        $this->assertTrue($blogpost->getCreatedDate() === $datetime);
    }

    public function testIsFalse()
    {
        $blogpost = new Blogpost();
        $datetime = new DateTime();

        $blogpost->setTitle('title')
                 ->setContent('content')
                 ->setPhoto('/photo')
                 ->setSlug('slug')
                 ->setCreatedDate($datetime);


        $this->assertFalse($blogpost->getTitle() === 'false');
        $this->assertFalse($blogpost->getContent() === 'false');
        $this->assertFalse($blogpost->getPhoto() === '/false');
        $this->assertFalse($blogpost->getSlug() === 'false');
        $this->assertFalse($blogpost->getCreatedDate() === new DateTime());
    }

    public function testIsEmpty()
    {
        $blogpost = new Blogpost();

        $this->assertEmpty($blogpost->getTitle());
        $this->assertEmpty($blogpost->getContent());
        $this->assertEmpty($blogpost->getPhoto());
        $this->assertEmpty($blogpost->getSlug());
        $this->assertEmpty($blogpost->getCreatedDate());
    }
}
