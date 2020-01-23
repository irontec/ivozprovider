<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Timezone\Timezone;
use Ivoz\Provider\Domain\Model\Timezone\Label;

class ProviderTimezone extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Timezone::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Andorra");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry1'));
        })->call($item1);

        $this->addReference('_reference_ProviderTimezone1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);
        $item2 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Dubai");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry58'));
        })->call($item2);

        $this->addReference('_reference_ProviderTimezone2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);
        $item3 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Kabul");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry1'));
        })->call($item3);

        $this->addReference('_reference_ProviderTimezone3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);
        $item4 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Antigua");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry8'));
        })->call($item4);

        $this->addReference('_reference_ProviderTimezone4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);
        $item5 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Anguilla");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry6'));
        })->call($item5);

        $this->addReference('_reference_ProviderTimezone5', $item5);
        $this->sanitizeEntityValues($item5);
        $manager->persist($item5);
        $item6 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Tirane");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry2'));
        })->call($item6);

        $this->addReference('_reference_ProviderTimezone6', $item6);
        $this->sanitizeEntityValues($item6);
        $manager->persist($item6);
        $item7 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Yerevan");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry12'));
        })->call($item7);

        $this->addReference('_reference_ProviderTimezone7', $item7);
        $this->sanitizeEntityValues($item7);
        $manager->persist($item7);

        $item8 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Luanda");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry5'));
        })->call($item8);

        $this->addReference('_reference_ProviderTimezone8', $item8);
        $this->sanitizeEntityValues($item8);
        $manager->persist($item8);

        $item9 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Antarctica/McMurdo");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry7'));
        })->call($item9);

        $this->addReference('_reference_ProviderTimezone9', $item9);
        $this->sanitizeEntityValues($item9);
        $manager->persist($item9);

        $item10 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Antarctica/Rothera");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry7'));
        })->call($item10);

        $this->addReference('_reference_ProviderTimezone10', $item10);
        $this->sanitizeEntityValues($item10);
        $manager->persist($item10);

        $item11 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Antarctica/Palmer");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry7'));
        })->call($item11);

        $this->addReference('_reference_ProviderTimezone11', $item11);
        $this->sanitizeEntityValues($item11);
        $manager->persist($item11);
        $item12 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Antarctica/Mawson");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry7'));
        })->call($item12);

        $this->addReference('_reference_ProviderTimezone12', $item12);
        $this->sanitizeEntityValues($item12);
        $manager->persist($item12);

        $item13 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Antarctica/Davis");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry7'));
        })->call($item13);

        $this->addReference('_reference_ProviderTimezone13', $item13);
        $this->sanitizeEntityValues($item13);
        $manager->persist($item13);

        $item14 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Antarctica/Casey");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry7'));
        })->call($item14);

        
        $this->addReference('_reference_ProviderTimezone14', $item14);
        $this->sanitizeEntityValues($item14);
        $manager->persist($item14);
        $item15 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Antarctica/Vostok");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry7'));
        })->call($item15);

        $this->addReference('_reference_ProviderTimezone15', $item15);
        $this->sanitizeEntityValues($item15);
        $manager->persist($item15);
        $item16 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Antarctica/DumontDUrville");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry7'));
        })->call($item16);


        $this->addReference('_reference_ProviderTimezone16', $item16);
        $this->sanitizeEntityValues($item16);
        $manager->persist($item16);
        $item17 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Antarctica/Syowa");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry7'));
        })->call($item17);


        $this->addReference('_reference_ProviderTimezone17', $item17);
        $this->sanitizeEntityValues($item17);
        $manager->persist($item17);
        $item18 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Antarctica/Troll");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry7'));
        })->call($item18);


        $this->addReference('_reference_ProviderTimezone18', $item18);
        $this->sanitizeEntityValues($item18);
        $manager->persist($item18);
        $item19 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Argentina/Buenos_Aires");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry11'));
        })->call($item19);

        $this->addReference('_reference_ProviderTimezone19', $item19);
        $this->sanitizeEntityValues($item19);
        $manager->persist($item19);
        $item20 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Argentina/Cordoba");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry11'));
        })->call($item20);

        $this->addReference('_reference_ProviderTimezone20', $item20);
        $this->sanitizeEntityValues($item20);
        $manager->persist($item20);
        $item21 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Argentina/Salta");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry11'));
        })->call($item21);

        $this->addReference('_reference_ProviderTimezone21', $item21);
        $this->sanitizeEntityValues($item21);
        $manager->persist($item21);
        $item22 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Argentina/Jujuy");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry11'));
        })->call($item22);

        $this->addReference('_reference_ProviderTimezone22', $item22);
        $this->sanitizeEntityValues($item22);
        $manager->persist($item22);
        $item23 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Argentina/Tucuman");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry11'));
        })->call($item23);

        $this->addReference('_reference_ProviderTimezone23', $item23);
        $this->sanitizeEntityValues($item23);
        $manager->persist($item23);
        $item24 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Argentina/Catamarca");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry11'));
        })->call($item24);

        $this->addReference('_reference_ProviderTimezone24', $item24);
        $this->sanitizeEntityValues($item24);
        $manager->persist($item24);
        $item25 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Argentina/La_Rioja");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry11'));
        })->call($item25);

        $this->addReference('_reference_ProviderTimezone25', $item25);
        $this->sanitizeEntityValues($item25);
        $manager->persist($item25);
        $item26 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Argentina/San_Juan");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry11'));
        })->call($item26);

        $this->addReference('_reference_ProviderTimezone26', $item26);
        $this->sanitizeEntityValues($item26);
        $manager->persist($item26);
        $item27 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Argentina/Mendoza");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry11'));
        })->call($item27);

        $this->addReference('_reference_ProviderTimezone27', $item27);
        $this->sanitizeEntityValues($item27);
        $manager->persist($item27);
        $item28 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Argentina/San_Luis");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry11'));
        })->call($item28);

        $this->addReference('_reference_ProviderTimezone28', $item28);
        $this->sanitizeEntityValues($item28);
        $manager->persist($item28);
        $item29 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Argentina/Rio_Gallegos");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry11'));
        })->call($item29);

        $this->addReference('_reference_ProviderTimezone29', $item29);
        $this->sanitizeEntityValues($item29);
        $manager->persist($item29);
        $item30 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Argentina/Ushuaia");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry11'));
        })->call($item30);

        $this->addReference('_reference_ProviderTimezone30', $item30);
        $this->sanitizeEntityValues($item30);
        $manager->persist($item30);
        $item31 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Pago_Pago");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry193'));
        })->call($item31);

        $this->addReference('_reference_ProviderTimezone31', $item31);
        $this->sanitizeEntityValues($item31);
        $manager->persist($item31);
        $item32 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Vienna");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry15'));
        })->call($item32);

        $this->addReference('_reference_ProviderTimezone32', $item32);
        $this->sanitizeEntityValues($item32);
        $manager->persist($item32);
        $item33 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Australia/Lord_Howe");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry14'));
        })->call($item33);

        $this->addReference('_reference_ProviderTimezone33', $item33);
        $this->sanitizeEntityValues($item33);
        $manager->persist($item33);
        $item34 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Antarctica/Macquarie");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry14'));
        })->call($item34);

        $this->addReference('_reference_ProviderTimezone34', $item34);
        $this->sanitizeEntityValues($item34);
        $manager->persist($item34);
        $item35 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Australia/Hobart");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry14'));
        })->call($item35);

        $this->addReference('_reference_ProviderTimezone35', $item35);
        $this->sanitizeEntityValues($item35);
        $manager->persist($item35);
        $item36 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Australia/Currie");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry14'));
        })->call($item36);

        $this->addReference('_reference_ProviderTimezone36', $item36);
        $this->sanitizeEntityValues($item36);
        $manager->persist($item36);
        $item37 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Australia/Melbourne");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry14'));
        })->call($item37);

        $this->addReference('_reference_ProviderTimezone37', $item37);
        $this->sanitizeEntityValues($item37);
        $manager->persist($item37);
        $item38 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Australia/Sydney");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry14'));
        })->call($item38);

        $this->addReference('_reference_ProviderTimezone38', $item38);
        $this->sanitizeEntityValues($item38);
        $manager->persist($item38);
        $item39 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Australia/Broken_Hill");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry14'));
        })->call($item39);

        $this->addReference('_reference_ProviderTimezone39', $item39);
        $this->sanitizeEntityValues($item39);
        $manager->persist($item39);
        $item40 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Australia/Brisbane");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry14'));
        })->call($item40);

        $this->addReference('_reference_ProviderTimezone40', $item40);
        $this->sanitizeEntityValues($item40);
        $manager->persist($item40);
        $item41 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Australia/Lindeman");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry14'));
        })->call($item41);

        $this->addReference('_reference_ProviderTimezone41', $item41);
        $this->sanitizeEntityValues($item41);
        $manager->persist($item41);
        $item42 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Australia/Adelaide");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry14'));
        })->call($item42);

        $this->addReference('_reference_ProviderTimezone42', $item42);
        $this->sanitizeEntityValues($item42);
        $manager->persist($item42);
        $item43 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Australia/Darwin");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry14'));
        })->call($item43);

        $this->addReference('_reference_ProviderTimezone43', $item43);
        $this->sanitizeEntityValues($item43);
        $manager->persist($item43);
        $item44 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Australia/Perth");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry14'));
        })->call($item44);

        $this->addReference('_reference_ProviderTimezone44', $item44);
        $this->sanitizeEntityValues($item44);
        $manager->persist($item44);
        $item45 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Australia/Eucla");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry14'));
        })->call($item45);

        $this->addReference('_reference_ProviderTimezone45', $item45);
        $this->sanitizeEntityValues($item45);
        $manager->persist($item45);
        $item46 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Aruba");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry13'));
        })->call($item46);

        $this->addReference('_reference_ProviderTimezone46', $item46);
        $this->sanitizeEntityValues($item46);
        $manager->persist($item46);
        $item47 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Mariehamn");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry101'));
        })->call($item47);

        $this->addReference('_reference_ProviderTimezone47', $item47);
        $this->sanitizeEntityValues($item47);
        $manager->persist($item47);
        $item48 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Baku");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry16'));
        })->call($item48);

        $this->addReference('_reference_ProviderTimezone48', $item48);
        $this->sanitizeEntityValues($item48);
        $manager->persist($item48);
        $item49 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Sarajevo");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry27'));
        })->call($item49);

        $this->addReference('_reference_ProviderTimezone49', $item49);
        $this->sanitizeEntityValues($item49);
        $manager->persist($item49);
        $item50 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Barbados");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry20'));
        })->call($item50);

        $this->addReference('_reference_ProviderTimezone50', $item50);
        $this->sanitizeEntityValues($item50);
        $manager->persist($item50);
        $item51 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Dhaka");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry19'));
        })->call($item51);

        $this->addReference('_reference_ProviderTimezone51', $item51);
        $this->sanitizeEntityValues($item51);
        $manager->persist($item51);
        $item52 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Brussels");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry21'));
        })->call($item52);

        $this->addReference('_reference_ProviderTimezone52', $item52);
        $this->sanitizeEntityValues($item52);
        $manager->persist($item52);
        $item53 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Ouagadougou");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry32'));
        })->call($item53);

        $this->addReference('_reference_ProviderTimezone53', $item53);
        $this->sanitizeEntityValues($item53);
        $manager->persist($item53);
        $item54 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Sofia");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry31'));
        })->call($item54);

        $this->addReference('_reference_ProviderTimezone54', $item54);
        $this->sanitizeEntityValues($item54);
        $manager->persist($item54);
        $item55 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Bahrain");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry18'));
        })->call($item55);

        $this->addReference('_reference_ProviderTimezone55', $item55);
        $this->sanitizeEntityValues($item55);
        $manager->persist($item55);
        $item56 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Bujumbura");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry33'));
        })->call($item56);

        $this->addReference('_reference_ProviderTimezone56', $item56);
        $this->sanitizeEntityValues($item56);
        $manager->persist($item56);
        $item57 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Porto-Novo");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry23'));
        })->call($item57);

        $this->addReference('_reference_ProviderTimezone57', $item57);
        $this->sanitizeEntityValues($item57);
        $manager->persist($item57);
        $item58 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/St_Barthelemy");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry194'));
        })->call($item58);

        $this->addReference('_reference_ProviderTimezone58', $item58);
        $this->sanitizeEntityValues($item58);
        $manager->persist($item58);
        $item59 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Atlantic/Bermuda");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry24'));
        })->call($item59);

        $this->addReference('_reference_ProviderTimezone59', $item59);
        $this->sanitizeEntityValues($item59);
        $manager->persist($item59);
        $item60 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Brunei");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry30'));
        })->call($item60);

        $this->addReference('_reference_ProviderTimezone60', $item60);
        $this->sanitizeEntityValues($item60);
        $manager->persist($item60);
        $item61 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/La_Paz");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry26'));
        })->call($item61);

        $this->addReference('_reference_ProviderTimezone61', $item61);
        $this->sanitizeEntityValues($item61);
        $manager->persist($item61);
        $item62 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Kralendijk");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry246'));
        })->call($item62);

        $this->addReference('_reference_ProviderTimezone62', $item62);
        $this->sanitizeEntityValues($item62);
        $manager->persist($item62);
        $item63 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Noronha");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry29'));
        })->call($item63);

        $this->addReference('_reference_ProviderTimezone63', $item63);
        $this->sanitizeEntityValues($item63);
        $manager->persist($item63);
        $item64 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Belem");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry29'));
        })->call($item64);

        $this->addReference('_reference_ProviderTimezone64', $item64);
        $this->sanitizeEntityValues($item64);
        $manager->persist($item64);
        $item65 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Fortaleza");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry29'));
        })->call($item65);

        $this->addReference('_reference_ProviderTimezone65', $item65);
        $this->sanitizeEntityValues($item65);
        $manager->persist($item65);
        $item66 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Recife");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry29'));
        })->call($item66);

        $this->addReference('_reference_ProviderTimezone66', $item66);
        $this->sanitizeEntityValues($item66);
        $manager->persist($item66);
        $item67 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Araguaina");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry29'));
        })->call($item67);

        $this->addReference('_reference_ProviderTimezone67', $item67);
        $this->sanitizeEntityValues($item67);
        $manager->persist($item67);
        $item68 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Maceio");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry29'));
        })->call($item68);

        $this->addReference('_reference_ProviderTimezone68', $item68);
        $this->sanitizeEntityValues($item68);
        $manager->persist($item68);
        $item69 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Bahia");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry29'));
        })->call($item69);

        $this->addReference('_reference_ProviderTimezone69', $item69);
        $this->sanitizeEntityValues($item69);
        $manager->persist($item69);
        $item70 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Sao_Paulo");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry29'));
        })->call($item70);

        $this->addReference('_reference_ProviderTimezone70', $item70);
        $this->sanitizeEntityValues($item70);
        $manager->persist($item70);
        $item71 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Campo_Grande");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry29'));
        })->call($item71);

        $this->addReference('_reference_ProviderTimezone71', $item71);
        $this->sanitizeEntityValues($item71);
        $manager->persist($item71);
        $item72 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Cuiaba");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry29'));
        })->call($item72);

        $this->addReference('_reference_ProviderTimezone72', $item72);
        $this->sanitizeEntityValues($item72);
        $manager->persist($item72);
        $item73 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Santarem");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry29'));
        })->call($item73);

        $this->addReference('_reference_ProviderTimezone73', $item73);
        $this->sanitizeEntityValues($item73);
        $manager->persist($item73);
        $item74 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Porto_Velho");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry29'));
        })->call($item74);

        $this->addReference('_reference_ProviderTimezone74', $item74);
        $this->sanitizeEntityValues($item74);
        $manager->persist($item74);
        $item75 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Boa_Vista");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry29'));
        })->call($item75);

        $this->addReference('_reference_ProviderTimezone75', $item75);
        $this->sanitizeEntityValues($item75);
        $manager->persist($item75);
        $item76 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Manaus");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry29'));
        })->call($item76);

        $this->addReference('_reference_ProviderTimezone76', $item76);
        $this->sanitizeEntityValues($item76);
        $manager->persist($item76);
        $item77 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Eirunepe");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry29'));
        })->call($item77);

        $this->addReference('_reference_ProviderTimezone77', $item77);
        $this->sanitizeEntityValues($item77);
        $manager->persist($item77);
        $item78 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Rio_Branco");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry29'));
        })->call($item78);

        $this->addReference('_reference_ProviderTimezone78', $item78);
        $this->sanitizeEntityValues($item78);
        $manager->persist($item78);
        $item79 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Nassau");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry17'));
        })->call($item79);

        $this->addReference('_reference_ProviderTimezone79', $item79);
        $this->sanitizeEntityValues($item79);
        $manager->persist($item79);
        $item80 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Thimphu");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry34'));
        })->call($item80);

        $this->addReference('_reference_ProviderTimezone80', $item80);
        $this->sanitizeEntityValues($item80);
        $manager->persist($item80);
        $item81 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Gaborone");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry28'));
        })->call($item81);

        $this->addReference('_reference_ProviderTimezone81', $item81);
        $this->sanitizeEntityValues($item81);
        $manager->persist($item81);
        $item82 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Minsk");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry25'));
        })->call($item82);

        $this->addReference('_reference_ProviderTimezone82', $item82);
        $this->sanitizeEntityValues($item82);
        $manager->persist($item82);
        $item83 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Belize");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry22'));
        })->call($item83);

        $this->addReference('_reference_ProviderTimezone83', $item83);
        $this->sanitizeEntityValues($item83);
        $manager->persist($item83);
        $item84 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/St_Johns");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item84);

        $this->addReference('_reference_ProviderTimezone84', $item84);
        $this->sanitizeEntityValues($item84);
        $manager->persist($item84);
        $item85 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Halifax");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item85);

        $this->addReference('_reference_ProviderTimezone85', $item85);
        $this->sanitizeEntityValues($item85);
        $manager->persist($item85);
        $item86 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Glace_Bay");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item86);

        $this->addReference('_reference_ProviderTimezone86', $item86);
        $this->sanitizeEntityValues($item86);
        $manager->persist($item86);
        $item87 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Moncton");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item87);

        $this->addReference('_reference_ProviderTimezone87', $item87);
        $this->sanitizeEntityValues($item87);
        $manager->persist($item87);
        $item88 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Goose_Bay");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item88);

        $this->addReference('_reference_ProviderTimezone88', $item88);
        $this->sanitizeEntityValues($item88);
        $manager->persist($item88);
        $item89 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Blanc-Sablon");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item89);

        $this->addReference('_reference_ProviderTimezone89', $item89);
        $this->sanitizeEntityValues($item89);
        $manager->persist($item89);
        $item90 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Toronto");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item90);

        $this->addReference('_reference_ProviderTimezone90', $item90);
        $this->sanitizeEntityValues($item90);
        $manager->persist($item90);
        $item91 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Nipigon");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item91);

        $this->addReference('_reference_ProviderTimezone91', $item91);
        $this->sanitizeEntityValues($item91);
        $manager->persist($item91);
        $item92 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Thunder_Bay");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item92);

        $this->addReference('_reference_ProviderTimezone92', $item92);
        $this->sanitizeEntityValues($item92);
        $manager->persist($item92);
        $item93 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Iqaluit");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item93);

        $this->addReference('_reference_ProviderTimezone93', $item93);
        $this->sanitizeEntityValues($item93);
        $manager->persist($item93);
        $item94 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Pangnirtung");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item94);

        $this->addReference('_reference_ProviderTimezone94', $item94);
        $this->sanitizeEntityValues($item94);
        $manager->persist($item94);
        $item95 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Resolute");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item95);

        $this->addReference('_reference_ProviderTimezone95', $item95);
        $this->sanitizeEntityValues($item95);
        $manager->persist($item95);
        $item96 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Atikokan");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item96);

        $this->addReference('_reference_ProviderTimezone96', $item96);
        $this->sanitizeEntityValues($item96);
        $manager->persist($item96);
        $item97 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Rankin_Inlet");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item97);

        $this->addReference('_reference_ProviderTimezone97', $item97);
        $this->sanitizeEntityValues($item97);
        $manager->persist($item97);
        $item98 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Winnipeg");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item98);

        $this->addReference('_reference_ProviderTimezone98', $item98);
        $this->sanitizeEntityValues($item98);
        $manager->persist($item98);
        $item99 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Rainy_River");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item99);

        $this->addReference('_reference_ProviderTimezone99', $item99);
        $this->sanitizeEntityValues($item99);
        $manager->persist($item99);
        $item100 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Regina");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item100);

        $this->addReference('_reference_ProviderTimezone100', $item100);
        $this->sanitizeEntityValues($item100);
        $manager->persist($item100);
        $item101 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Swift_Current");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item101);

        $this->addReference('_reference_ProviderTimezone101', $item101);
        $this->sanitizeEntityValues($item101);
        $manager->persist($item101);
        $item102 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Edmonton");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item102);

        $this->addReference('_reference_ProviderTimezone102', $item102);
        $this->sanitizeEntityValues($item102);
        $manager->persist($item102);
        $item103 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Cambridge_Bay");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item103);

        $this->addReference('_reference_ProviderTimezone103', $item103);
        $this->sanitizeEntityValues($item103);
        $manager->persist($item103);
        $item104 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Yellowknife");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item104);

        $this->addReference('_reference_ProviderTimezone104', $item104);
        $this->sanitizeEntityValues($item104);
        $manager->persist($item104);
        $item105 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Inuvik");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item105);

        $this->addReference('_reference_ProviderTimezone105', $item105);
        $this->sanitizeEntityValues($item105);
        $manager->persist($item105);
        $item106 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Creston");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item106);

        $this->addReference('_reference_ProviderTimezone106', $item106);
        $this->sanitizeEntityValues($item106);
        $manager->persist($item106);
        $item107 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Dawson_Creek");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item107);

        $this->addReference('_reference_ProviderTimezone107', $item107);
        $this->sanitizeEntityValues($item107);
        $manager->persist($item107);
        $item108 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Vancouver");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item108);

        $this->addReference('_reference_ProviderTimezone108', $item108);
        $this->sanitizeEntityValues($item108);
        $manager->persist($item108);
        $item109 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Whitehorse");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item109);

        $this->addReference('_reference_ProviderTimezone109', $item109);
        $this->sanitizeEntityValues($item109);
        $manager->persist($item109);
        $item110 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Dawson");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry38'));
        })->call($item110);

        $this->addReference('_reference_ProviderTimezone110', $item110);
        $this->sanitizeEntityValues($item110);
        $manager->persist($item110);
        $item111 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Indian/Cocos");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry103'));
        })->call($item111);

        $this->addReference('_reference_ProviderTimezone111', $item111);
        $this->sanitizeEntityValues($item111);
        $manager->persist($item111);
        $item112 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Kinshasa");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry185'));
        })->call($item112);

        $this->addReference('_reference_ProviderTimezone112', $item112);
        $this->sanitizeEntityValues($item112);
        $manager->persist($item112);
        $item113 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Lubumbashi");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry185'));
        })->call($item113);

        $this->addReference('_reference_ProviderTimezone113', $item113);
        $this->sanitizeEntityValues($item113);
        $manager->persist($item113);
        $item114 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Bangui");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry183'));
        })->call($item114);

        $this->addReference('_reference_ProviderTimezone114', $item114);
        $this->sanitizeEntityValues($item114);
        $manager->persist($item114);
        $item115 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Brazzaville");
            $this->setLabel(new Label('', '', '', ''));
            $this->setCountry($fixture->getReference('_reference_ProviderCountry46'));
        })->call($item115);

        $this->addReference('_reference_ProviderTimezone115', $item115);
        $this->sanitizeEntityValues($item115);
        $manager->persist($item115);
        $item116 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Zurich");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry215'));
        })->call($item116);

        $this->addReference('_reference_ProviderTimezone116', $item116);
        $this->sanitizeEntityValues($item116);
        $manager->persist($item116);
        $item117 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Abidjan");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry49'));
        })->call($item117);

        $this->addReference('_reference_ProviderTimezone117', $item117);
        $this->sanitizeEntityValues($item117);
        $manager->persist($item117);
        $item118 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Rarotonga");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry104'));
        })->call($item118);

        $this->addReference('_reference_ProviderTimezone118', $item118);
        $this->sanitizeEntityValues($item118);
        $manager->persist($item118);
        $item119 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Santiago");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry40'));
        })->call($item119);

        $this->addReference('_reference_ProviderTimezone119', $item119);
        $this->sanitizeEntityValues($item119);
        $manager->persist($item119);
        $item120 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Easter");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry40'));
        })->call($item120);

        $this->addReference('_reference_ProviderTimezone120', $item120);
        $this->sanitizeEntityValues($item120);
        $manager->persist($item120);
        $item121 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Douala");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry37'));
        })->call($item121);

        $this->addReference('_reference_ProviderTimezone121', $item121);
        $this->sanitizeEntityValues($item121);
        $manager->persist($item121);
        $item122 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Shanghai");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry41'));
        })->call($item122);

        $this->addReference('_reference_ProviderTimezone122', $item122);
        $this->sanitizeEntityValues($item122);
        $manager->persist($item122);
        $item123 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Urumqi");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry41'));
        })->call($item123);

        $this->addReference('_reference_ProviderTimezone123', $item123);
        $this->sanitizeEntityValues($item123);
        $manager->persist($item123);
        $item124 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Bogota");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry44'));
        })->call($item124);

        $this->addReference('_reference_ProviderTimezone124', $item124);
        $this->sanitizeEntityValues($item124);
        $manager->persist($item124);
        $item125 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Costa_Rica");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry50'));
        })->call($item125);

        $this->addReference('_reference_ProviderTimezone125', $item125);
        $this->sanitizeEntityValues($item125);
        $manager->persist($item125);
        $item126 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Havana");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry52'));
        })->call($item126);

        $this->addReference('_reference_ProviderTimezone126', $item126);
        $this->sanitizeEntityValues($item126);
        $manager->persist($item126);
        $item127 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Atlantic/Cape_Verde");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry35'));
        })->call($item127);

        $this->addReference('_reference_ProviderTimezone127', $item127);
        $this->sanitizeEntityValues($item127);
        $manager->persist($item127);
        $item128 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Curacao");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry247'));
        })->call($item128);

        $this->addReference('_reference_ProviderTimezone128', $item128);
        $this->sanitizeEntityValues($item128);
        $manager->persist($item128);
        $item129 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Indian/Christmas");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry96'));
        })->call($item129);

        $this->addReference('_reference_ProviderTimezone129', $item129);
        $this->sanitizeEntityValues($item129);
        $manager->persist($item129);
        $item130 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Nicosia");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry42'));
        })->call($item130);

        $this->addReference('_reference_ProviderTimezone130', $item130);
        $this->sanitizeEntityValues($item130);
        $manager->persist($item130);
        $item131 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Prague");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry184'));
        })->call($item131);

        $this->addReference('_reference_ProviderTimezone131', $item131);
        $this->sanitizeEntityValues($item131);
        $manager->persist($item131);
        $item132 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Berlin");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry3'));
        })->call($item132);

        $this->addReference('_reference_ProviderTimezone132', $item132);
        $this->sanitizeEntityValues($item132);
        $manager->persist($item132);
        $item133 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Busingen");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry3'));
        })->call($item133);

        $this->addReference('_reference_ProviderTimezone133', $item133);
        $this->sanitizeEntityValues($item133);
        $manager->persist($item133);
        $item134 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Djibouti");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry243'));
        })->call($item134);

        $this->addReference('_reference_ProviderTimezone134', $item134);
        $this->sanitizeEntityValues($item134);
        $manager->persist($item134);
        $item135 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Copenhagen");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry53'));
        })->call($item135);

        $this->addReference('_reference_ProviderTimezone135', $item135);
        $this->sanitizeEntityValues($item135);
        $manager->persist($item135);
        $item136 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Dominica");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry54'));
        })->call($item136);

        $this->addReference('_reference_ProviderTimezone136', $item136);
        $this->sanitizeEntityValues($item136);
        $manager->persist($item136);
        $item137 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Santo_Domingo");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry186'));
        })->call($item137);

        $this->addReference('_reference_ProviderTimezone137', $item137);
        $this->sanitizeEntityValues($item137);
        $manager->persist($item137);
        $item138 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Algiers");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry10'));
        })->call($item138);

        $this->addReference('_reference_ProviderTimezone138', $item138);
        $this->sanitizeEntityValues($item138);
        $manager->persist($item138);
        $item139 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Guayaquil");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry55'));
        })->call($item139);

        $this->addReference('_reference_ProviderTimezone139', $item139);
        $this->sanitizeEntityValues($item139);
        $manager->persist($item139);
        $item140 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Galapagos");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry55'));
        })->call($item140);

        $this->addReference('_reference_ProviderTimezone140', $item140);
        $this->sanitizeEntityValues($item140);
        $manager->persist($item140);
        $item141 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Tallinn");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry64'));
        })->call($item141);

        $this->addReference('_reference_ProviderTimezone141', $item141);
        $this->sanitizeEntityValues($item141);
        $manager->persist($item141);
        $item142 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Cairo");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry56'));
        })->call($item142);

        $this->addReference('_reference_ProviderTimezone142', $item142);
        $this->sanitizeEntityValues($item142);
        $manager->persist($item142);
        $item143 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/El_Aaiun");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry191'));
        })->call($item143);

        $this->addReference('_reference_ProviderTimezone143', $item143);
        $this->sanitizeEntityValues($item143);
        $manager->persist($item143);
        $item144 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Asmara");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry59'));
        })->call($item144);

        $this->addReference('_reference_ProviderTimezone144', $item144);
        $this->sanitizeEntityValues($item144);
        $manager->persist($item144);
        $item145 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Madrid");
            $this->setComment("mainland");
            $this->setLabel(new Label('en', 'es', 'ca', 'it'));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item145);

        $this->addReference('_reference_ProviderTimezone145', $item145);
        $this->sanitizeEntityValues($item145);
        $manager->persist($item145);
        $item146 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Ceuta");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item146);

        $this->addReference('_reference_ProviderTimezone146', $item146);
        $this->sanitizeEntityValues($item146);
        $manager->persist($item146);
        $item147 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Atlantic/Canary");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item147);

        $this->addReference('_reference_ProviderTimezone147', $item147);
        $this->sanitizeEntityValues($item147);
        $manager->persist($item147);
        $item148 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Addis_Ababa");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry65'));
        })->call($item148);

        $this->addReference('_reference_ProviderTimezone148', $item148);
        $this->sanitizeEntityValues($item148);
        $manager->persist($item148);
        $item149 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Helsinki");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry67'));
        })->call($item149);

        $this->addReference('_reference_ProviderTimezone149', $item149);
        $this->sanitizeEntityValues($item149);
        $manager->persist($item149);
        $item150 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Fiji");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry68'));
        })->call($item150);

        $this->addReference('_reference_ProviderTimezone150', $item150);
        $this->sanitizeEntityValues($item150);
        $manager->persist($item150);
        $item151 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Atlantic/Stanley");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry108'));
        })->call($item151);

        $this->addReference('_reference_ProviderTimezone151', $item151);
        $this->sanitizeEntityValues($item151);
        $manager->persist($item151);
        $item152 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Chuuk");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry150'));
        })->call($item152);

        $this->addReference('_reference_ProviderTimezone152', $item152);
        $this->sanitizeEntityValues($item152);
        $manager->persist($item152);
        $item153 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Pohnpei");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry150'));
        })->call($item153);

        $this->addReference('_reference_ProviderTimezone153', $item153);
        $this->sanitizeEntityValues($item153);
        $manager->persist($item153);
        $item154 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Kosrae");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry150'));
        })->call($item154);

        $this->addReference('_reference_ProviderTimezone154', $item154);
        $this->sanitizeEntityValues($item154);
        $manager->persist($item154);
        $item155 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Atlantic/Faroe");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry105'));
        })->call($item155);

        $this->addReference('_reference_ProviderTimezone155', $item155);
        $this->sanitizeEntityValues($item155);
        $manager->persist($item155);
        $item156 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Paris");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry69'));
        })->call($item156);

        $this->addReference('_reference_ProviderTimezone156', $item156);
        $this->sanitizeEntityValues($item156);
        $manager->persist($item156);
        $item157 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Libreville");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item157);

        $this->addReference('_reference_ProviderTimezone157', $item157);
        $this->sanitizeEntityValues($item157);
        $manager->persist($item157);

        $item158 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/London");
            $this->setLabel(new Label('en', 'es', 'ca', 'it'));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry182'));
        })->call($item158);

        $this->addReference('_reference_ProviderTimezone158', $item158);
        $this->sanitizeEntityValues($item158);
        $manager->persist($item158);
        $item159 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Grenada");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry75'));
        })->call($item159);

        $this->addReference('_reference_ProviderTimezone159', $item159);
        $this->sanitizeEntityValues($item159);
        $manager->persist($item159);
        $item160 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Tbilisi");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry72'));
        })->call($item160);

        $this->addReference('_reference_ProviderTimezone160', $item160);
        $this->sanitizeEntityValues($item160);
        $manager->persist($item160);
        $item161 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Cayenne");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry81'));
        })->call($item161);

        $this->addReference('_reference_ProviderTimezone161', $item161);
        $this->sanitizeEntityValues($item161);
        $manager->persist($item161);
        $item162 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Guernsey");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry82'));
        })->call($item162);

        $this->addReference('_reference_ProviderTimezone162', $item162);
        $this->sanitizeEntityValues($item162);
        $manager->persist($item162);
        $item163 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Accra");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry73'));
        })->call($item163);

        $this->addReference('_reference_ProviderTimezone163', $item163);
        $this->sanitizeEntityValues($item163);
        $manager->persist($item163);
        $item164 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Gibraltar");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry74'));
        })->call($item164);

        $this->addReference('_reference_ProviderTimezone164', $item164);
        $this->sanitizeEntityValues($item164);
        $manager->persist($item164);
        $item165 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Godthab");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry77'));
        })->call($item165);

        $this->addReference('_reference_ProviderTimezone165', $item165);
        $this->sanitizeEntityValues($item165);
        $manager->persist($item165);
        $item166 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Danmarkshavn");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry77'));
        })->call($item166);

        $this->addReference('_reference_ProviderTimezone166', $item166);
        $this->sanitizeEntityValues($item166);
        $manager->persist($item166);
        $item167 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Scoresbysund");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry77'));
        })->call($item167);

        $this->addReference('_reference_ProviderTimezone167', $item167);
        $this->sanitizeEntityValues($item167);
        $manager->persist($item167);
        $item168 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Thule");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry77'));
        })->call($item168);

        $this->addReference('_reference_ProviderTimezone168', $item168);
        $this->sanitizeEntityValues($item168);
        $manager->persist($item168);
        $item169 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Banjul");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry71'));
        })->call($item169);

        $this->addReference('_reference_ProviderTimezone169', $item169);
        $this->sanitizeEntityValues($item169);
        $manager->persist($item169);
        $item170 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Conakry");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry83'));
        })->call($item170);

        $this->addReference('_reference_ProviderTimezone170', $item170);
        $this->sanitizeEntityValues($item170);
        $manager->persist($item170);
        $item171 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Guadeloupe");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry78'));
        })->call($item171);

        $this->addReference('_reference_ProviderTimezone171', $item171);
        $this->sanitizeEntityValues($item171);
        $manager->persist($item171);
        $item172 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Malabo");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry84'));
        })->call($item172);

        $this->addReference('_reference_ProviderTimezone172', $item172);
        $this->sanitizeEntityValues($item172);
        $manager->persist($item172);
        $item173 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Athens");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry76'));
        })->call($item173);

        $this->addReference('_reference_ProviderTimezone173', $item173);
        $this->sanitizeEntityValues($item173);
        $manager->persist($item173);
        $item174 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Atlantic/South_Georgia");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry106'));
        })->call($item174);

        $this->addReference('_reference_ProviderTimezone174', $item174);
        $this->sanitizeEntityValues($item174);
        $manager->persist($item174);
        $item175 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Guatemala");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry80'));
        })->call($item175);

        $this->addReference('_reference_ProviderTimezone175', $item175);
        $this->sanitizeEntityValues($item175);
        $manager->persist($item175);
        $item176 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Guam");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry79'));
        })->call($item176);

        $this->addReference('_reference_ProviderTimezone176', $item176);
        $this->sanitizeEntityValues($item176);
        $manager->persist($item176);
        $item177 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Bissau");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry85'));
        })->call($item177);

        $this->addReference('_reference_ProviderTimezone177', $item177);
        $this->sanitizeEntityValues($item177);
        $manager->persist($item177);
        $item178 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Guyana");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry86'));
        })->call($item178);

        $this->addReference('_reference_ProviderTimezone178', $item178);
        $this->sanitizeEntityValues($item178);
        $manager->persist($item178);
        $item179 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Hong_Kong");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry180'));
        })->call($item179);

        $this->addReference('_reference_ProviderTimezone179', $item179);
        $this->sanitizeEntityValues($item179);
        $manager->persist($item179);
        $item180 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Tegucigalpa");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry88'));
        })->call($item180);

        $this->addReference('_reference_ProviderTimezone180', $item180);
        $this->sanitizeEntityValues($item180);
        $manager->persist($item180);
        $item181 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Zagreb");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry51'));
        })->call($item181);

        $this->addReference('_reference_ProviderTimezone181', $item181);
        $this->sanitizeEntityValues($item181);
        $manager->persist($item181);
        $item182 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Port-au-Prince");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry87'));
        })->call($item182);

        $this->addReference('_reference_ProviderTimezone182', $item182);
        $this->sanitizeEntityValues($item182);
        $manager->persist($item182);
        $item183 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Budapest");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry89'));
        })->call($item183);

        $this->addReference('_reference_ProviderTimezone183', $item183);
        $this->sanitizeEntityValues($item183);
        $manager->persist($item183);
        $item184 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Jakarta");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry91'));
        })->call($item184);

        $this->addReference('_reference_ProviderTimezone184', $item184);
        $this->sanitizeEntityValues($item184);
        $manager->persist($item184);
        $item185 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Pontianak");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry91'));
        })->call($item185);

        $this->addReference('_reference_ProviderTimezone185', $item185);
        $this->sanitizeEntityValues($item185);
        $manager->persist($item185);
        $item186 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Makassar");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry91'));
        })->call($item186);

        $this->addReference('_reference_ProviderTimezone186', $item186);
        $this->sanitizeEntityValues($item186);
        $manager->persist($item186);
        $item187 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Jayapura");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry91'));
        })->call($item187);

        $this->addReference('_reference_ProviderTimezone187', $item187);
        $this->sanitizeEntityValues($item187);
        $manager->persist($item187);
        $item188 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Dublin");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry94'));
        })->call($item188);

        $this->addReference('_reference_ProviderTimezone188', $item188);
        $this->sanitizeEntityValues($item188);
        $manager->persist($item188);
        $item189 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Jerusalem");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry117'));
        })->call($item189);

        $this->addReference('_reference_ProviderTimezone189', $item189);
        $this->sanitizeEntityValues($item189);
        $manager->persist($item189);
        $item190 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Isle_of_Man");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry97'));
        })->call($item190);

        $this->addReference('_reference_ProviderTimezone190', $item190);
        $this->sanitizeEntityValues($item190);
        $manager->persist($item190);
        $item191 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Kolkata");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry90'));
        })->call($item191);

        $this->addReference('_reference_ProviderTimezone191', $item191);
        $this->sanitizeEntityValues($item191);
        $manager->persist($item191);
        $item192 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Indian/Chagos");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry222'));
        })->call($item192);

        $this->addReference('_reference_ProviderTimezone192', $item192);
        $this->sanitizeEntityValues($item192);
        $manager->persist($item192);
        $item193 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Baghdad");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry93'));
        })->call($item193);

        $this->addReference('_reference_ProviderTimezone193', $item193);
        $this->sanitizeEntityValues($item193);
        $manager->persist($item193);
        $item194 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Tehran");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry92'));
        })->call($item194);

        $this->addReference('_reference_ProviderTimezone194', $item194);
        $this->sanitizeEntityValues($item194);
        $manager->persist($item194);
        $item195 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Atlantic/Reykjavik");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry100'));
        })->call($item195);

        $this->addReference('_reference_ProviderTimezone195', $item195);
        $this->sanitizeEntityValues($item195);
        $manager->persist($item195);
        $item196 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Rome");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry118'));
        })->call($item196);

        $this->addReference('_reference_ProviderTimezone196', $item196);
        $this->sanitizeEntityValues($item196);
        $manager->persist($item196);
        $item197 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Jersey");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry121'));
        })->call($item197);

        $this->addReference('_reference_ProviderTimezone197', $item197);
        $this->sanitizeEntityValues($item197);
        $manager->persist($item197);
        $item198 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Jamaica");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry119'));
        })->call($item198);

        $this->addReference('_reference_ProviderTimezone198', $item198);
        $this->sanitizeEntityValues($item198);
        $manager->persist($item198);
        $item199 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Amman");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry122'));
        })->call($item199);

        $this->addReference('_reference_ProviderTimezone199', $item199);
        $this->sanitizeEntityValues($item199);
        $manager->persist($item199);
        $item200 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Tokyo");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry120'));
        })->call($item200);

        $this->addReference('_reference_ProviderTimezone200', $item200);
        $this->sanitizeEntityValues($item200);
        $manager->persist($item200);
        $item201 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Nairobi");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry124'));
        })->call($item201);

        $this->addReference('_reference_ProviderTimezone201', $item201);
        $this->sanitizeEntityValues($item201);
        $manager->persist($item201);
        $item202 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Bishkek");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry125'));
        })->call($item202);

        $this->addReference('_reference_ProviderTimezone202', $item202);
        $this->sanitizeEntityValues($item202);
        $manager->persist($item202);
        $item203 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Phnom_Penh");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry36'));
        })->call($item203);

        $this->addReference('_reference_ProviderTimezone203', $item203);
        $this->sanitizeEntityValues($item203);
        $manager->persist($item203);
        $item204 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Tarawa");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry126'));
        })->call($item204);

        $this->addReference('_reference_ProviderTimezone204', $item204);
        $this->sanitizeEntityValues($item204);
        $manager->persist($item204);
        $item205 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Enderbury");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry126'));
        })->call($item205);

        $this->addReference('_reference_ProviderTimezone205', $item205);
        $this->sanitizeEntityValues($item205);
        $manager->persist($item205);
        $item206 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Kiritimati");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry126'));
        })->call($item206);

        $this->addReference('_reference_ProviderTimezone206', $item206);
        $this->sanitizeEntityValues($item206);
        $manager->persist($item206);
        $item207 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Indian/Comoro");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry45'));
        })->call($item207);

        $this->addReference('_reference_ProviderTimezone207', $item207);
        $this->sanitizeEntityValues($item207);
        $manager->persist($item207);
        $item208 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/St_Kitts");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry195'));
        })->call($item208);

        $this->addReference('_reference_ProviderTimezone208', $item208);
        $this->sanitizeEntityValues($item208);
        $manager->persist($item208);
        $item209 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Pyongyang");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry47'));
        })->call($item209);

        $this->addReference('_reference_ProviderTimezone209', $item209);
        $this->sanitizeEntityValues($item209);
        $manager->persist($item209);
        $item210 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Seoul");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry48'));
        })->call($item210);

        $this->addReference('_reference_ProviderTimezone210', $item210);
        $this->sanitizeEntityValues($item210);
        $manager->persist($item210);
        $item211 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Kuwait");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry127'));
        })->call($item211);

        $this->addReference('_reference_ProviderTimezone211', $item211);
        $this->sanitizeEntityValues($item211);
        $manager->persist($item211);
        $item212 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Cayman");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry102'));
        })->call($item212);

        $this->addReference('_reference_ProviderTimezone212', $item212);
        $this->sanitizeEntityValues($item212);
        $manager->persist($item212);
        $item213 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Almaty");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry123'));
        })->call($item213);

        $this->addReference('_reference_ProviderTimezone213', $item213);
        $this->sanitizeEntityValues($item213);
        $manager->persist($item213);
        $item214 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Qyzylorda");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry123'));
        })->call($item214);

        $this->addReference('_reference_ProviderTimezone214', $item214);
        $this->sanitizeEntityValues($item214);
        $manager->persist($item214);
        $item215 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Aqtobe");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry123'));
        })->call($item215);

        $this->addReference('_reference_ProviderTimezone215', $item215);
        $this->sanitizeEntityValues($item215);
        $manager->persist($item215);
        $item216 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Aqtau");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry123'));
        })->call($item216);

        $this->addReference('_reference_ProviderTimezone216', $item216);
        $this->sanitizeEntityValues($item216);
        $manager->persist($item216);
        $item217 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Oral");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry123'));
        })->call($item217);

        $this->addReference('_reference_ProviderTimezone217', $item217);
        $this->sanitizeEntityValues($item217);
        $manager->persist($item217);
        $item218 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Vientiane");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry128'));
        })->call($item218);

        $this->addReference('_reference_ProviderTimezone218', $item218);
        $this->sanitizeEntityValues($item218);
        $manager->persist($item218);
        $item219 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Beirut");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry131'));
        })->call($item219);

        $this->addReference('_reference_ProviderTimezone219', $item219);
        $this->sanitizeEntityValues($item219);
        $manager->persist($item219);
        $item220 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/St_Lucia");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry201'));
        })->call($item220);

        $this->addReference('_reference_ProviderTimezone220', $item220);
        $this->sanitizeEntityValues($item220);
        $manager->persist($item220);
        $item221 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Vaduz");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry134'));
        })->call($item221);

        $this->addReference('_reference_ProviderTimezone221', $item221);
        $this->sanitizeEntityValues($item221);
        $manager->persist($item221);
        $item222 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Colombo");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry210'));
        })->call($item222);

        $this->addReference('_reference_ProviderTimezone222', $item222);
        $this->sanitizeEntityValues($item222);
        $manager->persist($item222);
        $item223 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Monrovia");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry132'));
        })->call($item223);

        $this->addReference('_reference_ProviderTimezone223', $item223);
        $this->sanitizeEntityValues($item223);
        $manager->persist($item223);
        $item224 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Maseru");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry129'));
        })->call($item224);

        $this->addReference('_reference_ProviderTimezone224', $item224);
        $this->sanitizeEntityValues($item224);
        $manager->persist($item224);
        $item225 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Vilnius");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry135'));
        })->call($item225);

        $this->addReference('_reference_ProviderTimezone225', $item225);
        $this->sanitizeEntityValues($item225);
        $manager->persist($item225);
        $item226 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Luxembourg");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry136'));
        })->call($item226);

        $this->addReference('_reference_ProviderTimezone226', $item226);
        $this->sanitizeEntityValues($item226);
        $manager->persist($item226);
        $item227 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Riga");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry130'));
        })->call($item227);

        $this->addReference('_reference_ProviderTimezone227', $item227);
        $this->sanitizeEntityValues($item227);
        $manager->persist($item227);
        $item228 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Tripoli");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry133'));
        })->call($item228);

        $this->addReference('_reference_ProviderTimezone228', $item228);
        $this->sanitizeEntityValues($item228);
        $manager->persist($item228);
        $item229 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Casablanca");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry144'));
        })->call($item229);

        $this->addReference('_reference_ProviderTimezone229', $item229);
        $this->sanitizeEntityValues($item229);
        $manager->persist($item229);
        $item230 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Monaco");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry152'));
        })->call($item230);

        $this->addReference('_reference_ProviderTimezone230', $item230);
        $this->sanitizeEntityValues($item230);
        $manager->persist($item230);
        $item231 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Chisinau");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry151'));
        })->call($item231);

        $this->addReference('_reference_ProviderTimezone231', $item231);
        $this->sanitizeEntityValues($item231);
        $manager->persist($item231);
        $item232 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Podgorica");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry154'));
        })->call($item232);

        $this->addReference('_reference_ProviderTimezone232', $item232);
        $this->sanitizeEntityValues($item232);
        $manager->persist($item232);
        $item233 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Marigot");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry197'));
        })->call($item233);

        $this->addReference('_reference_ProviderTimezone233', $item233);
        $this->sanitizeEntityValues($item233);
        $manager->persist($item233);
        $item234 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Indian/Antananarivo");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry138'));
        })->call($item234);

        $this->addReference('_reference_ProviderTimezone234', $item234);
        $this->sanitizeEntityValues($item234);
        $manager->persist($item234);
        $item235 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Majuro");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry110'));
        })->call($item235);

        $this->addReference('_reference_ProviderTimezone235', $item235);
        $this->sanitizeEntityValues($item235);
        $manager->persist($item235);
        $item236 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Kwajalein");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry110'));
        })->call($item236);

        $this->addReference('_reference_ProviderTimezone236', $item236);
        $this->sanitizeEntityValues($item236);
        $manager->persist($item236);
        $item237 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Skopje");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry137'));
        })->call($item237);

        $this->addReference('_reference_ProviderTimezone237', $item237);
        $this->sanitizeEntityValues($item237);
        $manager->persist($item237);
        $item238 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Bamako");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry142'));
        })->call($item238);

        $this->addReference('_reference_ProviderTimezone238', $item238);
        $this->sanitizeEntityValues($item238);
        $manager->persist($item238);
        $item239 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Rangoon");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry157'));
        })->call($item239);

        $this->addReference('_reference_ProviderTimezone239', $item239);
        $this->sanitizeEntityValues($item239);
        $manager->persist($item239);
        $item240 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Ulaanbaatar");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry153'));
        })->call($item240);

        $this->addReference('_reference_ProviderTimezone240', $item240);
        $this->sanitizeEntityValues($item240);
        $manager->persist($item240);
        $item241 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Hovd");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry153'));
        })->call($item241);

        $this->addReference('_reference_ProviderTimezone241', $item241);
        $this->sanitizeEntityValues($item241);
        $manager->persist($item241);
        $item242 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Choibalsan");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry153'));
        })->call($item242);

        $this->addReference('_reference_ProviderTimezone242', $item242);
        $this->sanitizeEntityValues($item242);
        $manager->persist($item242);
        $item243 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Macau");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry181'));
        })->call($item243);

        $this->addReference('_reference_ProviderTimezone243', $item243);
        $this->sanitizeEntityValues($item243);
        $manager->persist($item243);
        $item244 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Saipan");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry109'));
        })->call($item244);

        $this->addReference('_reference_ProviderTimezone244', $item244);
        $this->sanitizeEntityValues($item244);
        $manager->persist($item244);
        $item245 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Martinique");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry145'));
        })->call($item245);

        $this->addReference('_reference_ProviderTimezone245', $item245);
        $this->sanitizeEntityValues($item245);
        $manager->persist($item245);
        $item246 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Nouakchott");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry147'));
        })->call($item246);

        $this->addReference('_reference_ProviderTimezone246', $item246);
        $this->sanitizeEntityValues($item246);
        $manager->persist($item246);
        $item247 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Montserrat");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry155'));
        })->call($item247);

        $this->addReference('_reference_ProviderTimezone247', $item247);
        $this->sanitizeEntityValues($item247);
        $manager->persist($item247);
        $item248 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Malta");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry143'));
        })->call($item248);

        $this->addReference('_reference_ProviderTimezone248', $item248);
        $this->sanitizeEntityValues($item248);
        $manager->persist($item248);
        $item249 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Indian/Mauritius");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry146'));
        })->call($item249);

        $this->addReference('_reference_ProviderTimezone249', $item249);
        $this->sanitizeEntityValues($item249);
        $manager->persist($item249);
        $item250 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Indian/Maldives");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry141'));
        })->call($item250);

        $this->addReference('_reference_ProviderTimezone250', $item250);
        $this->sanitizeEntityValues($item250);
        $manager->persist($item250);
        $item251 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Blantyre");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry140'));
        })->call($item251);

        $this->addReference('_reference_ProviderTimezone251', $item251);
        $this->sanitizeEntityValues($item251);
        $manager->persist($item251);
        $item252 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Mexico_City");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry149'));
        })->call($item252);

        $this->addReference('_reference_ProviderTimezone252', $item252);
        $this->sanitizeEntityValues($item252);
        $manager->persist($item252);
        $item253 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Cancun");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry149'));
        })->call($item253);

        $this->addReference('_reference_ProviderTimezone253', $item253);
        $this->sanitizeEntityValues($item253);
        $manager->persist($item253);
        $item254 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Merida");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry149'));
        })->call($item254);

        $this->addReference('_reference_ProviderTimezone254', $item254);
        $this->sanitizeEntityValues($item254);
        $manager->persist($item254);
        $item255 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Monterrey");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry149'));
        })->call($item255);

        $this->addReference('_reference_ProviderTimezone255', $item255);
        $this->sanitizeEntityValues($item255);
        $manager->persist($item255);
        $item256 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Matamoros");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry149'));
        })->call($item256);

        $this->addReference('_reference_ProviderTimezone256', $item256);
        $this->sanitizeEntityValues($item256);
        $manager->persist($item256);
        $item257 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Mazatlan");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry149'));
        })->call($item257);

        $this->addReference('_reference_ProviderTimezone257', $item257);
        $this->sanitizeEntityValues($item257);
        $manager->persist($item257);
        $item258 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Chihuahua");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry149'));
        })->call($item258);

        $this->addReference('_reference_ProviderTimezone258', $item258);
        $this->sanitizeEntityValues($item258);
        $manager->persist($item258);
        $item259 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Ojinaga");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry149'));
        })->call($item259);

        $this->addReference('_reference_ProviderTimezone259', $item259);
        $this->sanitizeEntityValues($item259);
        $manager->persist($item259);
        $item260 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Hermosillo");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry149'));
        })->call($item260);

        $this->addReference('_reference_ProviderTimezone260', $item260);
        $this->sanitizeEntityValues($item260);
        $manager->persist($item260);
        $item261 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Tijuana");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry149'));
        })->call($item261);

        $this->addReference('_reference_ProviderTimezone261', $item261);
        $this->sanitizeEntityValues($item261);
        $manager->persist($item261);
        $item262 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Santa_Isabel");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry149'));
        })->call($item262);

        $this->addReference('_reference_ProviderTimezone262', $item262);
        $this->sanitizeEntityValues($item262);
        $manager->persist($item262);
        $item263 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Bahia_Banderas");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry149'));
        })->call($item263);

        $this->addReference('_reference_ProviderTimezone263', $item263);
        $this->sanitizeEntityValues($item263);
        $manager->persist($item263);
        $item264 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Kuala_Lumpur");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry139'));
        })->call($item264);

        $this->addReference('_reference_ProviderTimezone264', $item264);
        $this->sanitizeEntityValues($item264);
        $manager->persist($item264);
        $item265 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Kuching");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry139'));
        })->call($item265);

        $this->addReference('_reference_ProviderTimezone265', $item265);
        $this->sanitizeEntityValues($item265);
        $manager->persist($item265);
        $item266 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Maputo");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry156'));
        })->call($item266);

        $this->addReference('_reference_ProviderTimezone266', $item266);
        $this->sanitizeEntityValues($item266);
        $manager->persist($item266);
        $item267 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Windhoek");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry158'));
        })->call($item267);

        $this->addReference('_reference_ProviderTimezone267', $item267);
        $this->sanitizeEntityValues($item267);
        $manager->persist($item267);
        $item268 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Noumea");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry165'));
        })->call($item268);

        $this->addReference('_reference_ProviderTimezone268', $item268);
        $this->sanitizeEntityValues($item268);
        $manager->persist($item268);
        $item269 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Niamey");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry162'));
        })->call($item269);

        $this->addReference('_reference_ProviderTimezone269', $item269);
        $this->sanitizeEntityValues($item269);
        $manager->persist($item269);
        $item270 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Norfolk");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry99'));
        })->call($item270);

        $this->addReference('_reference_ProviderTimezone270', $item270);
        $this->sanitizeEntityValues($item270);
        $manager->persist($item270);
        $item271 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Lagos");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry163'));
        })->call($item271);

        $this->addReference('_reference_ProviderTimezone271', $item271);
        $this->sanitizeEntityValues($item271);
        $manager->persist($item271);
        $item272 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Managua");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry161'));
        })->call($item272);

        $this->addReference('_reference_ProviderTimezone272', $item272);
        $this->sanitizeEntityValues($item272);
        $manager->persist($item272);
        $item273 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Amsterdam");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry168'));
        })->call($item273);

        $this->addReference('_reference_ProviderTimezone273', $item273);
        $this->sanitizeEntityValues($item273);
        $manager->persist($item273);
        $item274 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Oslo");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry164'));
        })->call($item274);

        $this->addReference('_reference_ProviderTimezone274', $item274);
        $this->sanitizeEntityValues($item274);
        $manager->persist($item274);
        $item275 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Kathmandu");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry160'));
        })->call($item275);

        $this->addReference('_reference_ProviderTimezone275', $item275);
        $this->sanitizeEntityValues($item275);
        $manager->persist($item275);
        $item276 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Nauru");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry159'));
        })->call($item276);

        $this->addReference('_reference_ProviderTimezone276', $item276);
        $this->sanitizeEntityValues($item276);
        $manager->persist($item276);
        $item277 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Niue");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry98'));
        })->call($item277);

        $this->addReference('_reference_ProviderTimezone277', $item277);
        $this->sanitizeEntityValues($item277);
        $manager->persist($item277);
        $item278 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Auckland");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry166'));
        })->call($item278);

        $this->addReference('_reference_ProviderTimezone278', $item278);
        $this->sanitizeEntityValues($item278);
        $manager->persist($item278);
        $item279 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Chatham");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry166'));
        })->call($item279);

        $this->addReference('_reference_ProviderTimezone279', $item279);
        $this->sanitizeEntityValues($item279);
        $manager->persist($item279);
        $item280 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Muscat");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry167'));
        })->call($item280);

        $this->addReference('_reference_ProviderTimezone280', $item280);
        $this->sanitizeEntityValues($item280);
        $manager->persist($item280);
        $item281 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Panama");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry171'));
        })->call($item281);

        $this->addReference('_reference_ProviderTimezone281', $item281);
        $this->sanitizeEntityValues($item281);
        $manager->persist($item281);
        $item282 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Lima");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry174'));
        })->call($item282);

        $this->addReference('_reference_ProviderTimezone282', $item282);
        $this->sanitizeEntityValues($item282);
        $manager->persist($item282);
        $item283 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Tahiti");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry175'));
        })->call($item283);

        $this->addReference('_reference_ProviderTimezone283', $item283);
        $this->sanitizeEntityValues($item283);
        $manager->persist($item283);
        $item284 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Marquesas");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry175'));
        })->call($item284);

        $this->addReference('_reference_ProviderTimezone284', $item284);
        $this->sanitizeEntityValues($item284);
        $manager->persist($item284);
        $item285 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Gambier");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry175'));
        })->call($item285);

        $this->addReference('_reference_ProviderTimezone285', $item285);
        $this->sanitizeEntityValues($item285);
        $manager->persist($item285);
        $item286 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Port_Moresby");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry172'));
        })->call($item286);

        $this->addReference('_reference_ProviderTimezone286', $item286);
        $this->sanitizeEntityValues($item286);
        $manager->persist($item286);
        $item287 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Bougainville");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry172'));
        })->call($item287);

        $this->addReference('_reference_ProviderTimezone287', $item287);
        $this->sanitizeEntityValues($item287);
        $manager->persist($item287);
        $item288 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Manila");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry66'));
        })->call($item288);

        $this->addReference('_reference_ProviderTimezone288', $item288);
        $this->sanitizeEntityValues($item288);
        $manager->persist($item288);
        $item289 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Karachi");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry169'));
        })->call($item289);

        $this->addReference('_reference_ProviderTimezone289', $item289);
        $this->sanitizeEntityValues($item289);
        $manager->persist($item289);
        $item290 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Warsaw");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry176'));
        })->call($item290);

        $this->addReference('_reference_ProviderTimezone290', $item290);
        $this->sanitizeEntityValues($item290);
        $manager->persist($item290);
        $item291 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Miquelon");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry198'));
        })->call($item291);

        $this->addReference('_reference_ProviderTimezone291', $item291);
        $this->sanitizeEntityValues($item291);
        $manager->persist($item291);
        $item292 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Pitcairn");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry112'));
        })->call($item292);

        $this->addReference('_reference_ProviderTimezone292', $item292);
        $this->sanitizeEntityValues($item292);
        $manager->persist($item292);
        $item293 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Puerto_Rico");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry178'));
        })->call($item293);

        $this->addReference('_reference_ProviderTimezone293', $item293);
        $this->sanitizeEntityValues($item293);
        $manager->persist($item293);
        $item294 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Gaza");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry224'));
        })->call($item294);

        $this->addReference('_reference_ProviderTimezone294', $item294);
        $this->sanitizeEntityValues($item294);
        $manager->persist($item294);
        $item295 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Hebron");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry224'));
        })->call($item295);

        $this->addReference('_reference_ProviderTimezone295', $item295);
        $this->sanitizeEntityValues($item295);
        $manager->persist($item295);
        $item296 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Lisbon");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry177'));
        })->call($item296);

        $this->addReference('_reference_ProviderTimezone296', $item296);
        $this->sanitizeEntityValues($item296);
        $manager->persist($item296);
        $item297 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Atlantic/Madeira");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry177'));
        })->call($item297);

        $this->addReference('_reference_ProviderTimezone297', $item297);
        $this->sanitizeEntityValues($item297);
        $manager->persist($item297);
        $item298 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Atlantic/Azores");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry177'));
        })->call($item298);

        $this->addReference('_reference_ProviderTimezone298', $item298);
        $this->sanitizeEntityValues($item298);
        $manager->persist($item298);
        $item299 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Palau");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry170'));
        })->call($item299);

        $this->addReference('_reference_ProviderTimezone299', $item299);
        $this->sanitizeEntityValues($item299);
        $manager->persist($item299);
        $item300 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Asuncion");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry173'));
        })->call($item300);

        $this->addReference('_reference_ProviderTimezone300', $item300);
        $this->sanitizeEntityValues($item300);
        $manager->persist($item300);
        $item301 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Qatar");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry179'));
        })->call($item301);

        $this->addReference('_reference_ProviderTimezone301', $item301);
        $this->sanitizeEntityValues($item301);
        $manager->persist($item301);
        $item302 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Indian/Reunion");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry187'));
        })->call($item302);

        $this->addReference('_reference_ProviderTimezone302', $item302);
        $this->sanitizeEntityValues($item302);
        $manager->persist($item302);
        $item303 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Bucharest");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry189'));
        })->call($item303);

        $this->addReference('_reference_ProviderTimezone303', $item303);
        $this->sanitizeEntityValues($item303);
        $manager->persist($item303);
        $item304 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Belgrade");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry204'));
        })->call($item304);

        $this->addReference('_reference_ProviderTimezone304', $item304);
        $this->sanitizeEntityValues($item304);
        $manager->persist($item304);
        $item305 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Kaliningrad");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry190'));
        })->call($item305);

        $this->addReference('_reference_ProviderTimezone305', $item305);
        $this->sanitizeEntityValues($item305);
        $manager->persist($item305);
        $item306 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Moscow");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry190'));
        })->call($item306);

        $this->addReference('_reference_ProviderTimezone306', $item306);
        $this->sanitizeEntityValues($item306);
        $manager->persist($item306);
        $item307 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Simferopol");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry190'));
        })->call($item307);

        $this->addReference('_reference_ProviderTimezone307', $item307);
        $this->sanitizeEntityValues($item307);
        $manager->persist($item307);
        $item308 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Volgograd");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry190'));
        })->call($item308);

        $this->addReference('_reference_ProviderTimezone308', $item308);
        $this->sanitizeEntityValues($item308);
        $manager->persist($item308);
        $item309 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Samara");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry190'));
        })->call($item309);

        $this->addReference('_reference_ProviderTimezone309', $item309);
        $this->sanitizeEntityValues($item309);
        $manager->persist($item309);
        $item310 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Yekaterinburg");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry190'));
        })->call($item310);

        $this->addReference('_reference_ProviderTimezone310', $item310);
        $this->sanitizeEntityValues($item310);
        $manager->persist($item310);
        $item311 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Omsk");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry190'));
        })->call($item311);

        $this->addReference('_reference_ProviderTimezone311', $item311);
        $this->sanitizeEntityValues($item311);
        $manager->persist($item311);
        $item312 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Novosibirsk");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry190'));
        })->call($item312);

        $this->addReference('_reference_ProviderTimezone312', $item312);
        $this->sanitizeEntityValues($item312);
        $manager->persist($item312);
        $item313 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Novokuznetsk");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry190'));
        })->call($item313);

        $this->addReference('_reference_ProviderTimezone313', $item313);
        $this->sanitizeEntityValues($item313);
        $manager->persist($item313);
        $item314 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Krasnoyarsk");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry190'));
        })->call($item314);

        $this->addReference('_reference_ProviderTimezone314', $item314);
        $this->sanitizeEntityValues($item314);
        $manager->persist($item314);
        $item315 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Irkutsk");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry190'));
        })->call($item315);

        $this->addReference('_reference_ProviderTimezone315', $item315);
        $this->sanitizeEntityValues($item315);
        $manager->persist($item315);
        $item316 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Chita");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry190'));
        })->call($item316);

        $this->addReference('_reference_ProviderTimezone316', $item316);
        $this->sanitizeEntityValues($item316);
        $manager->persist($item316);
        $item317 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Yakutsk");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry190'));
        })->call($item317);

        $this->addReference('_reference_ProviderTimezone317', $item317);
        $this->sanitizeEntityValues($item317);
        $manager->persist($item317);
        $item318 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Khandyga");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry190'));
        })->call($item318);

        $this->addReference('_reference_ProviderTimezone318', $item318);
        $this->sanitizeEntityValues($item318);
        $manager->persist($item318);
        $item319 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Vladivostok");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry190'));
        })->call($item319);

        $this->addReference('_reference_ProviderTimezone319', $item319);
        $this->sanitizeEntityValues($item319);
        $manager->persist($item319);
        $item320 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Sakhalin");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry190'));
        })->call($item320);

        $this->addReference('_reference_ProviderTimezone320', $item320);
        $this->sanitizeEntityValues($item320);
        $manager->persist($item320);
        $item321 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Ust-Nera");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry190'));
        })->call($item321);

        $this->addReference('_reference_ProviderTimezone321', $item321);
        $this->sanitizeEntityValues($item321);
        $manager->persist($item321);
        $item322 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Magadan");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry190'));
        })->call($item322);

        $this->addReference('_reference_ProviderTimezone322', $item322);
        $this->sanitizeEntityValues($item322);
        $manager->persist($item322);
        $item323 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Srednekolymsk");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry190'));
        })->call($item323);

        $this->addReference('_reference_ProviderTimezone323', $item323);
        $this->sanitizeEntityValues($item323);
        $manager->persist($item323);
        $item324 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Kamchatka");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry190'));
        })->call($item324);

        $this->addReference('_reference_ProviderTimezone324', $item324);
        $this->sanitizeEntityValues($item324);
        $manager->persist($item324);
        $item325 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Anadyr");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry190'));
        })->call($item325);

        $this->addReference('_reference_ProviderTimezone325', $item325);
        $this->sanitizeEntityValues($item325);
        $manager->persist($item325);
        $item326 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Kigali");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry188'));
        })->call($item326);

        $this->addReference('_reference_ProviderTimezone326', $item326);
        $this->sanitizeEntityValues($item326);
        $manager->persist($item326);
        $item327 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Riyadh");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry9'));
        })->call($item327);

        $this->addReference('_reference_ProviderTimezone327', $item327);
        $this->sanitizeEntityValues($item327);
        $manager->persist($item327);
        $item328 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Guadalcanal");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry113'));
        })->call($item328);

        $this->addReference('_reference_ProviderTimezone328', $item328);
        $this->sanitizeEntityValues($item328);
        $manager->persist($item328);
        $item329 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Indian/Mahe");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry205'));
        })->call($item329);

        $this->addReference('_reference_ProviderTimezone329', $item329);
        $this->sanitizeEntityValues($item329);
        $manager->persist($item329);
        $item330 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Khartoum");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry213'));
        })->call($item330);

        $this->addReference('_reference_ProviderTimezone330', $item330);
        $this->sanitizeEntityValues($item330);
        $manager->persist($item330);
        $item331 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Stockholm");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry214'));
        })->call($item331);

        $this->addReference('_reference_ProviderTimezone331', $item331);
        $this->sanitizeEntityValues($item331);
        $manager->persist($item331);
        $item332 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Singapore");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry207'));
        })->call($item332);

        $this->addReference('_reference_ProviderTimezone332', $item332);
        $this->sanitizeEntityValues($item332);
        $manager->persist($item332);
        $item333 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Atlantic/St_Helena");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry200'));
        })->call($item333);

        $this->addReference('_reference_ProviderTimezone333', $item333);
        $this->sanitizeEntityValues($item333);
        $manager->persist($item333);
        $item334 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Ljubljana");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry61'));
        })->call($item334);

        $this->addReference('_reference_ProviderTimezone334', $item334);
        $this->sanitizeEntityValues($item334);
        $manager->persist($item334);
        $item335 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Arctic/Longyearbyen");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry217'));
        })->call($item335);

        $this->addReference('_reference_ProviderTimezone335', $item335);
        $this->sanitizeEntityValues($item335);
        $manager->persist($item335);
        $item336 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Bratislava");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry60'));
        })->call($item336);

        $this->addReference('_reference_ProviderTimezone336', $item336);
        $this->sanitizeEntityValues($item336);
        $manager->persist($item336);
        $item337 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Freetown");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry206'));
        })->call($item337);

        $this->addReference('_reference_ProviderTimezone337', $item337);
        $this->sanitizeEntityValues($item337);
        $manager->persist($item337);
        $item338 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/San_Marino");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry196'));
        })->call($item338);

        $this->addReference('_reference_ProviderTimezone338', $item338);
        $this->sanitizeEntityValues($item338);
        $manager->persist($item338);
        $item339 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Dakar");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry203'));
        })->call($item339);

        $this->addReference('_reference_ProviderTimezone339', $item339);
        $this->sanitizeEntityValues($item339);
        $manager->persist($item339);
        $item340 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Mogadishu");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry209'));
        })->call($item340);

        $this->addReference('_reference_ProviderTimezone340', $item340);
        $this->sanitizeEntityValues($item340);
        $manager->persist($item340);
        $item341 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Paramaribo");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry216'));
        })->call($item341);

        $this->addReference('_reference_ProviderTimezone341', $item341);
        $this->sanitizeEntityValues($item341);
        $manager->persist($item341);
        $item342 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Juba");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry249'));
        })->call($item342);

        $this->addReference('_reference_ProviderTimezone342', $item342);
        $this->sanitizeEntityValues($item342);
        $manager->persist($item342);
        $item343 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Sao_Tome");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry202'));
        })->call($item343);

        $this->addReference('_reference_ProviderTimezone343', $item343);
        $this->sanitizeEntityValues($item343);
        $manager->persist($item343);
        $item344 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/El_Salvador");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry57'));
        })->call($item344);

        $this->addReference('_reference_ProviderTimezone344', $item344);
        $this->sanitizeEntityValues($item344);
        $manager->persist($item344);
        $item345 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Lower_Princes");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry248'));
        })->call($item345);

        $this->addReference('_reference_ProviderTimezone345', $item345);
        $this->sanitizeEntityValues($item345);
        $manager->persist($item345);
        $item346 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Damascus");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry208'));
        })->call($item346);

        $this->addReference('_reference_ProviderTimezone346', $item346);
        $this->sanitizeEntityValues($item346);
        $manager->persist($item346);
        $item347 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Mbabane");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry211'));
        })->call($item347);

        $this->addReference('_reference_ProviderTimezone347', $item347);
        $this->sanitizeEntityValues($item347);
        $manager->persist($item347);
        $item348 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Grand_Turk");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry114'));
        })->call($item348);

        $this->addReference('_reference_ProviderTimezone348', $item348);
        $this->sanitizeEntityValues($item348);
        $manager->persist($item348);
        $item349 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Ndjamena");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry39'));
        })->call($item349);

        $this->addReference('_reference_ProviderTimezone349', $item349);
        $this->sanitizeEntityValues($item349);
        $manager->persist($item349);
        $item350 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Indian/Kerguelen");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry223'));
        })->call($item350);

        $this->addReference('_reference_ProviderTimezone350', $item350);
        $this->sanitizeEntityValues($item350);
        $manager->persist($item350);
        $item351 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Lome");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry226'));
        })->call($item351);

        $this->addReference('_reference_ProviderTimezone351', $item351);
        $this->sanitizeEntityValues($item351);
        $manager->persist($item351);
        $item352 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Bangkok");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry218'));
        })->call($item352);

        $this->addReference('_reference_ProviderTimezone352', $item352);
        $this->sanitizeEntityValues($item352);
        $manager->persist($item352);
        $item353 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Dushanbe");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry221'));
        })->call($item353);

        $this->addReference('_reference_ProviderTimezone353', $item353);
        $this->sanitizeEntityValues($item353);
        $manager->persist($item353);
        $item354 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Fakaofo");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry227'));
        })->call($item354);

        $this->addReference('_reference_ProviderTimezone354', $item354);
        $this->sanitizeEntityValues($item354);
        $manager->persist($item354);
        $item355 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Dili");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry225'));
        })->call($item355);

        $this->addReference('_reference_ProviderTimezone355', $item355);
        $this->sanitizeEntityValues($item355);
        $manager->persist($item355);
        $item356 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Ashgabat");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry231'));
        })->call($item356);

        $this->addReference('_reference_ProviderTimezone356', $item356);
        $this->sanitizeEntityValues($item356);
        $manager->persist($item356);
        $item357 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Tunis");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry230'));
        })->call($item357);

        $this->addReference('_reference_ProviderTimezone357', $item357);
        $this->sanitizeEntityValues($item357);
        $manager->persist($item357);
        $item358 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Tongatapu");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry228'));
        })->call($item358);

        $this->addReference('_reference_ProviderTimezone358', $item358);
        $this->sanitizeEntityValues($item358);
        $manager->persist($item358);
        $item359 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Istanbul");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry232'));
        })->call($item359);

        $this->addReference('_reference_ProviderTimezone359', $item359);
        $this->sanitizeEntityValues($item359);
        $manager->persist($item359);
        $item360 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Port_of_Spain");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry229'));
        })->call($item360);

        $this->addReference('_reference_ProviderTimezone360', $item360);
        $this->sanitizeEntityValues($item360);
        $manager->persist($item360);
        $item361 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Funafuti");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry233'));
        })->call($item361);

        $this->addReference('_reference_ProviderTimezone361', $item361);
        $this->sanitizeEntityValues($item361);
        $manager->persist($item361);
        $item362 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Taipei");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry219'));
        })->call($item362);

        $this->addReference('_reference_ProviderTimezone362', $item362);
        $this->sanitizeEntityValues($item362);
        $manager->persist($item362);
        $item363 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Dar_es_Salaam");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry220'));
        })->call($item363);

        $this->addReference('_reference_ProviderTimezone363', $item363);
        $this->sanitizeEntityValues($item363);
        $manager->persist($item363);
        $item364 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Kiev");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry234'));
        })->call($item364);

        $this->addReference('_reference_ProviderTimezone364', $item364);
        $this->sanitizeEntityValues($item364);
        $manager->persist($item364);
        $item365 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Uzhgorod");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry234'));
        })->call($item365);

        $this->addReference('_reference_ProviderTimezone365', $item365);
        $this->sanitizeEntityValues($item365);
        $manager->persist($item365);
        $item366 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Zaporozhye");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry234'));
        })->call($item366);

        $this->addReference('_reference_ProviderTimezone366', $item366);
        $this->sanitizeEntityValues($item366);
        $manager->persist($item366);
        $item367 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Kampala");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry235'));
        })->call($item367);

        $this->addReference('_reference_ProviderTimezone367', $item367);
        $this->sanitizeEntityValues($item367);
        $manager->persist($item367);
        $item368 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Johnston");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry111'));
        })->call($item368);

        $this->addReference('_reference_ProviderTimezone368', $item368);
        $this->sanitizeEntityValues($item368);
        $manager->persist($item368);
        $item369 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Midway");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry111'));
        })->call($item369);

        $this->addReference('_reference_ProviderTimezone369', $item369);
        $this->sanitizeEntityValues($item369);
        $manager->persist($item369);
        $item370 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Wake");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry111'));
        })->call($item370);

        $this->addReference('_reference_ProviderTimezone370', $item370);
        $this->sanitizeEntityValues($item370);
        $manager->persist($item370);
        $item371 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/New_York");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item371);

        $this->addReference('_reference_ProviderTimezone371', $item371);
        $this->sanitizeEntityValues($item371);
        $manager->persist($item371);
        $item372 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Detroit");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item372);

        $this->addReference('_reference_ProviderTimezone372', $item372);
        $this->sanitizeEntityValues($item372);
        $manager->persist($item372);
        $item373 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Kentucky/Louisville");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item373);

        $this->addReference('_reference_ProviderTimezone373', $item373);
        $this->sanitizeEntityValues($item373);
        $manager->persist($item373);
        $item374 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Kentucky/Monticello");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item374);

        $this->addReference('_reference_ProviderTimezone374', $item374);
        $this->sanitizeEntityValues($item374);
        $manager->persist($item374);
        $item375 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Indiana/Indianapolis");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item375);

        $this->addReference('_reference_ProviderTimezone375', $item375);
        $this->sanitizeEntityValues($item375);
        $manager->persist($item375);
        $item376 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Indiana/Vincennes");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item376);

        $this->addReference('_reference_ProviderTimezone376', $item376);
        $this->sanitizeEntityValues($item376);
        $manager->persist($item376);
        $item377 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Indiana/Winamac");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item377);

        $this->addReference('_reference_ProviderTimezone377', $item377);
        $this->sanitizeEntityValues($item377);
        $manager->persist($item377);
        $item378 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Indiana/Marengo");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item378);

        $this->addReference('_reference_ProviderTimezone378', $item378);
        $this->sanitizeEntityValues($item378);
        $manager->persist($item378);
        $item379 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Indiana/Petersburg");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item379);

        $this->addReference('_reference_ProviderTimezone379', $item379);
        $this->sanitizeEntityValues($item379);
        $manager->persist($item379);
        $item380 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Indiana/Vevay");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item380);

        $this->addReference('_reference_ProviderTimezone380', $item380);
        $this->sanitizeEntityValues($item380);
        $manager->persist($item380);
        $item381 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Chicago");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item381);

        $this->addReference('_reference_ProviderTimezone381', $item381);
        $this->sanitizeEntityValues($item381);
        $manager->persist($item381);
        $item382 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Indiana/Tell_City");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item382);

        $this->addReference('_reference_ProviderTimezone382', $item382);
        $this->sanitizeEntityValues($item382);
        $manager->persist($item382);
        $item383 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Indiana/Knox");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item383);

        $this->addReference('_reference_ProviderTimezone383', $item383);
        $this->sanitizeEntityValues($item383);
        $manager->persist($item383);
        $item384 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Menominee");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item384);

        $this->addReference('_reference_ProviderTimezone384', $item384);
        $this->sanitizeEntityValues($item384);
        $manager->persist($item384);
        $item385 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/North_Dakota/Center");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item385);

        $this->addReference('_reference_ProviderTimezone385', $item385);
        $this->sanitizeEntityValues($item385);
        $manager->persist($item385);
        $item386 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/North_Dakota/New_Salem");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item386);

        $this->addReference('_reference_ProviderTimezone386', $item386);
        $this->sanitizeEntityValues($item386);
        $manager->persist($item386);
        $item387 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/North_Dakota/Beulah");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item387);

        $this->addReference('_reference_ProviderTimezone387', $item387);
        $this->sanitizeEntityValues($item387);
        $manager->persist($item387);
        $item388 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Denver");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item388);

        $this->addReference('_reference_ProviderTimezone388', $item388);
        $this->sanitizeEntityValues($item388);
        $manager->persist($item388);
        $item389 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Boise");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item389);

        $this->addReference('_reference_ProviderTimezone389', $item389);
        $this->sanitizeEntityValues($item389);
        $manager->persist($item389);
        $item390 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Phoenix");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item390);

        $this->addReference('_reference_ProviderTimezone390', $item390);
        $this->sanitizeEntityValues($item390);
        $manager->persist($item390);
        $item391 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Los_Angeles");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item391);

        $this->addReference('_reference_ProviderTimezone391', $item391);
        $this->sanitizeEntityValues($item391);
        $manager->persist($item391);
        $item392 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Metlakatla");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item392);

        $this->addReference('_reference_ProviderTimezone392', $item392);
        $this->sanitizeEntityValues($item392);
        $manager->persist($item392);
        $item393 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Anchorage");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item393);

        $this->addReference('_reference_ProviderTimezone393', $item393);
        $this->sanitizeEntityValues($item393);
        $manager->persist($item393);
        $item394 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Juneau");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item394);

        $this->addReference('_reference_ProviderTimezone394', $item394);
        $this->sanitizeEntityValues($item394);
        $manager->persist($item394);
        $item395 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Sitka");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item395);

        $this->addReference('_reference_ProviderTimezone395', $item395);
        $this->sanitizeEntityValues($item395);
        $manager->persist($item395);
        $item396 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Yakutat");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item396);

        $this->addReference('_reference_ProviderTimezone396', $item396);
        $this->sanitizeEntityValues($item396);
        $manager->persist($item396);
        $item397 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Nome");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item397);

        $this->addReference('_reference_ProviderTimezone397', $item397);
        $this->sanitizeEntityValues($item397);
        $manager->persist($item397);
        $item398 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Adak");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item398);

        $this->addReference('_reference_ProviderTimezone398', $item398);
        $this->sanitizeEntityValues($item398);
        $manager->persist($item398);
        $item399 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Honolulu");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item399);

        $this->addReference('_reference_ProviderTimezone399', $item399);
        $this->sanitizeEntityValues($item399);
        $manager->persist($item399);
        $item400 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Montevideo");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry236'));
        })->call($item400);

        $this->addReference('_reference_ProviderTimezone400', $item400);
        $this->sanitizeEntityValues($item400);
        $manager->persist($item400);
        $item401 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Samarkand");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry237'));
        })->call($item401);

        $this->addReference('_reference_ProviderTimezone401', $item401);
        $this->sanitizeEntityValues($item401);
        $manager->persist($item401);
        $item402 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Tashkent");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry237'));
        })->call($item402);

        $this->addReference('_reference_ProviderTimezone402', $item402);
        $this->sanitizeEntityValues($item402);
        $manager->persist($item402);
        $item403 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Europe/Vatican");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry43'));
        })->call($item403);

        $this->addReference('_reference_ProviderTimezone403', $item403);
        $this->sanitizeEntityValues($item403);
        $manager->persist($item403);
        $item404 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/St_Vincent");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry199'));
        })->call($item404);

        $this->addReference('_reference_ProviderTimezone404', $item404);
        $this->sanitizeEntityValues($item404);
        $manager->persist($item404);
        $item405 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Caracas");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry239'));
        })->call($item405);

        $this->addReference('_reference_ProviderTimezone405', $item405);
        $this->sanitizeEntityValues($item405);
        $manager->persist($item405);
        $item406 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/Tortola");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry115'));
        })->call($item406);

        $this->addReference('_reference_ProviderTimezone406', $item406);
        $this->sanitizeEntityValues($item406);
        $manager->persist($item406);
        $item407 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("America/St_Thomas");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry116'));
        })->call($item407);

        $this->addReference('_reference_ProviderTimezone407', $item407);
        $this->sanitizeEntityValues($item407);
        $manager->persist($item407);
        $item408 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Ho_Chi_Minh");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry240'));
        })->call($item408);

        $this->addReference('_reference_ProviderTimezone408', $item408);
        $this->sanitizeEntityValues($item408);
        $manager->persist($item408);
        $item409 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Efate");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry238'));
        })->call($item409);

        $this->addReference('_reference_ProviderTimezone409', $item409);
        $this->sanitizeEntityValues($item409);
        $manager->persist($item409);
        $item410 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Wallis");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry241'));
        })->call($item410);

        $this->addReference('_reference_ProviderTimezone410', $item410);
        $this->sanitizeEntityValues($item410);
        $manager->persist($item410);
        $item411 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Pacific/Apia");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry192'));
        })->call($item411);

        $this->addReference('_reference_ProviderTimezone411', $item411);
        $this->sanitizeEntityValues($item411);
        $manager->persist($item411);
        $item412 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Asia/Aden");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry242'));
        })->call($item412);

        $this->addReference('_reference_ProviderTimezone412', $item412);
        $this->sanitizeEntityValues($item412);
        $manager->persist($item412);
        $item413 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Indian/Mayotte");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry148'));
        })->call($item413);

        $this->addReference('_reference_ProviderTimezone413', $item413);
        $this->sanitizeEntityValues($item413);
        $manager->persist($item413);
        $item414 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Johannesburg");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry212'));
        })->call($item414);

        $this->addReference('_reference_ProviderTimezone414', $item414);
        $this->sanitizeEntityValues($item414);
        $manager->persist($item414);
        $item415 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Lusaka");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry244'));
        })->call($item415);

        $this->addReference('_reference_ProviderTimezone415', $item415);
        $this->sanitizeEntityValues($item415);
        $manager->persist($item415);
        $item416 = $this->createEntityInstance(Timezone::class);
        (function () use ($fixture) {
            $this->setTz("Africa/Harare");
            $this->setLabel(new Label('', '', '', ''));


            $this->setCountry($fixture->getReference('_reference_ProviderCountry245'));
        })->call($item416);

        $this->addReference('_reference_ProviderTimezone416', $item416);
        $this->sanitizeEntityValues($item416);
        $manager->persist($item416);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCountry::class
        );
    }
}
