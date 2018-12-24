<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtension;

class ProviderIvrExcludedExtension extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(IvrExcludedExtension::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var IvrExcludedExtension $item1 */
        $item1 = $this->createEntityInstance(IvrExcludedExtension::class);
        $item1->setIvr(
            $this->getReference('_reference_ProviderIvr1')
        );
        $item1->setExtension(
            $this->getReference('_reference_ProviderExtension1')
        );
        $this->addReference('_reference_ProviderIvrExcludedExtension1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderIvr::class,
            ProviderExtension::class
        );
    }
}
