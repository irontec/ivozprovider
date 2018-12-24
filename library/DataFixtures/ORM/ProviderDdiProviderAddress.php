<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddress;
use Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface;

class ProviderDdiProviderAddress extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(DdiProviderAddress::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var DdiProviderAddressInterface $item1 */
        $item1 = $this->createEntityInstance(DdiProviderAddress::class);
        (function () {
            $this->setDescription("DDI Provider Address 1");
            $this->setIp("127.0.0.1");
        })->call($item1);

        $item1->setDdiProvider($this->getReference('_reference_ProviderDdiProvider1'));
        $this->addReference('_reference_ProviderDdiProviderAddress1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderDdiProvider::class,
        );
    }
}
