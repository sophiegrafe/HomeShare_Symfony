<?php

use App\Entity\Blogpost;
use App\Entity\City;
use App\Entity\Property;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    
    private $security;    

    public function __construct(Security $security)
    {        
        $this->security = $security;       
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setDateAndUser']
        ];
    }

    public function setDateAndUser(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();
        
        if($entity instanceof Blogpost) {            
            $now = new DateTime('now');
            $entity->setCreatedDate($now);
            //get the current user
            $user = $this->security->getUser();
            $entity->setUser($user);
        }

        if ($entity instanceof Property) {
            $now = new DateTime('now');
            $entity->setCreatedDate($now);
            //get the current user
            $user = $this->security->getUser();
            $entity->setOwner($user);
        }  

        return;
        
    }
    
}