<?php

namespace Msi\Bundle\PaintBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class MenuBuilder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $this->getMainMenu($factory);

        $menu->setChildrenAttribute('class', 'menu unstyled');
        $this->setDropdownMenuAttributes($menu);

        foreach ($menu as $row) {
            if ($row->hasChildren()) {
                $row->setExtra('safe_label', true);
                $row->setLabel($row->getName().' <b class="caret"></b>');
            }
        }

        $this->findCurrent($menu);

        return $menu;
    }

    public function footerMenu(FactoryInterface $factory, array $options)
    {
        $menu = $this->getMainMenu($factory);

        $menu->setChildrenAttribute('class', 'pull-right');
        $this->setDropdownMenuAttributes($menu);

        foreach ($menu as $row) {
            if ($row->hasChildren()) {
                $row->setExtra('safe_label', true);
                $row->setLabel($row->getName().' <b class="caret"></b>');
            }
        }

        $this->findCurrent($menu);

        return $menu;
    }

    protected function getMainMenu($factory)
    {
        $root = $this->container->get('msi_cmf.menu_root_manager')->findRootByName('principal', $this->container->get('request')->getLocale());

        if (!$root) {
            return $factory->createItem('default');
        }

        $menu = $factory->createFromNode($root);

        return $menu;
    }

    protected function setDropdownMenuAttributes($menuItem)
    {
        foreach ($menuItem->getChildren() as $child) {
            if ($child->hasChildren()) {
                $child->setAttribute('class', 'dropdown');
                $child->setLinkAttribute('class', 'dropdown-toggle');
                $child->setLinkAttribute('data-toggle', 'dropdown');
                $child->setChildrenAttribute('class', 'dropdown-menu');
            }
            $this->setDropdownSubmenuAttributes($child);
        }
    }

    protected function setDropdownSubmenuAttributes($menuItem)
    {
        foreach ($menuItem->getChildren() as $child) {
            if ($child->hasChildren()) {
                $child->setAttribute('class', 'dropdown-submenu');
                $child->setChildrenAttribute('class', 'dropdown-menu');
                $child->setLinkAttribute('tabindex', -1);
            }
        }
    }

    protected function findCurrent($node)
    {
        $requestUri = $this->container->get('request')->getRequestUri();
        foreach ($node->getChildren() as $child) {
            $menuUri = $child->getUri();
            if ($menuUri === $requestUri) {
                $child->setCurrent(true);
            } else {
                $child->setCurrent(false);
                $this->findCurrent($child);
            }
        }
    }
}
