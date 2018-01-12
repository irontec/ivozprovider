<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\LcrRule\LcrRule;

class ProviderLcrRule extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(LcrRule::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item3 = $this->createEntityInstanceWithPublicMethods(LcrRule::class);
        $item3->setLcrId(1);
        $item3->setPrefix("+93");
        $item3->setFromUri("^b1c[0-9]+\$");
        $item3->setStopper(0);
        $item3->setEnabled(1);
        $item3->setTag("Afghanistan");
        $item3->setRoutingPattern($this->getReference('_reference_IvozProviderDomainModelRoutingPatternRoutingPattern68'));
        $item3->setOutgoingRouting($this->getReference('_reference_IvozProviderDomainModelOutgoingRoutingOutgoingRouting2'));
        $this->addReference('_reference_IvozProviderDomainModelLcrRuleLcrRule3', $item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstanceWithPublicMethods(LcrRule::class);
        $item4->setLcrId(1);
        $item4->setPrefix("+93");
        $item4->setFromUri("^b1c1\$");
        $item4->setStopper(0);
        $item4->setEnabled(1);
        $item4->setTag("Afghanistan");
        $item4->setRoutingPattern($this->getReference('_reference_IvozProviderDomainModelRoutingPatternRoutingPattern68'));
        $item4->setOutgoingRouting($this->getReference('_reference_IvozProviderDomainModelOutgoingRoutingOutgoingRouting1'));
        $this->addReference('_reference_IvozProviderDomainModelLcrRuleLcrRule4', $item4);
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
