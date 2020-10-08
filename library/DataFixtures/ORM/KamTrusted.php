<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Kam\Domain\Model\Trusted\Trusted;

class KamTrusted extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Trusted::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(Trusted::class);
        (function () use ($fixture) {
            $this->setSrcIp("194.30.6.32");
            $this->setProto("any");
            $this->setTag("Sarenet");
            $this->setPriority(0);
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
        })->call($item1);

        $this->addReference('_reference_KamTrusted1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
        );
    }
}
