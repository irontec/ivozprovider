<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
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
