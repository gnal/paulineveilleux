<?php

namespace Msi\Bundle\PaintBundle\Admin;

use Msi\Bundle\CmfBundle\Admin\Admin;
use Msi\Bundle\CmfBundle\Grid\GridBuilder;
use Symfony\Component\Form\FormBuilder;

class ArtworkAdmin extends Admin
{
    public function buildGrid(GridBuilder $builder)
    {
        $builder
            ->add('published', 'boolean')
            ->add('title')
            ->add('filename', 'image')
            ->add('', 'action')
        ;
    }

    public function buildForm(FormBuilder $builder)
    {
        $builder
            ->add('file', 'file', array('data_class' => null))
            ->add('published')
            ->add('code')
            ->add('title')
            ->add('size')
            ->add('medium')
            ->add('year')
            ->add('price')
            ->add('sold')
        ;
    }
}
