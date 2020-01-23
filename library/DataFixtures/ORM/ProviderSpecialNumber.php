<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\SpecialNumber\SpecialNumber;
use Ivoz\Provider\Domain\Model\SpecialNumber\SpecialNumberInterface;

class ProviderSpecialNumber extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(SpecialNumber::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var SpecialNumberInterface $item1 */
        $item1 = $this->createEntityInstance(SpecialNumber::class);
        (function () use ($fixture) {
            $this->setNumber("016");
            $this->setNumberE164("+34016");
            $this->setDisableCDR("1");
            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item1);

        $this->addReference('_reference_ProviderSpecialNumber1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(SpecialNumber::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var SpecialNumberInterface $item2 */
        $item2 = $this->createEntityInstance(SpecialNumber::class);
        (function () use ($fixture) {
            $this->setNumber("091");
            $this->setNumberE164("+34091");
            $this->setDisableCDR("1");
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item2);

        $this->addReference('_reference_ProviderSpecialNumber2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class,
            ProviderCountry::class
        );
    }
}
