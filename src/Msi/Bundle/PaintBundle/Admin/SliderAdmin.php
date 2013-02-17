<?php

namespace Msi\Bundle\PaintBundle\Admin;

use Msi\Bundle\CmfBundle\Admin\Admin;
use Msi\Bundle\CmfBundle\Grid\GridBuilder;
use Symfony\Component\Form\FormBuilder;

class SliderAdmin extends Admin
{
    public function configure()
    {
        $this->options = array(
            'child_property' => 'slides',
        );
    }

    public function buildGrid(GridBuilder $builder)
    {
        $builder
            ->add('name')
            ->add('', 'action')
        ;
    }

    public function buildForm(FormBuilder $builder)
    {
        if (!$this->getObject()->getId()) {
            $builder->add('name');
        }

        $builder
            ->add('pauseTime', 'integer', array('attr' => array(
                'data-help' => 'En millième de seconde. Par défaut : 3000.',
            )))
            ->add('slideSpeed', 'integer', array('attr' => array(
                'data-help' => 'En millième de seconde. Par défaut : 400.',
            )))
        ;
    }
}
