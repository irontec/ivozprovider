<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTarget;
use Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTargetInterface;

class KamTrunksLcrRuleTarget extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager
            ->getClassMetadata(TrunksLcrRuleTarget::class)
            ->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var TrunksLcrRuleTargetInterface $item3 */
        $item3 = $this->createEntityInstanceWithPublicMethods(TrunksLcrRuleTarget::class);
        $item3->setLcrId(1);
        $item3->setPriority(11);
        $item3->setWeight(6);
        $item3->setRule($this->getReference('_reference_KamTrunksLcrRule3'));
        $item3->setGw($this->getReference('_reference_KamTrunksLcrGateway1'));
        $item3->setOutgoingRouting($this->getReference('_reference_ProviderOutgoingRouting2'));
        $this->addReference('_reference_KamTrunksLcrRuleTarget3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        /** @var TrunksLcrRuleTargetInterface $item4 */
        $item4 = $this->createEntityInstanceWithPublicMethods(TrunksLcrRuleTarget::class);
        $item4->setLcrId(1);
        $item4->setPriority(1);
        $item4->setWeight(1);
        $item4->setRule($this->getReference('_reference_KamTrunksLcrRule4'));
        $item4->setGw($this->getReference('_reference_KamTrunksLcrGateway1'));
        $item4->setOutgoingRouting($this->getReference('_reference_ProviderOutgoingRouting1'));
        $this->addReference('_reference_KamTrunksLcrRuleTarget4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            KamTrunksLcrRule::class,
            KamTrunksLcrGateway::class
        );
    }
}
