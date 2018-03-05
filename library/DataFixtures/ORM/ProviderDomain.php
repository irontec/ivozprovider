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
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Domain::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(Domain::class);
        $item1->setDomain("users.ivozprovider.local");
        $item1->setDescription("Minimal proxyusers global domain");
        $this->addReference('_reference_ProviderDomain1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstanceWithPublicMethods(Domain::class);
        $item2->setDomain("trunks.ivozprovider.local");
        $item2->setPointsTo("proxytrunks");
        $item2->setDescription("Minimal proxytrunks global domain");
        $this->addReference('_reference_ProviderDomain2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstanceWithPublicMethods(Domain::class);
        $item3->setDomain("127.0.0.1");
        $item3->setDescription("DemoCompany proxyusers domain");
        $this->addReference('_reference_ProviderDomain3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstanceWithPublicMethods(Domain::class);
        $item4->setDomain("sip.irontec.com");
        $item4->setDescription("Irontec_e2e proxyusers domain");
        $this->addReference('_reference_ProviderDomain4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);

        $item5 = $this->createEntityInstanceWithPublicMethods(Domain::class);
        $item5->setDomain("test.irontec.com");
        $item5->setDescription("Irontec Test Company proxyusers domain");
        $this->addReference('_reference_ProviderDomain5', $item5);
        $this->sanitizeEntityValues($item5);
        $manager->persist($item5);


        $item6 = $this->createEntityInstanceWithPublicMethods(Domain::class);
        $item6->setDomain("retail.irontec.com");
        $item6->setDescription("Irontec Test Company retail domain");
        $this->sanitizeEntityValues($item6);
        $this->addReference('_reference_ProviderDomain6', $item6);
        $manager->persist($item6);

        $manager->flush();
    }
}
