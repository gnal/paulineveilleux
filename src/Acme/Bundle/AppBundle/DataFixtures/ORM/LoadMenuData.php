<?php

namespace Acme\Bundle\AppBundle\DataFixtures\ORM;

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
        // ADMIN MENU
        // root
        $root = new Menu();
        $root->createTranslations($transClass, array('fr'));
        $root->getTranslation()->setPublished(true)->setName('admin');
        $manager->persist($root);
        $manager->flush();
        // security
        $security = new Menu();
        $security->createTranslations($transClass, array('fr'));
        $security->setParent($root);
        $security->getTranslation()->setPublished(true)->setName('Sécurité');
        $manager->persist($security);
            // users
            $menu = new Menu();
            $menu->createTranslations($transClass, array('fr'));
            $menu->getTranslation()->setRoute('@msi_user_user_admin_index');
            $menu->setParent($security);
            $menu->getTranslation()->setPublished(true)->setName('Utilisateurs');
            $manager->persist($menu);
            // groups
            $menu = new Menu();
            $menu->createTranslations($transClass, array('fr'));
            $menu->getTranslation()->setRoute('@msi_user_group_admin_index');
            $menu->setParent($security);
            $menu->getTranslation()->setPublished(true)->setName('Groupes');
            $manager->persist($menu);
        // menu
        $menu = new Menu();
        $menu->createTranslations($transClass, array('fr'));
        $menu->getTranslation()->setRoute('@msi_cmf_menu_root_admin_index');
        $menu->setParent($root);
        $menu->getTranslation()->setPublished(true)->setName('Menus');
        $manager->persist($menu);
        // content
        $content = new Menu();
        $content->createTranslations($transClass, array('fr'));
        $content->setParent($root);
        $content->getTranslation()->setPublished(true)->setName('Contenu');
        $manager->persist($content);
            // pages
            $menu = new Menu();
            $menu->createTranslations($transClass, array('fr'));
            $menu->getTranslation()->setRoute('@msi_cmf_page_admin_index');
            $menu->setParent($content);
            $menu->getTranslation()->setPublished(true)->setName('Pages');
            $manager->persist($menu);
            // blocks
            $menu = new Menu();
            $menu->createTranslations($transClass, array('fr'));
            $menu->getTranslation()->setRoute('@msi_cmf_page_block_admin_index');
            $menu->setParent($content);
            $menu->getTranslation()->setPublished(true)->setName('Blocs');
            $manager->persist($menu);
        // FLUSH
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
