<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContent;
use Ivoz\Provider\Domain\Model\NotificationTemplateContent\NotificationTemplateContentInterface;

class ProviderNotificationTemplateContent extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(NotificationTemplateContent::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var NotificationTemplateContentInterface $item1 */
        $item1 = $this->createEntityInstance(NotificationTemplateContent::class);
        (function () use ($fixture) {
            $this->setFromName("IvozProvider Notification");
            $this->setFromAddress("no-reply@ivozprovider.com");
            $this->setSubject("test subject");
            $this->setBody("test body");
            $this->setNotificationTemplate($fixture->getReference('_reference_ProviderNotificationTemplate1'));
            $this->setLanguage($fixture->getReference('_reference_ProviderLanguage1'));
        })->call($item1);

        $this->addReference('_reference_ProviderNotificationTemplateContent1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        /** @var NotificationTemplateContentInterface $item2 */
        $item2 = $this->createEntityInstance(NotificationTemplateContent::class);
        (function () use ($fixture) {
            $this->setFromName("IvozProvider Notification");
            $this->setFromAddress("no-reply@ivozprovider.com");
            $this->setSubject("test subject");
            $this->setBody("test body");
            $this->setNotificationTemplate($fixture->getReference('_reference_ProviderNotificationTemplate2'));
            $this->setLanguage($fixture->getReference('_reference_ProviderLanguage1'));
        })->call($item2);

        $this->addReference('_reference_ProviderNotificationTemplateContent2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        /** @var NotificationTemplateContentInterface $item3 */
        $item3 = $this->createEntityInstance(NotificationTemplateContent::class);
        (function () use ($fixture) {
            $this->setFromName("IvozProvider Notification");
            $this->setFromAddress("no-reply@ivozprovider.com");
            $this->setSubject("test subject");
            $this->setBody("test body");
            $this->setNotificationTemplate($fixture->getReference('_reference_ProviderNotificationTemplate3'));
            $this->setLanguage($fixture->getReference('_reference_ProviderLanguage1'));
        })->call($item3);

        $this->addReference('_reference_ProviderNotificationTemplateContent3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        /** @var NotificationTemplateContentInterface $item4 */
        $item4 = $this->createEntityInstance(NotificationTemplateContent::class);
        (function () use ($fixture) {
            $this->setFromName("IvozProvider Notification");
            $this->setFromAddress("no-reply@ivozprovider.com");
            $this->setSubject("On-demand recording");
            $this->setBody("On-demand recording attached.");
            $this->setNotificationTemplate($fixture->getReference('_reference_ProviderNotificationTemplate6'));
            $this->setLanguage($fixture->getReference('_reference_ProviderLanguage1'));
        })->call($item4);

        $this->addReference('_reference_ProviderNotificationTemplateContent4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);

        /** @var NotificationTemplateContentInterface $item5 */
        $item5 = $this->createEntityInstance(NotificationTemplateContent::class);
        (function () use ($fixture) {
            $this->setFromName("IvozProvider Notification");
            $this->setFromAddress("no-reply@ivozprovider.com");
            $this->setSubject("Brand on-demand recording");
            $this->setBody("Brand on-demand recording attached.");
            $this->setNotificationTemplate($fixture->getReference('_reference_ProviderNotificationTemplate7'));
            $this->setLanguage($fixture->getReference('_reference_ProviderLanguage1'));
        })->call($item5);

        $this->addReference('_reference_ProviderNotificationTemplateContent5', $item5);
        $this->sanitizeEntityValues($item5);
        $manager->persist($item5);

        /** @var NotificationTemplateContentInterface $item6 */
        $item6 = $this->createEntityInstance(NotificationTemplateContent::class);
        (function () use ($fixture) {
            $this->setFromName("IvozProvider Notification");
            $this->setFromAddress("no-reply@ivozprovider.com");
            $this->setSubject("Company on-demand recording");
            $this->setBody("Company on-demand recording attached.");
            $this->setNotificationTemplate($fixture->getReference('_reference_ProviderNotificationTemplate8'));
            $this->setLanguage($fixture->getReference('_reference_ProviderLanguage1'));
        })->call($item6);

        $this->addReference('_reference_ProviderNotificationTemplateContent6', $item6);
        $this->sanitizeEntityValues($item6);
        $manager->persist($item6);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderLanguage::class,
            ProviderNotificationTemplate::class
        );
    }
}
