<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Country\Country;
use Ivoz\Provider\Domain\Model\Country\Name;
use Ivoz\Provider\Domain\Model\Country\Zone;

class ProviderCountry extends Fixture
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager->getClassMetadata(Country::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item70 = $this->createEntityInstanceWithPublicMethods(Country::class);
        $item70->setCode("ES");
        $item70->setCountryCode("+34");
        $item70->setName(new Name('en', 'es'));
        $item70->setZone(new Zone('en', 'es'));
        $this->addReference('_reference_IvozProviderDomainModelCountryCountry70', $item70);
        $manager->persist($item70);

        $item79 = $this->createEntityInstanceWithPublicMethods(Country::class);
        $item79->setCode("GB");
        $item79->setCountryCode("+44");
        $item79->setName(new Name('en', 'es'));
        $item79->setZone(new Zone('en', 'es'));
        $this->addReference('_reference_IvozProviderDomainModelCountryCountry79', $item70);
        $manager->persist($item70);

        $manager->flush();
    }

}
