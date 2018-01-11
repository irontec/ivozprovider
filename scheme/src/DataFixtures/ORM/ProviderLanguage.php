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
        $manager->getClassMetadata(Language::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(Language::class);
        $item1->setIden("es");
        $item1->setName(new Name('es', 'es'));
        $this->addReference('_reference_IvozProviderDomainModelLanguageLanguage1', $item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstanceWithPublicMethods(Language::class);
        $item2->setIden("en");
        $item2->setName(new Name('en', 'en'));
        $this->addReference('_reference_IvozProviderDomainModelLanguageLanguage2', $item2);
        $manager->persist($item2);

    
        $manager->flush();
    }

}
