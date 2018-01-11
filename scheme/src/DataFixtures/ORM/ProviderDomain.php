<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Domain\Domain;

class ProviderDomain extends Fixture
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager->getClassMetadata(Domain::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(Domain::class);
        $item1->setDomain("users.ivozprovider.local");
        $item1->setDescription("Minimal proxyusers global domain");
        $this->addReference('_reference_IvozProviderDomainModelDomainDomain1', $item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstanceWithPublicMethods(Domain::class);
        $item2->setDomain("trunks.ivozprovider.local");
        $item2->setPointsTo("proxytrunks");
        $item2->setDescription("Minimal proxytrunks global domain");
        $this->addReference('_reference_IvozProviderDomainModelDomainDomain2', $item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstanceWithPublicMethods(Domain::class);
        $item3->setDomain("127.0.0.1");
        $item3->setDescription("DemoCompany proxyusers domain");
        $this->addReference('_reference_IvozProviderDomainModelDomainDomain3', $item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstanceWithPublicMethods(Domain::class);
        $item4->setDomain("sip.irontec.com");
        $item4->setDescription("Irontec_e2e proxyusers domain");
        $this->addReference('_reference_IvozProviderDomainModelDomainDomain4', $item4);
        $manager->persist($item4);

        $item5 = $this->createEntityInstanceWithPublicMethods(Domain::class);
        $item5->setDomain("test.irontec.com");
        $item5->setDescription("Irontec Test Company proxyusers domain");
        $this->addReference('_reference_IvozProviderDomainModelDomainDomain5', $item5);
        $manager->persist($item5);

    
        $manager->flush();
    }
}
