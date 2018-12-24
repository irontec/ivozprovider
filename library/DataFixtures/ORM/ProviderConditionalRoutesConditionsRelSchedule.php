<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelSchedule;

class ProviderConditionalRoutesConditionsRelSchedule extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ConditionalRoutesConditionsRelSchedule::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var ConditionalRoutesConditionsRelSchedule $item1 */
        $item1 = $this->createEntityInstance(ConditionalRoutesConditionsRelSchedule::class);

        $item1->setCondition(
            $this->getReference('_reference_ProviderConditionalRoutesCondition1')
        );

        $item1->setSchedule(
            $this->getReference('_reference_ProviderSchedule1')
        );
        $this->addReference('_reference_ProviderConditionalRoutesConditionsRelSchedule1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);
    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderConditionalRoutesCondition::class,
            ProviderSchedule::class
        );
    }
}
