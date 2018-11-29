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

        $item1 = $this->createEntityInstance(Domain::class);
        (function () {
            $this->setDomain("users.ivozprovider.local");
            $this->setDescription("Minimal proxyusers global domain");
        })->call($item1);

        $this->addReference('_reference_ProviderDomain1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(Domain::class);
        (function () {
            $this->setDomain("trunks.ivozprovider.local");
            $this->setPointsTo("proxytrunks");
            $this->setDescription("Minimal proxytrunks global domain");
        })->call($item2);

        $this->addReference('_reference_ProviderDomain2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstance(Domain::class);
        (function () {
            $this->setDomain("127.0.0.1");
            $this->setDescription("DemoCompany proxyusers domain");
        })->call($item3);
        $this->addReference('_reference_ProviderDomain3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstance(Domain::class);
        (function () {
            $this->setDomain("sip.irontec.com");
            $this->setDescription("Irontec_e2e proxyusers domain");
        })->call($item4);

        $this->addReference('_reference_ProviderDomain4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);

        $item5 = $this->createEntityInstance(Domain::class);
        (function () {
            $this->setDomain("test.irontec.com");
            $this->setDescription("Irontec Test Company proxyusers domain");
        })->call($item5);

        $this->addReference('_reference_ProviderDomain5', $item5);
        $this->sanitizeEntityValues($item5);
        $manager->persist($item5);

        $item6 = $this->createEntityInstance(Domain::class);
        (function () {
            $this->setDomain("retail.irontec.com");
            $this->setDescription("Irontec Test Company retail domain");
        })->call($item6);

        $this->sanitizeEntityValues($item6);
        $this->addReference('_reference_ProviderDomain6', $item6);
        $manager->persist($item6);

        $manager->flush();
    }
}
