<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendar;

class ProviderConditionalRoutesConditionsRelCalendar extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ConditionalRoutesConditionsRelCalendar::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var ConditionalRoutesConditionsRelCalendar $item1 */
        $item1 = $this->createEntityInstance(ConditionalRoutesConditionsRelCalendar::class);

        $item1->setCondition(
            $this->getReference('_reference_ProviderConditionalRoutesCondition1')
        );

        $item1->setCalendar(
            $this->getReference('_reference_ProviderCalendar1')
        );
        $this->addReference('_reference_ProviderConditionalRoutesConditionsRelCalendar1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);
    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderConditionalRoutesCondition::class,
            ProviderCalendar::class
        );
    }
}
