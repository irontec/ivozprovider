<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
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
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(BalanceNotification::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var BalanceNotificationInterface $item1 */
        $item1 = $this->createEntityInstanceWithPublicMethods(BalanceNotification::class);
        $item1->setToAddress("balance@ivozprovider.com");
        $item1->setThreshold(4.5000);
        $item1->setCompany($this->getReference('_reference_ProviderCompany1'));
        $this->addReference('_reference_ProviderBalanceNotification1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        /** @var BalanceNotificationInterface $item2 */
        $item2 = $this->createEntityInstanceWithPublicMethods(BalanceNotification::class);
        $item2->setToAddress("balance2@ivozprovider.com");
        $item2->setThreshold(0);
        $item2->setCompany($this->getReference('_reference_ProviderCompany1'));
        $this->addReference('_reference_ProviderBalanceNotification2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class
        );
    }
}
