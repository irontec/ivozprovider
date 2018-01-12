<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Kam\Domain\Model\PikeTrusted\PikeTrusted;

class KamPikeTrusted extends Fixture
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(PikeTrusted::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(PikeTrusted::class);
        $item1->setSrcIp("194.30.6.32");
        $item1->setProto("any");
        $item1->setTag("Sarenet");
        $item1->setPriority(0);
        $this->addReference('_reference_IvozKamDomainModelPikeTrustedPikeTrusted1', $item1);
        $manager->persist($item1);

    
        $manager->flush();
    }

}
