<?php

namespace Msi\Bundle\PaintBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArtworkController extends ContainerAware
{
    public function indexAction(Request $request)
    {
        $gallery = $this->container->get('msi_paint.gallery_manager')->getFindByQueryBuilder(
            array('t.published' => true, 't.slug' => $request->attributes->get('slug')),
            array('a.translations' => 't')
        )->getQuery()->getOneOrNullResult();

        if (!$gallery) {
            throw new NotFoundHttpException();
        }

        $artworks = $this->container->get('msi_paint.artwork_manager')->getFindByQueryBuilder(
            array('a.published' => true, 'a.gallery' => $gallery),
            array(),
            array('a.code' => 'DESC')
        )->getQuery()->execute();

        return $this->container->get('templating')->renderResponse('MsiPaintBundle:Artwork:index.html.twig', array('gallery' => $gallery, 'artworks' => $artworks));
    }
}
