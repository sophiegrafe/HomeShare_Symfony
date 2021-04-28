<?php

namespace App\Tests;

use App\Entity\Blogpost;
use App\Entity\Coment;
use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;

class ComentUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $coment = new Coment();
        $datetime = new DateTime();
        $user = new User();
        $blogpost = new Blogpost();
        $reply = new Coment();

        $coment->setTitle('title')
            ->setContent('content')            
            ->setSlug('slug')
            ->setCreatedDate($datetime)
            ->setUser($user)
            ->setBlogpost($blogpost)            
            ->addReply($reply);
            
            


        $this->assertTrue($coment->getTitle() === 'title');
        $this->assertTrue($coment->getContent() === 'content');        
        $this->assertTrue($coment->getSlug() === 'slug');
        $this->assertTrue($coment->getCreatedDate() === $datetime);
        $this->assertTrue($coment->getUser() === $user);
        $this->assertTrue($coment->getBlogpost() === $blogpost);
        $this->assertContains($reply, $coment->getReplies());
    }

    public function testIsFalse()
    {
        $coment = new Coment();
        $datetime = new DateTime();
        $user = new User();
        $blogpost = new Blogpost();
        $reply = new Coment();

        $coment->setTitle('title')
            ->setContent('content')            
            ->setSlug('slug')
            ->setCreatedDate($datetime)
            ->setUser($user)
            ->setBlogpost($blogpost)
            ->addReply($reply);


        $this->assertFalse($coment->getTitle() === 'false');
        $this->assertFalse($coment->getContent() === 'false');        
        $this->assertFalse($coment->getSlug() === 'false');
        $this->assertFalse($coment->getCreatedDate() === new DateTime());
        $this->assertFalse($coment->getUser() === new User());
        $this->assertFalse($coment->getBlogpost() === new Blogpost());
        $this->assertNotContains(new Coment, $coment->getReplies());
    }

    public function testIsEmpty()
    {
        $coment = new Coment();

        $this->assertEmpty($coment->getTitle());
        $this->assertEmpty($coment->getContent());       
        $this->assertEmpty($coment->getSlug());
        $this->assertEmpty($coment->getCreatedDate());
        $this->assertEmpty($coment->getUser());
        $this->assertEmpty($coment->getBlogpost());
        $this->assertEmpty($coment->getReplies());
    }
}