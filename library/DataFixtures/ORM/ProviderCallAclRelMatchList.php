<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchList;

class ProviderCallAclRelMatchList extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(CallAclRelMatchList::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var CallAclRelMatchList $item1 */
        $item1 = $this->createEntityInstance(CallAclRelMatchList::class);
        (function () {
            $this->setPriority(1);
            $this->setPolicy("allow");
        })->call($item1);

        $item1->setCallAcl(
            $this->getReference('_reference_ProviderCallAcl1')
        );
        $item1->setMatchList(
            $this->getReference('_reference_ProviderMatchList1')
        );
        $this->addReference('_reference_ProviderCallAclRelMatchListCallAclRelMatchList1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCallAcl::class,
            ProviderMatchList::class
        );
    }
}
