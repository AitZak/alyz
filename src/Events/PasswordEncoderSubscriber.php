<?php

namespace App\Events;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordEncoderSubscriber implements EventSubscriberInterface
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public static function getSubscribedEvents()
    {
    return [
    KernelEvents::VIEW => ['encodePassword', EventPriorities::PRE_WRITE]
    ];
    }
    
    public function encodePassword(ViewEvent $event) {
    $user = $event->getControllerResult();
    //dd($user);
    
    $method = $event->getRequest()->getMethod();//POST,GET,PUT..
    
    if($user instanceof User && $method === "POST") {
    //dd($user);
    $hash = $this->encoder->encodePassword($user, $user->getPassword());
    $user->setPassword($hash);
    }
    }
    
}