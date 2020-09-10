<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;

class ProviderNotificationTemplate extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(NotificationTemplate::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var NotificationTemplateInterface $item1 */
        $item1 = $this->createEntityInstance(NotificationTemplate::class);
        (function () use ($fixture) {
            $this->setName("Voicemail notification");
            $this->setType("voicemail");
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
        })->call($item1);

        $this->addReference('_reference_ProviderNotificationTemplate1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);


        /** @var NotificationTemplateInterface $item2 */
        $item2 = $this->createEntityInstance(NotificationTemplate::class);
        (function () use ($fixture) {
            $this->setName("CallCsv notification");
            $this->setType("callCsv");
        })->call($item2);

        $this->addReference('_reference_ProviderNotificationTemplate2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        /** @var NotificationTemplateInterface $item3 */
        $item3 = $this->createEntityInstance(NotificationTemplate::class);
        (function () use ($fixture) {
            $this->setName("Max daily usage notification");
            $this->setType(
                NotificationTemplateInterface::TYPE_MAXDAILYUSAGE
            );
        })->call($item3);

        $this->addReference('_reference_ProviderNotificationTemplate3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class
        );
    }
}
