<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock\ConditionalRoutesConditionsRelRouteLock;

class ProviderConditionalRoutesConditionsRelRouteLock extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ConditionalRoutesConditionsRelRouteLock::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var ConditionalRoutesConditionsRelRouteLock $item1 */
        $item1 = $this->createEntityInstance(ConditionalRoutesConditionsRelRouteLock::class);

        $item1->setCondition(
            $this->getReference('_reference_ProviderConditionalRoutesCondition1')
        );

        $item1->setRouteLock(
            $this->getReference('_reference_ProviderRouteLock1')
        );
        $this->addReference('_reference_ProviderConditionalRoutesConditionsRelRouteLock1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);
    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderConditionalRoutesCondition::class,
            ProviderRouteLock::class
        );
    }
}
