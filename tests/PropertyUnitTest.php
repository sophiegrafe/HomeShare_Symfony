<?php

namespace App\Tests;

use App\Entity\Property;
use App\Entity\Rating;
use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;


class PropertyUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $property = new Property();
        $datetime = new DateTime();
        $rating = new Rating();
        $owner = new User();


        $property->setTitle('Title')
                 ->setShortDescription('Short Description')
                 ->setLongDescription('Long Description')
                 ->setCapacity(0)
                 ->setNbBathroom(0)
                 ->setNbWc(0)
                 ->setIsEnable(true)
                 ->setCreatedDate($datetime)
                 ->setSlug('slug')
                 ->setPhoto('/photo')
                 ->setOwner($owner)
                 ->addRating($rating);

        
        $this->assertTrue($property->getTitle() === 'Title');
        $this->assertTrue($property->getShortDescription() === 'Short Description');
        $this->assertTrue($property->getLongDescription() === 'Long Description');
        $this->assertTrue($property->getCapacity() == 0);
        $this->assertTrue($property->getNbBathroom() == 0);
        $this->assertTrue($property->getNbWc() == 0);
        $this->assertTrue($property->getIsEnable() === true);
        $this->assertTrue($property->getCreatedDate() === $datetime);
        $this->assertTrue($property->getSlug() === 'slug');
        $this->assertTrue($property->getPhoto() === '/photo');
        $this->assertTrue($property->getOwner() === $owner);
        $this->assertContains($rating, $property->getRatings());
    }

    public function testIsFalse()
    {
        $property = new Property();
        $datetime = new DateTime();
        $rating = new Rating();
        $owner = new User();


        $property->setTitle('Title')
            ->setShortDescription('Short Description')
            ->setLongDescription('Long Description')
            ->setCapacity(0)
            ->setNbBathroom(0)
            ->setNbWc(0)
            ->setIsEnable(true)
            ->setCreatedDate($datetime)
            ->setSlug('slug')
            ->setPhoto('/photo')
            ->setOwner($owner)
            ->addRating($rating);


        $this->assertFalse($property->getTitle() === 'false');
        $this->assertFalse($property->getShortDescription() === 'false');
        $this->assertFalse($property->getLongDescription() === 'false');
        $this->assertFalse($property->getCapacity() == 1);
        $this->assertFalse($property->getNbBathroom() == 1);
        $this->assertFalse($property->getNbWc() == 1);
        $this->assertFalse($property->getIsEnable() === False);
        $this->assertFalse($property->getCreatedDate() === new DateTime());
        $this->assertFalse($property->getSlug() === 'false');
        $this->assertFalse($property->getPhoto() === '/false');
        $this->assertFalse($property->getOwner() === new User);
        $this->assertNotContains(new Rating(), $property->getRatings());
    }

    public function testIsEmpty()
    {
        $property = new Property();
        

        $this->assertEmpty($property->getTitle());
        $this->assertEmpty($property->getShortDescription());
        $this->assertEmpty($property->getLongDescription());
        $this->assertEmpty($property->getCapacity());
        $this->assertEmpty($property->getNbBathroom());
        $this->assertEmpty($property->getNbWc());
        $this->assertEmpty($property->getIsEnable());
        $this->assertEmpty($property->getCreatedDate());
        $this->assertEmpty($property->getSlug());
        $this->assertEmpty($property->getPhoto());
        $this->assertEmpty($property->getOwner());
        $this->assertEmpty($property->getRatings());
    }
}
