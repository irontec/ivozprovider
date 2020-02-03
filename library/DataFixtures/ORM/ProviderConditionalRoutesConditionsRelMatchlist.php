<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlist;

class ProviderConditionalRoutesConditionsRelMatchlist extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ConditionalRoutesConditionsRelMatchlist::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var ConditionalRoutesConditionsRelMatchlist $item1 */
        $item1 = $this->createEntityInstance(ConditionalRoutesConditionsRelMatchlist::class);
        (function () use ($fixture) {
            $this->setCondition(
                $fixture->getReference('_reference_ProviderConditionalRoutesCondition1')
            );

            $this->setMatchlist(
                $fixture->getReference('_reference_ProviderMatchList1')
            );
        })->call($item1);

        $this->addReference('_reference_ProviderConditionalRoutesConditionsRelMatchlist1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderConditionalRoutesCondition::class,
            ProviderMatchList::class
        );
    }
}
