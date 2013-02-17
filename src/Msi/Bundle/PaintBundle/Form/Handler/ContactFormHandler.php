<?php

namespace Msi\Bundle\PaintBundle\Form\Handler;

class ContactFormHandler
{
    protected $request;
    protected $templating;

    public function __construct($request, $templating)
    {
        $this->request = $request;
        $this->templating = $templating;
    }

    public function process($form)
    {
        if ($this->request->getMethod() === 'POST') {
            $form->bindRequest($this->request);

            if ($form->isValid()) {
                return true;
            }
        }

        return false;
    }
}
