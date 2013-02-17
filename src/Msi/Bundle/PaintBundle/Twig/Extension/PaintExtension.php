<?php

namespace Msi\Bundle\PaintBundle\Twig\Extension;

class PaintExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            'numberformat' => new \Twig_Function_Method($this, 'format', array('is_safe' => array('html'))),
        );
    }

    public function format($value)
    {
        return str_pad($value, 7, '0', STR_PAD_LEFT);;
    }

    public function getName()
    {
        return 'msi_paint';
    }
}
