<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHold;
use Ivoz\Provider\Domain\Model\MusicOnHold\OriginalFile;
use Ivoz\Provider\Domain\Model\MusicOnHold\EncodedFile;

class ProviderMusicOnHold extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(MusicOnHold::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstance(MusicOnHold::class);
        (function () use ($fixture) {
            $this->setName("Something good");
            $this->setOriginalFile(new OriginalFile(null, null, null));
            $this->setEncodedFile(new EncodedFile(null, null, null));
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
        })->call($item1);

        $this->addReference('_reference_ProviderMusicOnHold1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(MusicOnHold::class);
        (function () use ($fixture) {
            $this->setName("Something good");
            $this->setOriginalFile(new OriginalFile(null, null, null));
            $this->setEncodedFile(new EncodedFile(null, null, null));
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
        })->call($item2);

        $this->addReference('_reference_ProviderMusicOnHold2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
            ProviderBrand::class
        );
    }
}
