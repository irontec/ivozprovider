<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotification;
use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotificationInterface;

class ProviderBalanceNotification extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(BalanceNotification::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var BalanceNotificationInterface $item1 */
        $item1 = $this->createEntityInstance(BalanceNotification::class);
        (function () use ($fixture) {
            $this->setToAddress("balance@ivozprovider.com");
            $this->setThreshold(4.5000);
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setNotificationTemplate(
                $fixture->getReference('_reference_ProviderNotificationTemplate1')
            );
        })->call($item1);

        $this->addReference('_reference_ProviderBalanceNotification1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        /** @var BalanceNotificationInterface $item2 */
        $item2 = $this->createEntityInstance(BalanceNotification::class);
        (function () use ($fixture) {
            $this->setToAddress("balance2@ivozprovider.com");
            $this->setThreshold(0);
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
        })->call($item2);

        $this->addReference('_reference_ProviderBalanceNotification2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

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
