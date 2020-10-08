<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPattern;

class ProviderOutgoingDdiRulesPattern extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(OutgoingDdiRulesPattern::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var OutgoingDdiRulesPattern $item1 */
        $item1 = $this->createEntityInstance(OutgoingDdiRulesPattern::class);
        (function () use ($fixture) {
            $this->setType('destination');
            $this->setAction('keep');
            $this->setPriority(1);

            $this->setOutgoingDdiRule(
                $fixture->getReference('_reference_ProviderOutgoingDdiRule1')
            );
            $this->setMatchList(
                $fixture->getReference('_reference_ProviderMatchList1')
            );
            $this->setForcedDdi(
                $fixture->getReference('_reference_ProviderDdi1')
            );
        })->call($item1);

        $this->addReference('_reference_ProviderOutgoingDdiRulesPattern1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderOutgoingDdiRule::class,
            ProviderMatchList::class,
            ProviderDdi::class
        );
    }
}
