<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Recording\Recording;
use Ivoz\Provider\Domain\Model\Recording\RecordedFile;

class ProviderRecording extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Recording::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var Recording $item1 */
        $item1 = $this->createEntityInstance(Recording::class);

        $item1->setCompany(
            $this->getReference('_reference_ProviderCompany1')
        );
        (function () {
            $this->setCallid('7602fd7f-4153-4475-9100-d89ff70cdf76');
            $this->setCalldate(new \DateTime('2017-01-05 00:15:15', new \DateTimeZone('UTC')));
            $this->setType('ondemand');
            $this->setDuration(3);
            $this->setCaller('34946002020');
            $this->setCallee('34946002021');
            $this->setRecordedFile(new RecordedFile(
                4280,
                'audio/mpeg; charset=binary',
                '7602fd7f-4153-4475-9100-d89ff70cdf76.0.mp3'
            ));
        })->call($item1);

        $this->addReference('_reference_ProviderRecording1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class
        );
    }
}
