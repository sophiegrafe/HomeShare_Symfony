<?php

namespace App\Tests;

use App\Entity\Rating;
use PHPUnit\Framework\TestCase;

class RatingUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $rating = new Rating();

        $rating->setScore(9.9)
               ->setComment('Comment');
        
        
        $this->assertTrue($rating->getScore() == 9.9);
        $this->assertTrue($rating->getComment() === 'Comment');
       
        
    }

    public function testIsFalse()
    {
        $rating = new Rating();

        $rating->setScore(9.9)
               ->setComment('Comment');
        
       
        $this->assertFalse($rating->getScore() === 0);
        $this->assertFalse($rating->getComment() === 'false');
       
      
    }

    public function testIsEmpty()
    {
        $rating = new Rating();

        $this->assertEmpty($rating->getScore());
        $this->assertEmpty($rating->getComment());
       
    }
}
