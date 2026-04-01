<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Webhook\Webhook;

class ProviderWebhook extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Webhook::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(Webhook::class);
        (function () use ($fixture) {
            $this->setName("Start Webhook Company 1");
            $this->setUri("https://webhook.company1.com/start");
            $this->setEventStart(true);
            $this->setEventRing(false);
            $this->setEventAnswer(false);
            $this->setEventEnd(false);
            $this->setTemplate('{"event": "start", "callId": "{callId}"}');
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
        })->call($item1);
        $this->addReference('__reference_Webhook1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(Webhook::class);
        (function () use ($fixture) {
            $this->setName("Answer Webhook Company 1");
            $this->setUri("https://webhook.company1.com/answer");
            $this->setEventStart(false);
            $this->setEventRing(false);
            $this->setEventAnswer(true);
            $this->setEventEnd(false);
            $this->setTemplate('{"event": "answer", "callId": "{callId}"}');
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
        })->call($item2);
        $this->addReference('__reference_Webhook2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstance(Webhook::class);
        (function () use ($fixture) {
            $this->setName("All Events Webhook Company 2");
            $this->setUri("https://webhook.company2.com/all");
            $this->setEventStart(true);
            $this->setEventRing(true);
            $this->setEventAnswer(true);
            $this->setEventEnd(true);
            $this->setTemplate('{"event": "{event}", "callId": "{callId}"}');
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setCompany($fixture->getReference('_reference_ProviderCompany2'));
        })->call($item3);
        $this->addReference('__reference_Webhook3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstance(Webhook::class);
        (function () use ($fixture) {
            $this->setName("Brand Level Webhook");
            $this->setUri("https://webhook.brand.com/events");
            $this->setEventStart(true);
            $this->setEventRing(false);
            $this->setEventAnswer(false);
            $this->setEventEnd(true);
            $this->setTemplate('{"event": "{event}", "brand": "{brandId}"}');
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
        })->call($item4);
        $this->addReference('__reference_Webhook4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);

        $item5 = $this->createEntityInstance(Webhook::class);
        (function () use ($fixture) {
            $this->setName("DDI Specific Webhook");
            $this->setUri("https://webhook.ddi.com/123456");
            $this->setEventStart(false);
            $this->setEventRing(true);
            $this->setEventAnswer(false);
            $this->setEventEnd(false);
            $this->setTemplate('{"event": "ring", "ddi": "{ddiId}"}');
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setDdi($fixture->getReference('_reference_ProviderDdi1'));
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
        })->call($item5);
        $this->addReference('__reference_Webhook5', $item5);
        $this->sanitizeEntityValues($item5);
        $manager->persist($item5);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
            ProviderBrand::class,
            ProviderDdi::class,
        );
    }
}
