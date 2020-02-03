<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;

class ProviderDdi extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Ddi::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var DdiInterface $item1 */
        $item1 = $this->createEntityInstance(Ddi::class);
        (function () use ($fixture) {
            $this->setDdi("123");
            $this->setDdie164("+34123");
            $this->setDisplayName("");
            $this->setBillInboundCalls(false);
            $this->setFriendValue("");
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setDdiProvider($fixture->getReference('_reference_ProviderDdiProvider1'));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item1);

        $this->addReference('_reference_ProviderDdi1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
            ProviderBrand::class,
            ProviderDdiProvider::class,
            ProviderCountry::class
        );
    }
}
