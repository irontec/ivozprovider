<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface;
use Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTag;

class ProviderCompaniesRelRoutingTag extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(CompanyRelRoutingTag::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var CompanyRelRoutingTagInterface $item1 */
        $item1 = $this->createEntityInstance(CompanyRelRoutingTag::class);
        (function () use ($fixture) {

            $this->setCompany($fixture->getReference('_reference_ProviderCompany3'));
            $this->setRoutingTag($fixture->getReference('_reference_ProviderRoutingTag1'));
        })->call($item1);

        $this->addReference('_reference_ProviderCompaniesRelRoutingTag1', $item1);

        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
            ProviderRoutingTag::class,
        );
    }
}
