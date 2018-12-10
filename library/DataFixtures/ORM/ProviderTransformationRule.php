<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRule;

class ProviderTransformationRule extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(TransformationRule::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item195 = $this->createEntityInstance(TransformationRule::class);
        (function () {
            $this->setType("callerout");
            $this->setDescription("From e164 to special national");
            $this->setPriority(3);
            $this->setMatchExpr("^\+34([0-9]+)\$");
            $this->setReplaceExpr("\1");
        })->call($item195);

        $item195->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet70'));
        $this->addReference('_reference_ProviderTransformationRule195', $item195);
        $this->sanitizeEntityValues($item195);
        $manager->persist($item195);

        $item832 = $this->createEntityInstance(TransformationRule::class);
        (function () {
            $this->setType("calleeout");
            $this->setDescription("From e164 to special national");
            $this->setPriority(3);
            $this->setMatchExpr("^\+34([0-9]+)\$");
            $this->setReplaceExpr("\1");
        })->call($item832);

        $item832->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet70'));
        $this->addReference('_reference_ProviderTransformationRule832', $item832);
        $this->sanitizeEntityValues($item832);
        $manager->persist($item832);

        $item1724 = $this->createEntityInstance(TransformationRule::class);
        (function () {
            $this->setType("callerin");
            $this->setDescription("From special national to e164");
            $this->setPriority(4);
            $this->setMatchExpr("^([0-9]+)\$");
            $this->setReplaceExpr("+34\1");
        })->call($item1724);

        $item1724->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet70'));
        $this->addReference('_reference_ProviderTransformationRule1724', $item1724);
        $this->sanitizeEntityValues($item1724);
        $manager->persist($item1724);

        $item2361 = $this->createEntityInstance(TransformationRule::class);
        (function () {
            $this->setType("calleein");
            $this->setDescription("From special national to e164");
            $this->setPriority(4);
            $this->setMatchExpr("^([0-9]+)\$");
            $this->setReplaceExpr("+34\1");
        })->call($item2361);

        $item2361->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet70'));
        $this->addReference('_reference_ProviderTransformationRule2361', $item2361);
        $this->sanitizeEntityValues($item2361);
        $manager->persist($item2361);

        $item2550 = $this->createEntityInstance(TransformationRule::class);
        (function () {
            $this->setType("callerin");
            $this->setDescription("From special national to e164");
            $this->setPriority(4);
            $this->setMatchExpr("^([0-9]+)\$");
            $this->setReplaceExpr("+34\1");
        })->call($item2550);

        $item2550->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet253'));
        $this->addReference('_reference_ProviderTransformationRule2550', $item2550);
        $this->sanitizeEntityValues($item2550);
        $manager->persist($item2550);

        $item2552 = $this->createEntityInstance(TransformationRule::class);
        (function () {
            $this->setType("calleein");
            $this->setDescription("From special national to e164");
            $this->setPriority(4);
            $this->setMatchExpr("^([0-9]+)\$");
            $this->setReplaceExpr("+34\1");
        })->call($item2552);

        $item2552->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet253'));
        $this->addReference('_reference_ProviderTransformationRule2552', $item2552);
        $this->sanitizeEntityValues($item2552);
        $manager->persist($item2552);

        $item2553 = $this->createEntityInstance(TransformationRule::class);
        (function () {
            $this->setType("callerout");
            $this->setDescription("From e164 to special national");
            $this->setPriority(3);
            $this->setMatchExpr("^\+34([0-9]+)\$");
            $this->setReplaceExpr("\1");
        })->call($item2553);

        $item2553->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet253'));
        $this->addReference('_reference_ProviderTransformationRule2553', $item2553);
        $this->sanitizeEntityValues($item2553);
        $manager->persist($item2553);

        $item2555 = $this->createEntityInstance(TransformationRule::class);
        (function () {
            $this->setType("calleeout");
            $this->setDescription("From e164 to special national");
            $this->setPriority(3);
            $this->setMatchExpr("^\+34([0-9]+)\$");
            $this->setReplaceExpr("\1");
        })->call($item2555);

        $item2555->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet253'));
        $this->addReference('_reference_ProviderTransformationRule2555', $item2555);
        $this->sanitizeEntityValues($item2555);
        $manager->persist($item2555);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderTransformationRuleSet::class
        );
    }
}
