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
use PHPUnit\Framework\Constraint\Count;
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
        // Create a Faker\Generator instance
        $faker = Faker\Factory::create('fr_FR');
        // Get the same set of data !!!!! ça n'a pas l'air de fonctionner :/
        $faker->seed(1234);
        

        $country0 = new Country();
        $country0->setCountryName('Belgium');        
        $country1 = new Country();
        $country1->setCountryName('France');
        $country2 = new Country();
        $country2->setCountryName('Italie');
        $country3 = new Country();
        $country3->setCountryName('Espagne');
        $country4 = new Country();
        $country4->setCountryName('Luxembourg');
        $country5 = new Country();
        $country5->setCountryName('Pays-bas');
        $country6 = new Country();
        $country6->setCountryName('Ireland');

        $manager->persist($country0);
        $manager->persist($country1);
        $manager->persist($country2);
        $manager->persist($country3);
        $manager->persist($country4);
        $manager->persist($country5);
        $manager->persist($country6);

        $city0 = new City();
        $city0->setCityName('Brussel');
        $city0->setCountry($country0);
        $city1 = new City();
        $city1->setCityName('Paris');
        $city1->setCountry($country1);
        $city2 = new City();
        $city2->setCityName('Rome');
        $city2->setCountry($country2);
        $city3 = new City();
        $city3->setCountry($country3);
        $city3->setCityName('Madrid');
        $city4 = new City();
        $city4->setCountry($country4);
        $city4->setCityName('Luxembourg');
        $city5 = new City();
        $city5->setCountry($country5);
        $city5->setCityName('Amsterdam');
        $city6 = new City();
        $city6->setCountry($country6);
        $city6->setCityName('Belfast');

        $manager->persist($city0);
        $manager->persist($city1);
        $manager->persist($city2);
        $manager->persist($city3);
        $manager->persist($city4);
        $manager->persist($city5);
        $manager->persist($city6);

        // Generate user with admin role       
        $admin = new User();

        $admin->setEmail('admin@test.com')
                 ->setFirstname($faker->firstName())
                 ->setLastname($faker->lastName())
                 ->setPseudo($faker->userName())
                 ->setPhoneNumber($faker->phoneNumber())
                 ->setCity($city0)
                 ->setCountry($country0)
                 ->setRoles(['ROLE_ADMIN']);
            // Generate a hashed password
            $password = $this->encoder->encodePassword($admin, 'password');
            $admin->setPassword($password);
            $manager->persist($admin);

            // Generate a user to test user_role
            $user = new User();

            $user->setEmail('user@test.com')
                ->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setPseudo($faker->userName())
                ->setCity($city0)
                ->setCountry($country0)
                ->setPhoneNumber($faker->phoneNumber())
                ->setRoles(['ROLE_USER']);
            // Generate a hashed password
            $password = $this->encoder->encodePassword($user, 'password');
            $user->setPassword($password);
            $manager->persist($user);

            // Generate a owner to test owner_role  
            $owner = new User();

            $owner->setEmail('owner@test.com')
                ->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setPseudo($faker->userName())
                ->setCity($city0)
                ->setCountry($country0)
                ->setPhoneNumber($faker->phoneNumber())
                ->setRoles(['ROLE_USER']);
            // Generate a hashed password
            $password = $this->encoder->encodePassword($owner, 'password');
            $owner->setPassword($password);
            $manager->persist($owner);

            //Generate some users
            for ($i = 0; $i < 10; $i++) {
            $user = new User();

            $user->setEmail($faker->email())
                 ->setFirstname($faker->firstName())
                 ->setLastname($faker->lastName())
                 ->setPseudo($faker->userName())
                 ->setCity($city2)
                 ->setCountry($country2)
                 ->setPhoneNumber($faker->phoneNumber())
                 ->setRoles(['ROLE_USER']);
            // Generate a hashed password
            $password = $this->encoder->encodePassword($user, 'password');
            $user->setPassword($password);
            $manager->persist($user);
            }
        //Generate some users
        for ($i = 0; $i < 10; $i++) {
            $user = new User();

            $user->setEmail($faker->email())
                ->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setPseudo($faker->userName())
                ->setCity($city3)
                ->setCountry($country3)
                ->setPhoneNumber($faker->phoneNumber())
                ->setRoles(['ROLE_USER']);
            // Generate a hashed password
            $password = $this->encoder->encodePassword($user, 'password');
            $user->setPassword($password);
            $manager->persist($user);
        }
        //Generate some users
        for ($i = 0; $i < 10; $i++) {
            $user = new User();

            $user->setEmail($faker->email())
                ->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setPseudo($faker->userName())
                ->setCity($city4)
                ->setCountry($country4)
                ->setPhoneNumber($faker->phoneNumber())
                ->setRoles(['ROLE_USER']);
            // Generate a hashed password
            $password = $this->encoder->encodePassword($user, 'password');
            $user->setPassword($password);
            $manager->persist($user);
        }
        //Generate some users
        for ($i = 0; $i < 10; $i++) {
            $user = new User();

            $user->setEmail($faker->email())
                ->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setPseudo($faker->userName())
                ->setCity($city5)
                ->setCountry($country5)
                ->setPhoneNumber($faker->phoneNumber())
                ->setRoles(['ROLE_USER']);
            // Generate a hashed password
            $password = $this->encoder->encodePassword($user, 'password');
            $user->setPassword($password);
            $manager->persist($user);
        }
        //Generate some users
        for ($i = 0; $i < 10; $i++) {
            $user = new User();

            $user->setEmail($faker->email())
                ->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setPseudo($faker->userName())
                ->setCity($city6)
                ->setCountry($country6)
                ->setPhoneNumber($faker->phoneNumber())
                ->setRoles(['ROLE_USER']);
            // Generate a hashed password
            $password = $this->encoder->encodePassword($user, 'password');
            $user->setPassword($password);
            $manager->persist($user);
        } 
        
        /*Generate Addresses, cities and countries, blogposts, properties, owner and coments ... to maintain relations in DB*/
        
        
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
                    // Generate 3 addresses for each city
                    $address = new Address();
                    $faker->addProvider(new Faker\Provider\fr_FR\Address($faker));
                    $address->setNumber($faker->buildingNumber())
                        ->setStreet($faker->streetName())
                        ->setZipcode($faker->postcode())
                        ->setCity($city)
                        ->setCountry($country);
                    $manager->persist($address);

                    // Generate an owner for the property at this address
                    $owner = new User();
                    $owner->setEmail($faker->email())
                         ->setFirstname($faker->firstName())
                         ->setLastname($faker->lastName())
                         ->setPseudo($faker->userName())
                         ->setCity($city)
                         ->setCountry($country)
                         ->setPhoneNumber($faker->phoneNumber())
                         ->setRoles(['ROLE_USER', 'ROLE_OWNER']);
                    // Generate a hashed password
                    $password = $this->encoder->encodePassword($owner, 'password');
                    $owner->setPassword($password);

                    $manager->persist($owner);                

                    // Generate a property
                    $property = new Property();
                    $property->setTitle($faker->words(10, true))
                             ->setShortDescription($faker->paragraph())
                             ->setLongDescription($faker->text())
                             ->setPhoto('assets/img/properties/tiny-house-'.(string)($k + 1).'.jpg')
                             ->setCapacity($faker->numberBetween(1,15))
                             ->setNbBathroom($faker->numberBetween(1, 10))
                             ->setNbWc($faker->numberBetween(1, 5))
                             ->setIsEnable($faker->boolean(50))
                             ->setCreatedDate($faker->dateTimeBetween('-2 years', 'now'))
                             ->setSlug($faker->slug())
                             ->setOwner($owner)
                             ->setCity($city)
                             ->setCountry($country)
                             ->setAddress($address);
                    $manager->persist($property);

                    // Generate a blogpost wrote by a owner that promote the city where the property is located
                    $blogpost = new Blogpost();
                    $blogpost->setTitle($faker->words(10, true))
                             ->setContent($faker->text(1000))
                             ->setPhoto($faker->imageUrl(640, 480, 'city', true, 'capital'))
                             ->setCreatedDate($faker->dateTimeBetween('-1 day', 'now'))
                             ->setSlug($faker->slug())
                             ->setUser($owner)
                             ->setCity($city);                    

                    // Generate a new user who will write a coment on the blogpost
                    $newUser = new User();
                    $newUser->setEmail($faker->email())
                            ->setFirstname($faker->firstName())
                            ->setLastname($faker->lastName())
                            ->setCity($city)
                            ->setCountry($country)
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
                          ->setUser($owner)
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