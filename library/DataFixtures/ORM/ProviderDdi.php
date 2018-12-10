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
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Ddi::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var DdiInterface $item1 */
        $item1 = $this->createEntityInstance(Ddi::class);
        (function () {
            $this->setDdi("123");
            $this->setDdie164("+34123");
            $this->setDisplayName("");
            $this->setBillInboundCalls(false);
            $this->setFriendValue("");
        })->call($item1);

        $item1->setCompany($this->getReference('_reference_ProviderCompany1'));
        $item1->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item1->setDdiProvider($this->getReference('_reference_ProviderDdiProvider1'));
        $item1->setCountry($this->getReference('_reference_ProviderCountry70'));
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
