<?php

namespace Msi\Bundle\PaintBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Msi\Bundle\PaintBundle\Form\Type\ContactType;

class ContactController extends ContainerAware
{
    public function newAction(Request $request)
    {
        $form = $this->container->get('form.factory')->create(new ContactType());

        if ($this->container->get('msi_paint.contact_form_handler')->process($form)) {
            $message = \Swift_Message::newInstance()
                ->setSubject('Formulaire de contact')
                ->setFrom('noreply@paulineveilleux.com')
                ->setTo('pauline.veilleux@gmail.com')
                ->setBody($this->container->get('templating')->render('MsiPaintBundle:Contact:email.html.twig', array('form' => $form->getData())), 'text/html')
            ;
            $this->container->get('mailer')->send($message);

            return new RedirectResponse($this->container->get('router')->generate('msi_paint_contact_new'));
        }

        return $this->container->get('templating')->renderResponse('MsiPaintBundle:Contact:new.html.twig', array('form' => $form->createView()));
    }
}
