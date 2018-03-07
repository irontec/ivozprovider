<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOut;

class ProviderFaxesInOut extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(FaxesInOut::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var FaxesInOut $item1 */
        $item1 = $this->createEntityInstanceWithPublicMethods(FaxesInOut::class);
        $item1->setCalldate(new \DateTime('2018-01-01'));
        $item1->setFax(
            $this->getReference('_reference_ProviderFax1')
        );
        $item1->setSrc('34688888888');
        $item1->setDst('34688888881');
        $item1->setType('In');
        $item1->setStatus('error');
        $this->addReference('_reference_ProviderFaxesInOut1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderFax::class
        );
    }
}
