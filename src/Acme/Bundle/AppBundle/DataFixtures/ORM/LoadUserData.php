<?php

namespace Acme\Bundle\AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadUserData extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface
{
    protected $dic;

    public function setContainer(ContainerInterface $dic = null)
    {
        $this->dic = $dic;
    }

    public function load(ObjectManager $manager)
    {
        $userManager = $this->dic->get('fos_user.user_manager');
        // superadmin
        $user = $userManager->createUser();
        $user
            ->setUsername('superadmin')
            ->setEmail('superadmin@superadmin.com')
            ->setPlainPassword('superadmin')
            ->setConfirmationToken(null)
            ->setEnabled(true)
            ->addRole('ROLE_SUPER_ADMIN')
        ;
        $this->addReference('user1', $user);
        $userManager->updateUser($user);
        // client
        $user = $userManager->createUser();
        $user
            ->setUsername('client')
            ->setEmail('client@client.com')
            ->setPlainPassword('client')
            ->setConfirmationToken(null)
            ->setEnabled(true)
            ->getGroups()->add($manager->merge($this->getReference('group1')))
        ;
        $this->addReference('user2', $user);
        $userManager->updateUser($user);
    }

    public function getOrder()
    {
        return 3;
    }
}
