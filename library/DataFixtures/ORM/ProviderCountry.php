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
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Country::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item70 = $this->createEntityInstanceWithPublicMethods(Country::class);
        $item70->setCode("ES");
        $item70->setCountryCode("+34");
        $item70->setName(new Name('Spain', 'España'));
        $item70->setZone(new Zone('Europe', 'Europa'));
        $this->addReference('_reference_ProviderCountry70', $item70);
        $this->sanitizeEntityValues($item70);
        $manager->persist($item70);

        $item79 = $this->createEntityInstanceWithPublicMethods(Country::class);
        $item79->setCode("GB");
        $item79->setCountryCode("+44");
        $item79->setName(new Name('United Kingdom', 'Reino Unido'));
        $item79->setZone(new Zone('Europe', 'Europa'));
        $this->addReference('_reference_ProviderCountry79', $item79);
        $this->sanitizeEntityValues($item79);
        $manager->persist($item79);

        $item116 = $this->createEntityInstanceWithPublicMethods(Country::class);
        $item116->setCode("JP");
        $item116->setCountryCode("+81");
        $item116->setName(new Name('Japan', 'Japón'));
        $item116->setZone(new Zone('Asia', 'Asia'));
        $this->addReference('_reference_ProviderCountry116', $item116);
        $this->sanitizeEntityValues($item116);
        $manager->persist($item116);

        $manager->flush();
    }
}
