<?php

namespace App\EventSubscribers;

use DateTime;
use App\Entity\Blogpost;
use App\Entity\Property;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;

class EasyAdminSubscriber implements EventSubscriberInterface
{   
    /**
     * @var Security
     */    
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
            $entity->setCreatedDate(new DateTime('now'));
            //get the current logged user            
            $entity->setUser($this->security->getUser());

        }elseif($entity instanceof Property) {
            $entity->setCreatedDate(new DateTime('now'));           
            $entity->setOwner($this->security->getUser());
        }        
        return;
        
    }
    
}