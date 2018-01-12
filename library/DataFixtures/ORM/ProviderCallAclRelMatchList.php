<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchList;

class ProviderCallAclRelMatchList extends Fixture
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(CallAclRelMatchList::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
    
        $manager->flush();
    }

}
