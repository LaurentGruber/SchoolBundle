<?php

/*
 * This file is part of the Claroline Connect package.
 *
 * (c) Claroline Consortium <consortium@claroline.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Laurent\SchoolBundle\DataFixtures;

use Claroline\CoreBundle\Entity\Group;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class LoadGroupData extends AbstractFixture implements ContainerAwareInterface
{
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $roleManager = $this->container->get('claroline.manager.role_manager');
        $groupManager = $this->container->get('claroline.manager.group_manager');
        $groupRepositroy = $manager->getRepository('ClarolineCoreBundle:Group');
        $roleRepository = $manager->getRepository('ClarolineCoreBundle:Role');

        if (!$roleRepository->findOneByName('ROLE_PROF')){
            $roleManager->createBaseRole('ROLE_PROF', 'Prof');
        }

        if (!$roleRepository->findOneByName('ROLE_ELEVE')){
            $roleManager->createBaseRole('ROLE_ELEVE', 'Élève');
        }

        if (!$groupRepositroy->findOneByName('Prof')){
            $group = new Group();
            $group->setName('Prof');
            $role = $manager->getRepository('ClarolineCoreBundle:Role')
                ->findOneByName('ROLE_PROF');
            $group->addRole($role);
            $groupManager->insertGroup($group);
        }

        if (!$groupRepositroy->findOneByName('Élèves')){
            $group = new Group();
            $group->setName('Élèves');
            $roleRepository->findOneByName('ROLE_ELEVE');
            $group->addRole($role);
            $groupManager->insertGroup($group);
        }
    }
}
