<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\MaxUsageNotification\MaxUsageNotification;
use Ivoz\Provider\Domain\Model\MaxUsageNotification\MaxUsageNotificationInterface;

class ProviderMaxUsageNotification extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(MaxUsageNotification::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var MaxUsageNotificationInterface $item1 */
        $item1 = $this->createEntityInstance(MaxUsageNotification::class);
        (function () use ($fixture) {
            $this->setToAddress("max-usage@ivozprovider.com");
            $this->setThreshold(500);
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setNotificationTemplate(
                $fixture->getReference('_reference_ProviderNotificationTemplate1')
            );
        })->call($item1);

        $this->addReference('_reference_ProviderMaxUsageNotification1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
            ProviderNotificationTemplate::class,
        );
    }
}
