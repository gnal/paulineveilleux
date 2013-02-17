<?php

namespace msi\Bundle\PaintBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Msi\Bundle\CmfBundle\Entity\Page;

class LoadPageData extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface
{
    protected $dic;

    public function setContainer(ContainerInterface $dic = null)
    {
        $this->dic = $dic;
    }

    public function load(ObjectManager $manager)
    {
        // home
        $page = new Page();
        $page
            ->setHome(true)
            ->setTemplate('VeilleuxAppBundle::layout.html.twig')
            ->createTranslations('Msi\Bundle\CmfBundle\Entity\PageTranslation', array('fr'));
        ;
        $this->addReference('page1', $page);
        $page->getTranslation('fr')->setPublished(true)->setTitle('Accueil');
        $manager->persist($page);

        // bio
        $page = new Page();
        $page
            ->setHome(false)
            ->setTemplate('VeilleuxAppBundle::layout.html.twig')
            ->createTranslations('Msi\Bundle\CmfBundle\Entity\PageTranslation', array('fr'));
        ;
        $this->addReference('page2', $page);
        $page->getTranslation('fr')->setPublished(true)->setTitle('Biographie');
        $manager->persist($page);

        // galerie
        $page = new Page();
        $page
            ->setHome(false)
            ->setTemplate('VeilleuxAppBundle::layout.html.twig')
            ->setRoute('msi_paint_gallery_index')
            ->createTranslations('Msi\Bundle\CmfBundle\Entity\PageTranslation', array('fr'));
        ;
        $this->addReference('page3', $page);
        $page->getTranslation('fr')->setPublished(true)->setTitle('Galerie');
        $manager->persist($page);

        // event
        $page = new Page();
        $page
            ->setHome(false)
            ->setTemplate('VeilleuxAppBundle::layout.html.twig')
            ->createTranslations('Msi\Bundle\CmfBundle\Entity\PageTranslation', array('fr'));
        ;
        $this->addReference('page4', $page);
        $page->getTranslation('fr')->setPublished(true)->setTitle('Évènements');
        $manager->persist($page);

        // liens
        $page = new Page();
        $page
            ->setHome(false)
            ->setTemplate('VeilleuxAppBundle::layout.html.twig')
            ->createTranslations('Msi\Bundle\CmfBundle\Entity\PageTranslation', array('fr'));
        ;
        $this->addReference('page5', $page);
        $page->getTranslation('fr')->setPublished(true)->setTitle('Liens');
        $manager->persist($page);

        // contact
        $page = new Page();
        $page
            ->setHome(false)
            ->setTemplate('VeilleuxAppBundle::layout.html.twig')
            ->createTranslations('Msi\Bundle\CmfBundle\Entity\PageTranslation', array('fr'));
        ;
        $this->addReference('page6', $page);
        $page->getTranslation('fr')->setPublished(true)->setTitle('Contact');
        $manager->persist($page);

        // FLUSH
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
