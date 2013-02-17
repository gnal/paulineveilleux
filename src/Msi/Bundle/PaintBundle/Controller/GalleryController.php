<?php

namespace Msi\Bundle\PaintBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;

class GalleryController extends ContainerAware
{
    public function indexAction(Request $request)
    {
        $galleries = $this->container->get('msi_paint.gallery_manager')->getFindByQueryBuilder(
            array('t.published' => true, 'w.published' => true),
            array('a.translations' => 't', 'a.artworks' => 'w'),
            array('a.position' => 'ASC')
        )->getQuery()->execute();

        return $this->container->get('templating')->renderResponse('MsiPaintBundle:Gallery:index.html.twig', array('galleries' => $galleries));
    }
}
