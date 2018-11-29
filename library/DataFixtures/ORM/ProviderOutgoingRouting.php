<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
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
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(OutgoingRouting::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var OutgoingRouting $item1 */
        $item1 = $this->createEntityInstance(OutgoingRouting::class);
        (function () {
            $this->setRoutingMode(OutgoingRouting::MODE_STATIC);
            $this->setType("pattern");
            $this->setPriority(1);
            $this->setWeight(1);
        })->call($item1);

        $item1->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item1->setCompany($this->getReference('_reference_ProviderCompany1'));
        $item1->setCarrier($this->getReference('_reference_ProviderCarrier1'));
        $item1->setRoutingPattern($this->getReference('_reference_ProviderRoutingPatternRoutingPattern68'));
        $item1->setRoutingTag($this->getReference('_reference_ProviderRoutingTag1'));
        $this->addReference('_reference_ProviderOutgoingRouting1', $item1);
        /**
         * @FIXME Sanitize must be disabled for this entity because static routingMode checks
         *   must ensure relCarriers is empty. This doesn't happen on DateFixure created entities because
         *   they don't create entities using class contructor.
         */
        //$this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(OutgoingRouting::class);
        (function () {
            $this->setRoutingMode(OutgoingRouting::MODE_STATIC);
            $this->setType("pattern");
            $this->setPriority(11);
            $this->setWeight(6);
        })->call($item2);

        $item2->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item2->setCarrier($this->getReference('_reference_ProviderCarrier1'));
        $item2->setRoutingPattern($this->getReference('_reference_ProviderRoutingPatternRoutingPattern68'));
        $item2->setRoutingTag($this->getReference('_reference_ProviderRoutingTag1'));
        $this->addReference('_reference_ProviderOutgoingRouting2', $item2);
        //$this->sanitizeEntityValues($item2);
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
