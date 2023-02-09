<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Kam\Domain\Model\UsersAddress\UsersAddress;

class KamUsersAddress extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(UsersAddress::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(UsersAddress::class);
        (function () use ($fixture) {
            $this->setSourceAddress("127.0.0.1");
            $this->setIpAddr("127.0.0.1");
            $this->setMask(32);
            $this->setPort(0);
            $this->setDescription("Irontec HQ");
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
        })->call($item1);
        $this->addReference('_reference_KamUsersAddress1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
        );
    }
}
