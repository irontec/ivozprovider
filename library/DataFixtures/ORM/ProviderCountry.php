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

        $item70 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("ES");
            $this->setCountryCode("+34");
            $this->setName(new Name('Spain', 'España'));
            $this->setZone(new Zone('Europe', 'Europa'));
        })->call($item70);

        $this->addReference('_reference_ProviderCountry70', $item70);
        $this->sanitizeEntityValues($item70);
        $manager->persist($item70);

        $item79 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("GB");
            $this->setCountryCode("+44");
            $this->setName(new Name('United Kingdom', 'Reino Unido'));
            $this->setZone(new Zone('Europe', 'Europa'));
        })->call($item79);

        $this->addReference('_reference_ProviderCountry79', $item79);
        $this->sanitizeEntityValues($item79);
        $manager->persist($item79);

        $item116 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("JP");
            $this->setCountryCode("+81");
            $this->setName(new Name('Japan', 'Japón'));
            $this->setZone(new Zone('Asia', 'Asia'));
        })->call($item116);

        $this->addReference('_reference_ProviderCountry116', $item116);
        $this->sanitizeEntityValues($item116);
        $manager->persist($item116);

        $manager->flush();
    }
}
