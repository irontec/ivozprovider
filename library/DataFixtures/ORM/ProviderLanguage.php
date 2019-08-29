<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Language\Language;
use Ivoz\Provider\Domain\Model\Language\Name;

class ProviderLanguage extends Fixture
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Language::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstance(Language::class);
        (function () {
            $this->setIden("es");
            $this->setName(new Name('es', 'es', 'es'));
        })->call($item1);

        $this->addReference('_reference_ProviderLanguage1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(Language::class);
        (function () {
            $this->setIden("en");
            $this->setName(new Name('en', 'en', 'en'));
        })->call($item2);

        $this->addReference('_reference_ProviderLanguage2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstance(Language::class);
        (function () {
            $this->setIden("ca");
            $this->setName(new Name('ca', 'ca', 'ca'));
        })->call($item3);

        $this->addReference('_reference_ProviderLanguage3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

    
        $manager->flush();
    }
}
