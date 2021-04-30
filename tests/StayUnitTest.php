<?php

namespace App\Tests;

use App\Entity\Stay;
use DateTime;
use PHPUnit\Framework\TestCase;

class StayUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $stay = new Stay();
        $datetimeStart = new DateTime();
        $datetimeEnd = new DateTime();

        $stay->setStartDate($datetimeStart)
             ->setEndDate($datetimeEnd)
             ->setScore(9.9)
             ->setComent('Coment');  
        
        $this->assertTrue($stay->getStartDate() === $datetimeStart);
        $this->assertTrue($stay->getEndDate() === $datetimeEnd);
        $this->assertTrue($stay->getScore() == 9.9);
        $this->assertTrue($stay->getComent() === 'Coment');
       
        
    }

    public function testIsFalse()
    {
        $stay = new Stay();
        $datetimeStart = new DateTime();
        $datetimeEnd = new DateTime();

        $stay->setStartDate($datetimeStart)
            ->setEndDate($datetimeEnd)
            ->setScore(9.9)
            ->setComent('Coment');

        $this->assertFalse($stay->getStartDate() === new DateTime());
        $this->assertFalse($stay->getEndDate() === new DateTime());
        $this->assertFalse($stay->getScore() === 0);
        $this->assertFalse($stay->getComent() === 'false');
       
      
    }

    public function testIsEmpty()
    {
        $stay = new Stay();

        $this->assertEmpty($stay->getStartDate());
        $this->assertEmpty($stay->getEndDate());
        $this->assertEmpty($stay->getScore());
        $this->assertEmpty($stay->getComent());
       
    }
}
