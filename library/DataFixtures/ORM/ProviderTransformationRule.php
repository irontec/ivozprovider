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

        $item195 = $this->createEntityInstanceWithPublicMethods(TransformationRule::class);
        $item195->setType("callerout");
        $item195->setDescription("From e164 to special national");
        $item195->setPriority(3);
        $item195->setMatchExpr("^\+34([0-9]+)\$");
        $item195->setReplaceExpr("\1");
        $item195->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet70'));
        $this->addReference('_reference_ProviderTransformationRule195', $item195);
        $manager->persist($item195);

        $item832 = $this->createEntityInstanceWithPublicMethods(TransformationRule::class);
        $item832->setType("calleeout");
        $item832->setDescription("From e164 to special national");
        $item832->setPriority(3);
        $item832->setMatchExpr("^\+34([0-9]+)\$");
        $item832->setReplaceExpr("\1");
        $item832->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet70'));
        $this->addReference('_reference_ProviderTransformationRule832', $item832);
        $manager->persist($item832);

        $item1724 = $this->createEntityInstanceWithPublicMethods(TransformationRule::class);
        $item1724->setType("callerin");
        $item1724->setDescription("From special national to e164");
        $item1724->setPriority(4);
        $item1724->setMatchExpr("^([0-9]+)\$");
        $item1724->setReplaceExpr("+34\1");
        $item1724->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet70'));
        $this->addReference('_reference_ProviderTransformationRule1724', $item1724);
        $manager->persist($item1724);

        $item2361 = $this->createEntityInstanceWithPublicMethods(TransformationRule::class);
        $item2361->setType("calleein");
        $item2361->setDescription("From special national to e164");
        $item2361->setPriority(4);
        $item2361->setMatchExpr("^([0-9]+)\$");
        $item2361->setReplaceExpr("+34\1");
        $item2361->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet70'));
        $this->addReference('_reference_ProviderTransformationRule2361', $item2361);
        $manager->persist($item2361);

        $item2550 = $this->createEntityInstanceWithPublicMethods(TransformationRule::class);
        $item2550->setType("callerin");
        $item2550->setDescription("From special national to e164");
        $item2550->setPriority(4);
        $item2550->setMatchExpr("^([0-9]+)\$");
        $item2550->setReplaceExpr("+34\1");
        $item2550->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet253'));
        $this->addReference('_reference_ProviderTransformationRule2550', $item2550);
        $manager->persist($item2550);

        $item2552 = $this->createEntityInstanceWithPublicMethods(TransformationRule::class);
        $item2552->setType("calleein");
        $item2552->setDescription("From special national to e164");
        $item2552->setPriority(4);
        $item2552->setMatchExpr("^([0-9]+)\$");
        $item2552->setReplaceExpr("+34\1");
        $item2552->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet253'));
        $this->addReference('_reference_ProviderTransformationRule2552', $item2552);
        $manager->persist($item2552);

        $item2553 = $this->createEntityInstanceWithPublicMethods(TransformationRule::class);
        $item2553->setType("callerout");
        $item2553->setDescription("From e164 to special national");
        $item2553->setPriority(3);
        $item2553->setMatchExpr("^\+34([0-9]+)\$");
        $item2553->setReplaceExpr("\1");
        $item2553->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet253'));
        $this->addReference('_reference_ProviderTransformationRule2553', $item2553);
        $manager->persist($item2553);

        $item2555 = $this->createEntityInstanceWithPublicMethods(TransformationRule::class);
        $item2555->setType("calleeout");
        $item2555->setDescription("From e164 to special national");
        $item2555->setPriority(3);
        $item2555->setMatchExpr("^\+34([0-9]+)\$");
        $item2555->setReplaceExpr("\1");
        $item2555->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet253'));
        $this->addReference('_reference_ProviderTransformationRule2555', $item2555);
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
