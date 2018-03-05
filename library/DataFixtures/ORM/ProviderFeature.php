<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Feature\Feature;
use Ivoz\Provider\Domain\Model\Feature\Name;

class ProviderFeature extends Fixture
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Feature::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(Feature::class);
        $item1->setIden("queues");
        $item1->setName(new Name('en', 'es'));
        $this->addReference('_reference_ProviderFeature1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstanceWithPublicMethods(Feature::class);
        $item2->setIden("recordings");
        $item2->setName(new Name('en', 'es'));
        $this->addReference('_reference_ProviderFeature2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstanceWithPublicMethods(Feature::class);
        $item3->setIden("faxes");
        $item3->setName(new Name('en', 'es'));
        $this->addReference('_reference_ProviderFeature3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstanceWithPublicMethods(Feature::class);
        $item4->setIden("friends");
        $item4->setName(new Name('en', 'es'));
        $this->addReference('_reference_ProviderFeature4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);

        $item5 = $this->createEntityInstanceWithPublicMethods(Feature::class);
        $item5->setIden("conferences");
        $item5->setName(new Name('en', 'es'));
        $this->addReference('_reference_ProviderFeature5', $item5);
        $this->sanitizeEntityValues($item5);
        $manager->persist($item5);

        $item6 = $this->createEntityInstanceWithPublicMethods(Feature::class);
        $item6->setIden("billing");
        $item6->setName(new Name('en', 'es'));
        $this->addReference('_reference_ProviderFeature6', $item6);
        $this->sanitizeEntityValues($item6);
        $manager->persist($item6);

        $item7 = $this->createEntityInstanceWithPublicMethods(Feature::class);
        $item7->setIden("invoices");
        $item7->setName(new Name('en', 'es'));
        $this->addReference('_reference_ProviderFeature7', $item7);
        $this->sanitizeEntityValues($item7);
        $manager->persist($item7);

        $item8 = $this->createEntityInstanceWithPublicMethods(Feature::class);
        $item8->setIden("progress");
        $item8->setName(new Name('en', 'es'));
        $this->addReference('_reference_ProviderFeature8', $item8);
        $this->sanitizeEntityValues($item8);
        $manager->persist($item8);

        $item9 = $this->createEntityInstanceWithPublicMethods(Feature::class);
        $item9->setIden("retail");
        $item9->setName(new Name('en', 'es'));
        $this->addReference('_reference_ProviderFeature9', $item9);
        $this->sanitizeEntityValues($item9);
        $manager->persist($item9);

    
        $manager->flush();
    }

}
