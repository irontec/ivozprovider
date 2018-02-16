<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\LcrRuleTarget\LcrRuleTarget;

class ProviderLcrRuleTarget extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager
            ->getClassMetadata(LcrRuleTarget::class)
            ->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item3 = $this->createEntityInstanceWithPublicMethods(LcrRuleTarget::class);
        $item3->setLcrId(1);
        $item3->setPriority(11);
        $item3->setWeight(6);
        $item3->setRule($this->getReference('_reference_IvozProviderDomainModelLcrRuleLcrRule3'));
        $item3->setGw($this->getReference('_reference_IvozProviderDomainModelLcrGatewayLcrGateway1'));
        $item3->setOutgoingRouting($this->getReference('_reference_IvozProviderDomainModelOutgoingRoutingOutgoingRouting2'));
        $this->addReference('_reference_IvozProviderDomainModelLcrRuleTargetLcrRuleTarget3', $item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstanceWithPublicMethods(LcrRuleTarget::class);
        $item4->setLcrId(1);
        $item4->setPriority(1);
        $item4->setWeight(1);
        $item4->setRule($this->getReference('_reference_IvozProviderDomainModelLcrRuleLcrRule4'));
        $item4->setGw($this->getReference('_reference_IvozProviderDomainModelLcrGatewayLcrGateway1'));
        $item4->setOutgoingRouting($this->getReference('_reference_IvozProviderDomainModelOutgoingRoutingOutgoingRouting1'));
        $this->addReference('_reference_IvozProviderDomainModelLcrRuleTargetLcrRuleTarget4', $item4);
        $manager->persist($item4);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderLcrRule::class,
            ProviderLcrGateway::class
        );
    }
}
