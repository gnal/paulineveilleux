<?php

namespace Msi\Bundle\PaintBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'Nom',
                'constraints' => new NotBlank(),
            ))
            ->add('email', 'email', array(
                'label' => 'Courriel',
                'constraints' => array(new NotBlank(), new Email()),
            ))
            ->add('message', 'textarea', array(
                'label' => 'Message',
                'constraints' => new NotBlank(),
            ))
        ;
    }

    public function getName()
    {
        return 'paint_contact';
    }
}
