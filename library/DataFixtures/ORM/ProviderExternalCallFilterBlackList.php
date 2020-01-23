<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackList;

class ProviderExternalCallFilterBlackList extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ExternalCallFilterBlackList::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var ExternalCallFilterBlackList $item1 */
        $item1 = $this->createEntityInstance(ExternalCallFilterBlackList::class);
        (function () use ($fixture) {
            $this->setFilter(
                $fixture->getReference('_reference_ProviderExternalCallFilter1')
            );
            $this->setMatchlist(
                $fixture->getReference('_reference_ProviderMatchList1')
            );
        })->call($item1);

        $this->addReference('_reference_ProviderExternalCallFilterBlackList1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderExternalCallFilter::class,
            ProviderMatchList::class
        );
    }
}
