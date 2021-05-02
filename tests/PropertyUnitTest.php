<?php

namespace App\Tests;

use App\Entity\Property;
use App\Entity\Stay;
use App\Entity\User;
use App\Entity\Option;
use DateTime;
use PHPUnit\Framework\TestCase;


class PropertyUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $property = new Property();
        $owner = new User();
        $datetime = new DateTime();
        $stay = new Stay(); 
        $option = new Option();


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
                 ->addStay($stay)
                 ->addOption($option);

        
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
        $this->assertContains($stay, $property->getStays());
        $this->assertContains($option, $property->getOptions());
    }

    public function testIsFalse()
    {
        $property = new Property();
        $owner = new User();
        $datetime = new DateTime();
        $stay = new Stay();
        $option = new Option();


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
            ->addStay($stay)
            ->addOption($option);



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
        $this->assertNotContains(new Stay(), $property->getStays());
        $this->assertNotContains(new Option, $property->getOptions());

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
        $this->assertEmpty($property->getStays());
        $this->assertEmpty($property->getOptions());
    }
}
