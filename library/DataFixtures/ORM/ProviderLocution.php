<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Locution\Locution;
use Ivoz\Provider\Domain\Model\Locution\EncodedFile;
use Ivoz\Provider\Domain\Model\Locution\OriginalFile;

class ProviderLocution extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Locution::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(Locution::class);
        (function () use ($fixture) {
            $this->setName("testLocution");
            $this->encodedFile = new EncodedFile(1, 'audio/x-wav; charset=binary', 'locution.wav');
            $this->originalFile = new OriginalFile(1, 'audio/mpeg; charset=binary', 'locution.mp3');
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
        })->call($item1);

        $this->addReference('_reference_ProviderLocution1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);


        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class
        );
    }
}
