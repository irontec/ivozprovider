<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
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
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(TrunksLcrRule::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstance(TrunksLcrRule::class);
        (function () use ($fixture) {
            $this->setLcrId(1);
            $this->setPrefix("+34");
            $this->setFromUri("^b1c[0-9]+\$");
            $this->setStopper(0);
            $this->setEnabled(1);
            $this->setRoutingPattern(
                $fixture->getReference('_reference_ProviderRoutingPatternRoutingPattern68')
            );
            $this->setOutgoingRouting(
                $fixture->getReference('_reference_ProviderOutgoingRouting2')
            );
        })->call($item1);

        $this->addReference('_reference_KamTrunksLcrRule3', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(TrunksLcrRule::class);
        (function () use ($fixture) {
            $this->setLcrId(1);
            $this->setPrefix("+34");
            $this->setFromUri("^b1c1\$");
            $this->setStopper(0);
            $this->setEnabled(1);
            $this->setRoutingPattern($fixture->getReference('_reference_ProviderRoutingPatternRoutingPattern68'));
            $this->setOutgoingRouting($fixture->getReference('_reference_ProviderOutgoingRouting1'));
        })->call($item2);
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
