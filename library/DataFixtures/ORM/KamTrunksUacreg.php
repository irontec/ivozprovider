<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacreg;

class KamTrunksUacreg extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(TrunksUacreg::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(TrunksUacreg::class);
        $item1->setLUuid("946002021");
        $item1->setRUsername("testUser");
        $item1->setRDomain("testDomain");
        $item1->setAuthUsername("testUser");
        $item1->setAuthPassword("testPasswd");
        $item1->setAuthProxy("sip:127.0.0.1");
        $item1->setExpires(3600);
        $item1->setFlags(0);
        $item1->setRegDelay(0);
        $item1->setMultiddi(false);
        $item1->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item1->setPeeringContract($this->getReference('_reference_ProviderPeeringContract1'));
        $this->addReference('_reference_KamTrunksUacreg1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class,
            ProviderPeeringContract::class
        );
    }
}
