<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHold;
use Ivoz\Provider\Domain\Model\MusicOnHold\OriginalFile;
use Ivoz\Provider\Domain\Model\MusicOnHold\EncodedFile;

class ProviderMusicOnHold extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager->getClassMetadata(MusicOnHold::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(MusicOnHold::class);
        $item1->setName("Something good");
        $item1->setOriginalFile(new OriginalFile(null, null, null));
        $item1->setEncodedFile(new EncodedFile(null, null, null));
        $item1->setBrand($this->getReference('_reference_IvozProviderDomainModelBrandBrand1'));
        $this->addReference('_reference_IvozProviderDomainModelMusicOnHoldMusicOnHold1', $item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstanceWithPublicMethods(MusicOnHold::class);
        $item2->setName("Something good");
        $item2->setOriginalFile(new OriginalFile(null, null, null));
        $item2->setEncodedFile(new EncodedFile(null, null, null));
        $item2->setCompany($this->getReference('_reference_IvozProviderDomainModelCompanyCompany1'));
        $this->addReference('_reference_IvozProviderDomainModelMusicOnHoldMusicOnHold2', $item2);
        $manager->persist($item2);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
            ProviderBrand::class
        );
    }


}
