<?php

namespace Msi\Bundle\PaintBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class RequestListener
{
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        if ($event->getRequestType() === HttpKernelInterface::MASTER_REQUEST) {
            if (!$request->getSession()->has('count')) {
                $file = fopen($_SERVER['DOCUMENT_ROOT'].'/counter.txt', 'r+');
                $count = fgets($file);
                $count = intval($count) + 1;
                fseek($file, 0);
                fputs($file, $count);
                fclose($file);
                $request->getSession()->set('count', $count);
            } else {
                $request->getSession()->set('count', fgets(fopen($_SERVER['DOCUMENT_ROOT'].'/counter.txt', 'r+')));
            }
        }
    }
}
