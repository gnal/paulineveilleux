<?php

namespace Msi\Bundle\paintBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Msi\Bundle\CmfBundle\Entity\Menu;

class LoadMenuData extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface
{
    protected $dic;

    public function setContainer(ContainerInterface $dic = null)
    {
        $this->dic = $dic;
    }

    public function load(ObjectManager $manager)
    {
        $transClass = 'Msi\Bundle\CmfBundle\Entity\MenuTranslation';
        // MAIN MENU

        // root
        $root = new Menu();
        $root->createTranslations($transClass, array('fr'));

        $root->getTranslation()->setPublished(true)->setName('principal');
        $manager->persist($root);
        $manager->flush();

        // accueil
        $menu = new Menu();
        $menu->createTranslations($transClass, array('fr'));
        $menu->setParent($root)->setPage($manager->merge($this->getReference('page1')));
        $menu->getTranslation()->setPublished(true)->setName('Accueil');
        $manager->persist($menu);

        // bio
        $menu = new Menu();
        $menu->createTranslations($transClass, array('fr'));
        $menu->setParent($root)->setPage($manager->merge($this->getReference('page2')));
        $menu->getTranslation()->setPublished(true)->setName('Biographie');
        $manager->persist($menu);

        // galerie
        $menu = new Menu();
        $menu->createTranslations($transClass, array('fr'));
        $menu->setParent($root)->setPage($manager->merge($this->getReference('page3')));
        $menu->getTranslation()->setPublished(true)->setName('Galerie');
        $manager->persist($menu);

        // event
        $menu = new Menu();
        $menu->createTranslations($transClass, array('fr'));
        $menu->setParent($root)->setPage($manager->merge($this->getReference('page4')));
        $menu->getTranslation()->setPublished(true)->setName('Évènements');
        $manager->persist($menu);

        // links
        $menu = new Menu();
        $menu->createTranslations($transClass, array('fr'));
        $menu->setParent($root)->setPage($manager->merge($this->getReference('page5')));
        $menu->getTranslation()->setPublished(true)->setName('Liens');
        $manager->persist($menu);

        // Contact
        $menu = new Menu();
        $menu->createTranslations($transClass, array('fr'));
        $menu->setParent($root)->setPage($manager->merge($this->getReference('page6')));
        $menu->getTranslation()->setPublished(true)->setName('Contact');
        $manager->persist($menu);

        // convertisseur
        $menu = new Menu();
        $menu->createTranslations($transClass, array('fr'));
        $menu->setParent($root);
        $menu->setTargetBlank(true);
        $menu->getTranslation()->setPublished(true)->setName('Convertisseur')->setRoute('http://www.google.com/finance/converter');
        $manager->persist($menu);

        // FLUSH
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
