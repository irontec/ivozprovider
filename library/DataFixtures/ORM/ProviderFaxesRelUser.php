<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectManager;
use Ivoz\Provider\Domain\Model\FaxesRelUser\FaxesRelUser;

class ProviderFaxesRelUser extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(FaxesRelUser::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(FaxesRelUser::class);
        (function () use ($fixture) {
            $this->setUser(
                $fixture->getReference('_reference_ProviderUser1'),
            );
            $this->setFax(
                $fixture->getReference('_reference_ProviderFax1'),
            );
        })->call($item1);

        $this->addReference('_reference_ProviderFaxesRelUser1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(FaxesRelUser::class);
        (function () use ($fixture) {
            $this->setUser(
                $fixture->getReference('_reference_ProviderUser2'),
            );
            $this->setFax(
                $fixture->getReference('_reference_ProviderFax2'),
            );
        })->call($item2);

        $this->addReference('_reference_ProviderFaxesRelUser2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderUser::class,
            ProviderFax::class
        );
    }
}
