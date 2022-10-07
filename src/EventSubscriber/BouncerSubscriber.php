<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Interfaces\Bouncer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class BouncerSubscriber implements EventSubscriberInterface
{
    public function onKernelController(ControllerEvent $event): void
    {
        $controller = $event->getController();
        $request = $event->getRequest();

        if ($controller instanceof Bouncer) {
            if ($request->headers->get('x-auth-token') !== $_ENV['X_AUTH_TOKEN']) {
                throw new AccessDeniedHttpException('Unauthorized access');
            }
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}
