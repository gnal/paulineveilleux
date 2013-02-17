<?php

namespace Msi\Bundle\PaintBundle\Admin;

use Msi\Bundle\CmfBundle\Admin\Admin;
use Msi\Bundle\CmfBundle\Grid\GridBuilder;
use Symfony\Component\Form\FormBuilder;
use Msi\Bundle\PaintBundle\Form\Type\GalleryTranslationType;

class GalleryAdmin extends Admin
{
    public function configure()
    {
        $this->options = array(
            'child_property' => 'artworks',
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
        $builder
            ->add('translations', 'collection', array('label' => ' ', 'type' => new GalleryTranslationType(), 'options' => array(
                'label' => ' ',
            )))
        ;
    }
}
