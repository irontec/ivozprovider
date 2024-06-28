<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOut;
use Ivoz\Provider\Domain\Model\FaxesInOut\File;

class ProviderFaxesInOut extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(FaxesInOut::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var FaxesInOut $item1 */
        $item1 = $this->createEntityInstance(FaxesInOut::class);
        (function () use ($fixture) {
            $this->calldate = new \DateTime('2018-01-01', new \DateTimeZone('UTC'));
            $this->setSrc('34688888888');
            $this->setDst('34688888881');
            $this->setType('In');
            $this->setStatus('error');
            $this->setFax(
                $fixture->getReference('_reference_ProviderFax1')
            );
            $this->file = new File(null, null, null);
        })->call($item1);

        $this->addReference('_reference_ProviderFaxesInOut1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        /** @var FaxesInOut $item2 */
        $item2 = $this->createEntityInstance(FaxesInOut::class);
        (function () use ($fixture) {
            $this->calldate = new \DateTime('2018-01-02', new \DateTimeZone('UTC'));
            $this->setSrc('34688888888');
            $this->setDst('34688888881');
            $this->setType('In');
            $this->setStatus('completed');
            $this->setFax(
                $fixture->getReference('_reference_ProviderFax1')
            );
            $this->file = new File(null, null, null);
        })->call($item2);

        $this->addReference('_reference_ProviderFaxesInOut2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        /** @var FaxesInOut $item3 */
        $item3 = $this->createEntityInstance(FaxesInOut::class);
        (function () use ($fixture) {
            $this->calldate = new \DateTime('2018-01-02', new \DateTimeZone('UTC'));
            $this->setSrc('34688888888');
            $this->setDst('34688888881');
            $this->setType('Out');
            $this->setStatus('error');
            $this->setFax(
                $fixture->getReference('_reference_ProviderFax1')
            );
            $this->file = new File(null, null, null);
        })->call($item3);

        $this->addReference('_reference_ProviderFaxesInOut3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        /** @var FaxesInOut $item3 */
        $item4 = $this->createEntityInstance(FaxesInOut::class);
        (function () use ($fixture) {
            $this->calldate = new \DateTime('2018-01-02', new \DateTimeZone('UTC'));
            $this->setSrc('34688888888');
            $this->setDst('34688888881');
            $this->setType('Out');
            $this->setStatus('error');
            $this->setFax(
                $fixture->getReference('_reference_ProviderFax2')
            );
            $this->file = new File(null, null, null);
        })->call($item4);

        $this->addReference('_reference_ProviderFaxesInOut4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderFax::class
        );
    }
}
