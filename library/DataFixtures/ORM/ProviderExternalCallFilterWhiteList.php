<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteList;

class ProviderExternalCallFilterWhiteList extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ExternalCallFilterWhiteList::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var ExternalCallFilterWhiteList $item1 */
        $item1 = $this->createEntityInstance(ExternalCallFilterWhiteList::class);
        (function () use ($fixture) {
            $this->setFilter(
                $fixture->getReference('_reference_ProviderExternalCallFilter1')
            );
            $this->setMatchlist(
                $fixture->getReference('_reference_ProviderMatchList1')
            );
        })->call($item1);
        $this->addReference('_reference_ProviderExternalCallFilterWhiteList1', $item1);
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
