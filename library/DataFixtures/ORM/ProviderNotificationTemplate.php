<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Brand\Brand;
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

        /** @var NotificationTemplateInterface $item4 */
        $item4 = $this->createEntityInstance(NotificationTemplate::class);
        (function () use ($fixture) {
            $this->setName("Invoice notification");
            $this->setType(
                NotificationTemplateInterface::TYPE_INVOICE
            );
        })->call($item4);

        $this->addReference('_reference_ProviderNotificationTemplate4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);

        /** @var NotificationTemplateInterface $item4 */
        $item5 = $this->createEntityInstance(NotificationTemplate::class);
        (function () use ($fixture) {
            $this->setName("Access Credentials");
            $this->setType(
                NotificationTemplateInterface::TYPE_ACCESSCREDENTIALS
            );
        })->call($item5);


        $this->addReference('_reference_ProviderNotificationTemplate5', $item5);
        $this->sanitizeEntityValues($item5);
        $manager->persist($item5);

        /** @var NotificationTemplateInterface $item6 */
        $item6 = $this->createEntityInstance(NotificationTemplate::class);
        (function () use ($fixture) {
            $this->setName("Generic On Demand Recording Notification Template");
            $this->setType(
                NotificationTemplateInterface::TYPE_ONDEMANDRECORD
            );
        })->call($item6);

        $this->addReference('_reference_ProviderNotificationTemplate6', $item6);
        $this->sanitizeEntityValues($item6);
        $manager->persist($item6);

        /** @var NotificationTemplateInterface $item7 */
        $item7 = $this->createEntityInstance(NotificationTemplate::class);
        (function () use ($fixture) {
            $this->setName("Brand On Demand Recording Notification Template");
            $this->setType(
                NotificationTemplateInterface::TYPE_ONDEMANDRECORD
            );
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
        })->call($item7);

        $this->addReference('_reference_ProviderNotificationTemplate7', $item7);
        $this->sanitizeEntityValues($item7);
        $manager->persist($item7);

        /** @var NotificationTemplateInterface $item8 */
        $item8 = $this->createEntityInstance(NotificationTemplate::class);
        (function () use ($fixture) {
            $this->setName("Company On Demand Recording Notification Template");
            $this->setType(
                NotificationTemplateInterface::TYPE_ONDEMANDRECORD
            );
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
        })->call($item8);

        $this->addReference('_reference_ProviderNotificationTemplate8', $item8);
        $this->sanitizeEntityValues($item8);
        $manager->persist($item8);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class
        );
    }
}
