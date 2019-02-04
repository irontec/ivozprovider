<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Currency\Name;
use Ivoz\Provider\Domain\Model\Currency\Currency;

class ProviderCurrency extends Fixture
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Currency::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(Currency::class);
        (function () {
            $this->setIden("EUR");
            $this->setSymbol("€");
            $this->setName(new Name('Euro', 'Euro'));
        })->call($item1);

        $this->addReference('_reference_ProviderCurrency1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(Currency::class);
        (function () {
            $this->setIden("USD");
            $this->setSymbol("$");
            $this->setName(new Name('Dollar', 'Dóllar'));
        })->call($item2);

        $this->addReference('_reference_ProviderCurrency2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);


        $item3 = $this->createEntityInstance(Currency::class);
        (function () {
            $this->setIden("GBP");
            $this->setSymbol("£");
            $this->setName(new Name('Pound', 'Libra'));
        })->call($item3);

        $this->addReference('_reference_ProviderCurrency3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $manager->flush();
    }
}
