<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRule;

class KamTrunksLcrRule extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(TrunksLcrRule::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstance(TrunksLcrRule::class);
        (function () {
            $this->setLcrId(1);
            $this->setPrefix("+34");
            $this->setFromUri("^b1c[0-9]+\$");
            $this->setStopper(0);
            $this->setEnabled(1);
        })->call($item1);
        $item1->setRoutingPattern(
            $this->getReference('_reference_ProviderRoutingPatternRoutingPattern68')
        );
        $item1->setOutgoingRouting(
            $this->getReference('_reference_ProviderOutgoingRouting2')
        );

        $this->addReference('_reference_KamTrunksLcrRule3', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(TrunksLcrRule::class);
        (function () {
            $this->setLcrId(1);
            $this->setPrefix("+34");
            $this->setFromUri("^b1c1\$");
            $this->setStopper(0);
            $this->setEnabled(1);
        })->call($item2);
        $item2->setRoutingPattern($this->getReference('_reference_ProviderRoutingPatternRoutingPattern68'));
        $item2->setOutgoingRouting($this->getReference('_reference_ProviderOutgoingRouting1'));
        $this->addReference('_reference_KamTrunksLcrRule4', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderRoutingPattern::class,
            ProviderOutgoingRouting::class
        );
    }
}
