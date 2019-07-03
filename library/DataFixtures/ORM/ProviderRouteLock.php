<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\RouteLock\RouteLock;
use Ivoz\Provider\Domain\Model\RouteLock\RouteLockInterface;

class ProviderRouteLock extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(RouteLock::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var RouteLockInterface $item1 */
        $item1 = $this->createEntityInstance(RouteLock::class);
        (function () {
            $this->setName('Lock name');
            $this->setDescription('Lock description');
            $this->setOpen(true);
        })->call($item1);

        $item1->setCompany($this->getReference('_reference_ProviderCompany1'));
        $this->addReference('_reference_ProviderRouteLock1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        /** @var RouteLockInterface $item2 */
        $item2 = $this->createEntityInstance(RouteLock::class);
        (function () {
            $this->setName('Test Lock');
            $this->setDescription('Test Lock');
            $this->setOpen(true);
        })->call($item2);

        $item2->setCompany($this->getReference('_reference_ProviderCompany1'));
        $this->addReference('_reference_ProviderRouteLock2', $item2);
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
