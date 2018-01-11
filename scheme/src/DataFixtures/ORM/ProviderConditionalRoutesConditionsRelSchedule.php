<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelSchedule;

class ProviderConditionalRoutesConditionsRelSchedule extends Fixture
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager->getClassMetadata(ConditionalRoutesConditionsRelSchedule::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
    
        $manager->flush();
    }

}
