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
    
        $item3 = $this->createEntityInstance(TrunksLcrRule::class);
        (function () {
            $this->setLcrId(1);
            $this->setPrefix("+93");
            $this->setFromUri("^b1c[0-9]+\$");
            $this->setStopper(0);
            $this->setEnabled(1);
        })->call($item3);
        $item3->setRoutingPattern(
            $this->getReference('_reference_ProviderRoutingPatternRoutingPattern68')
        );
        $item3->setOutgoingRouting(
            $this->getReference('_reference_ProviderOutgoingRouting2')
        );

        $this->addReference('_reference_KamTrunksLcrRule3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstance(TrunksLcrRule::class);
        (function () {
            $this->setLcrId(1);
            $this->setPrefix("+93");
            $this->setFromUri("^b1c1\$");
            $this->setStopper(0);
            $this->setEnabled(1);
        })->call($item4);
        $item4->setRoutingPattern($this->getReference('_reference_ProviderRoutingPatternRoutingPattern68'));
        $item4->setOutgoingRouting($this->getReference('_reference_ProviderOutgoingRouting1'));
        $this->addReference('_reference_KamTrunksLcrRule4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);

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
