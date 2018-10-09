<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Destination\Destination;
use Ivoz\Provider\Domain\Model\Destination\Name;
use Ivoz\Provider\Domain\Model\Destination\DestinationInterface;

class ProviderDestination extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Destination::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var DestinationInterface $item1 */
        $item1 = $this->createEntityInstanceWithPublicMethods(Destination::class);
        $item1->setPrefix("+94600");
        $item1->setName(new Name('Bilbao', 'Bilbao'));
        $item1->setBrand($this->getReference('_reference_ProviderBrand1'));

        $this->addReference('_reference_ProviderDestination1', $item1);

        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        /** @var DestinationInterface $item1 */
        $item2 = $this->createEntityInstanceWithPublicMethods(Destination::class);
        $item2->setPrefix("+94601");
        $item2->setName(new Name('Usansolocity', 'Usansolocity'));
        $item2->setBrand($this->getReference('_reference_ProviderBrand1'));

        $this->addReference('_reference_ProviderDestination2', $item2);

        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class
        );
    }
}
