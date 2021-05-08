<?php

use App\Entity\Blogpost;
use App\Entity\City;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $slugger;
    private $security;    

    public function __construct(SluggerInterface $slugger, Security $security)
    {
        $this->slugger = $slugger;
        $this->security = $security;       
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setBlogpostSlugAndDateAndUserAndCity']
        ];
    }

    public function setBlogpostSlugAndDateAndUserAndCity(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();
        if(!($entity instanceof Blogpost)) {
            return;
        }

        $slug = $this->slugger->slug($entity->getTitle());
        $entity->setSlug($slug);

        $now = new DateTime('now');
        $entity->setCreatedDate($now);
        
        

        //get the current user
        $user = $this->security->getUser();
        $entity->setUser($user);
    }
    
}