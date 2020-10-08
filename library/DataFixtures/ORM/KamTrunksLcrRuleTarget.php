<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
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
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager
            ->getClassMetadata(TrunksLcrRuleTarget::class)
            ->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var TrunksLcrRuleTargetInterface $item1 */
        $item1 = $this->createEntityInstance(TrunksLcrRuleTarget::class);
        (function () use ($fixture) {
            $this->setLcrId(1);
            $this->setPriority(11);
            $this->setWeight(30);
            $this->setRule($fixture->getReference('_reference_KamTrunksLcrRule3'));
            $this->setGw($fixture->getReference('_reference_KamTrunksLcrGateway1'));
            $this->setOutgoingRouting($fixture->getReference('_reference_ProviderOutgoingRouting2'));
        })->call($item1);

        $this->addReference('_reference_KamTrunksLcrRuleTarget1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        /** @var TrunksLcrRuleTargetInterface $item2 */
        $item2 = $this->createEntityInstance(TrunksLcrRuleTarget::class);
        (function () use ($fixture) {
            $this->setLcrId(1);
            $this->setPriority(1);
            $this->setWeight(5);
            $this->setRule($fixture->getReference('_reference_KamTrunksLcrRule4'));
            $this->setGw($fixture->getReference('_reference_KamTrunksLcrGateway1'));
            $this->setOutgoingRouting($fixture->getReference('_reference_ProviderOutgoingRouting1'));
        })->call($item2);

        $this->addReference('_reference_KamTrunksLcrRuleTarget2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);


        /** @var TrunksLcrRuleTargetInterface $item3 */
        $item3 = $this->createEntityInstance(TrunksLcrRuleTarget::class);
        (function () use ($fixture) {
            $this->setLcrId(1);
            $this->setPriority(11);
            $this->setWeight(30);
            $this->setRule($fixture->getReference('_reference_KamTrunksLcrRule3'));
            $this->setGw($fixture->getReference('_reference_KamTrunksLcrGateway2'));
            $this->setOutgoingRouting($fixture->getReference('_reference_ProviderOutgoingRouting2'));
        })->call($item3);

        $this->addReference('_reference_KamTrunksLcrRuleTarget3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        /** @var TrunksLcrRuleTargetInterface $item4 */
        $item4 = $this->createEntityInstance(TrunksLcrRuleTarget::class);
        (function () use ($fixture) {
            $this->setLcrId(1);
            $this->setPriority(1);
            $this->setWeight(5);
            $this->setRule($fixture->getReference('_reference_KamTrunksLcrRule4'));
            $this->setGw($fixture->getReference('_reference_KamTrunksLcrGateway2'));
            $this->setOutgoingRouting($fixture->getReference('_reference_ProviderOutgoingRouting1'));
        })->call($item4);

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
