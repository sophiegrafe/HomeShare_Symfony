<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\City;
use App\Entity\User;
use App\Entity\Coment;
use App\Entity\Address;
use App\Entity\Country;
use App\Entity\Blogpost;
use App\Entity\Property;
use DateTime;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // Using the factory to create a Faker\Generator instance
        $faker = Faker\Factory::create();
        // to always get the same generated data
        $faker->seed(42);

        // Generate users        
            $user = new User();

            $user->setEmail('user@test.com')
                 ->setFirstname($faker->firstName())
                 ->setLastname($faker->lastName())
                 ->setPseudo($faker->userName())
                 ->setPhoneNumber($faker->phoneNumber());
            // Generate a hashed password
            $password = $this->encoder->encodePassword($user, 'password');
            $user->setPassword($password);

            $manager->persist($user);

            for ($i = 0; $i < 50; $i++) {
            $user = new User();

            $user->setEmail($faker->email())
                 ->setFirstname($faker->firstName())
                 ->setLastname($faker->lastName())
                 ->setPseudo($faker->userName())
                 ->setPhoneNumber($faker->phoneNumber());
            // Generate a hashed password
            $password = $this->encoder->encodePassword($user, 'password');
            $user->setPassword($password);

            $manager->persist($user);
            }  
        
            //Generate Addresses, cities and countries
        
        // to maintain relation in DB
        for ($i = 0; $i < 10; $i++){
            
            // Generate a country
            $country = new Country();
            $faker->addProvider(new Faker\Provider\fr_FR\Address($faker));          
            $country->setCountryName($faker->country());
            $manager->persist($country);        
            
            //Generate cities related to this country
            for ($j = 0; $j < 5; $j++) {
                $city = new City();
                $faker->addProvider(new Faker\Provider\fr_FR\Address($faker));
                $city->setCityName($faker->city())
                     ->setLatitude($faker->latitude())
                     ->setLongitude($faker->longitude())
                     ->setCountry($country);
                $manager->persist($city);
                for ($k = 0; $k < 3; $k++) {
                    // Generate 3 address for each city
                    $address = new Address();
                    $faker->addProvider(new Faker\Provider\fr_FR\Address($faker));
                    $address->setNumber($faker->buildingNumber())
                        ->setStreet($faker->streetName())
                        ->setZipcode($faker->postcode())
                        ->setCity($city);
                    $manager->persist($address);

                    // Generate a user who own the property at that address
                    $user = new User();
                    $user->setEmail($faker->email())
                         ->setFirstname($faker->firstName())
                         ->setLastname($faker->lastName())
                         ->setPseudo($faker->userName())
                         ->setPhoneNumber($faker->phoneNumber());
                    // Generate a hashed password
                    $password = $this->encoder->encodePassword($user, 'password');
                    $user->setPassword($password);

                    $manager->persist($user);                

                    // Generate a property
                    $property = new Property();
                    $property->setTitle($faker->words(10, true))
                             ->setShortDescription($faker->paragraph())
                             ->setLongDescription($faker->text())
                             ->setPhoto($faker->imageUrl(640, 480, 'house', true, 'tiny'))
                             ->setCapacity($faker->numberBetween(1,15))
                             ->setNbBathroom($faker->numberBetween(1, 10))
                             ->setNbWc($faker->numberBetween(1, 5))
                             ->setIsEnable($faker->boolean(50))
                             ->setCreatedDate($faker->dateTimeBetween('-2 years', 'now'))
                             ->setSlug($faker->slug())
                             ->setOwner($user)
                             ->setAddress($address);
                    $manager->persist($property);

                    // Generate a blogpost writed by the owner tha promote the place where the property is localize
                    $blogpost = new Blogpost();
                    $blogpost->setTitle($faker->words(10, true))
                             ->setContent($faker->text(1000))
                             ->setPhoto($faker->imageUrl(640, 480, 'city', true, 'capital'))
                             ->setCreatedDate($faker->dateTimeBetween('-1 day', 'now'))
                             ->setSlug($faker->slug())
                             ->setUser($user)
                             ->setCity($city);
                    

                    // Generate a new user who will write a coment on the blogpost
                    $newUser = new User();
                    $newUser->setEmail($faker->email())
                            ->setFirstname($faker->firstName())
                            ->setLastname($faker->lastName())
                            ->setPseudo($faker->userName())
                            ->setPhoneNumber($faker->phoneNumber());
                    // Generate a hashed password
                    $password = $this->encoder->encodePassword($newUser, 'password');
                    $newUser->setPassword($password);
                    $manager->persist($newUser);

                    // Generate the coment
                    $coment = new Coment();
                    $coment->setTitle($faker->words(10, true))
                           ->setContent($faker->text(250))
                           ->setCreatedDate(new DateTime())
                           ->setSlug($faker->slug())
                           ->setUser($newUser)
                           ->setBlogpost($blogpost);

                    // Generate a reply from the owner
                    $reply = new Coment();
                    $reply->setTitle($faker->words(10, true))
                          ->setContent($faker->text(250))
                          ->setCreatedDate(new DateTime())
                          ->setSlug($faker->slug())
                          ->setUser($user)
                          ->setBlogpost($blogpost);
                    
                    $blogpost->addComent($coment);
                    $manager->persist($blogpost);
                          
                    $coment->addReply($reply);
                    $manager->persist($coment);
                    $manager->persist($reply);                           
                }                
            }            
        }      

        $manager->flush();
    }
}