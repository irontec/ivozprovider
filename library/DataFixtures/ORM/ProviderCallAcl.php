<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\CallAcl\CallAcl;

class ProviderCallAcl extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(CallAcl::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstance(CallAcl::class);
        (function () {
            $this->setName("testACL");
            $this->setDefaultPolicy("allow");
        })->call($item1);
        $item1->setCompany($this->getReference('_reference_ProviderCompany1'));

        $this->addReference('_reference_ProviderCallAcl1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(CallAcl::class);
        (function () {
            $this->setName("testACL2");
            $this->setDefaultPolicy("deny");
        })->call($item2);
        $item2->setCompany($this->getReference('_reference_ProviderCompany1'));

        $this->addReference('_reference_ProviderCallAcl2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class
        );
    }
}
