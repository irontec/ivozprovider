<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
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
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(OutgoingDdiRulesPattern::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var OutgoingDdiRulesPattern $item1 */
        $item1 = $this->createEntityInstance(OutgoingDdiRulesPattern::class);
        (function () {
            $this->setAction('keep');
            $this->setPriority(1);
        })->call($item1);

        $item1->setOutgoingDdiRule(
            $this->getReference('_reference_ProviderOutgoingDdiRule1')
        );
        $item1->setMatchList(
            $this->getReference('_reference_ProviderMatchList1')
        );
        $item1->setForcedDdi(
            $this->getReference('_reference_ProviderDdi1')
        );
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
