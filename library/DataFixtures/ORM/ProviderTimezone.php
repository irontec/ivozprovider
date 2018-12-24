<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Timezone\Timezone;
use Ivoz\Provider\Domain\Model\Timezone\Label;

class ProviderTimezone extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Timezone::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item145 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Madrid");
            $this->setComment("mainland");
            $this->setLabel(new Label('en', 'es'));
        })->call($item145);

        $item145->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone145', $item145);
        $this->sanitizeEntityValues($item145);
        $manager->persist($item145);

        $item158 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/London");
            $this->setComment(null);
            $this->setLabel(new Label('en', 'es'));
        })->call($item158);

        $item158->setCountry($this->getReference('_reference_ProviderCountry79'));
        $this->addReference('_reference_ProviderTimezone158', $item158);
        $this->sanitizeEntityValues($item158);
        $manager->persist($item158);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCountry::class
        );
    }
}
