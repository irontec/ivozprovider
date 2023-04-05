<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;

class ProviderDdi extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Ddi::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var DdiInterface $item1 */
        $item1 = $this->createEntityInstance(Ddi::class);
        (function () use ($fixture) {
            $this->setDdi("123");
            $this->setDdie164("+34123");
            $this->setDescription("Description for DDI 123");
            $this->setDisplayName("");
            $this->setFriendValue("");
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setDdiProvider($fixture->getReference('_reference_ProviderDdiProvider1'));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item1);

        $this->addReference('_reference_ProviderDdi1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        /** @var DdiInterface $item2 */
        $item2 = $this->createEntityInstance(Ddi::class);
        (function () use ($fixture) {
            $this->setDdi("124");
            $this->setDdie164("+34124");
            $this->setDisplayName("");
            $this->setFriendValue("");
            $this->setCompany($fixture->getReference('_reference_ProviderCompany4'));
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setDdiProvider($fixture->getReference('_reference_ProviderDdiProvider1'));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item2);

        $this->addReference('_reference_ProviderDdi2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        /** @var DdiInterface $item3 */
        $item3 = $this->createEntityInstance(Ddi::class);
        (function () use ($fixture) {
            $this->setDdi("121");
            $this->setDdie164("+34121");
            $this->setDisplayName("");
            $this->setFriendValue("");
            $this->setCompany($fixture->getReference('_reference_ProviderCompany3'));
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setDdiProvider($fixture->getReference('_reference_ProviderDdiProvider1'));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item3);

        $this->addReference('_reference_ProviderDdi3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
            ProviderBrand::class,
            ProviderDdiProvider::class,
            ProviderCountry::class
        );
    }
}
