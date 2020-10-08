<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting;

class ProviderOutgoingRouting extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(OutgoingRouting::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var OutgoingRouting $item1 */
        $item1 = $this->createEntityInstance(OutgoingRouting::class);
        (function () use ($fixture) {
            $this->setRoutingMode(OutgoingRouting::MODE_STATIC);
            $this->setType("pattern");
            $this->setPriority(1);
            $this->setWeight(1);
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setCarrier($fixture->getReference('_reference_ProviderCarrier1'));
            $this->setRoutingPattern($fixture->getReference('_reference_ProviderRoutingPatternRoutingPattern68'));
            $this->setRoutingTag($fixture->getReference('_reference_ProviderRoutingTag1'));
            /**
             * @FIXME Sanitize must be disabled for this entity because static routingMode checks
             *   must ensure relCarriers is empty. This doesn't happen on DateFixure created entities because
             *   they don't create entities using class contructor.
             */
            //$this->sanitizeEntityValues($item1);
        })->call($item1);
        $this->addReference('_reference_ProviderOutgoingRouting1', $item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(OutgoingRouting::class);
        (function () use ($fixture) {
            $this->setRoutingMode(OutgoingRouting::MODE_STATIC);
            $this->setType("pattern");
            $this->setPriority(11);
            $this->setWeight(6);
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setCarrier($fixture->getReference('_reference_ProviderCarrier1'));
            $this->setRoutingPattern($fixture->getReference('_reference_ProviderRoutingPatternRoutingPattern68'));
            $this->setRoutingTag($fixture->getReference('_reference_ProviderRoutingTag1'));

            //$this->sanitizeEntityValues($item2);
        })->call($item2);
        $this->addReference('_reference_ProviderOutgoingRouting2', $item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class,
            ProviderCompany::class,
            ProviderCarrier::class,
            ProviderRoutingTag::class
        );
    }
}
