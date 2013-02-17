<?php

namespace Msi\Bundle\PaintBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Msi\Bundle\CmfBundle\Entity\PageBlock;

class LoadPageBlockData extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface
{
    protected $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $block = new PageBlock();
        $block
            ->setName('slider accueil')
            ->setType('action')
            ->setSetting('action', 'MsiPaintBundle:Slider:show')
            ->setSetting('slot', 'content')
            ->setSetting('attributes', 'name=accueil')
            ->createTranslations('Msi\Bundle\CmfBundle\Entity\PageBlockTranslation', array('fr'))
        ;
        $block->getTranslation('fr')->setPublished(true);
        $block->getPages()->add($manager->merge($this->getReference('page1')));
        $manager->persist($block);

        $block = new PageBlock();
        $block
            ->setName('slider js')
            ->setType('action')
            ->setSetting('action', 'MsiPaintBundle:Slider:js')
            ->setSetting('slot', 'js')
            ->setSetting('attributes', 'name=accueil')
            ->createTranslations('Msi\Bundle\CmfBundle\Entity\PageBlockTranslation', array('fr'))
        ;
        $block->getTranslation('fr')->setPublished(true);
        $block->getPages()->add($manager->merge($this->getReference('page1')));
        $manager->persist($block);

        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}
