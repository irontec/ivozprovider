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
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Timezone::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Andorra");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item1);

        $item1->setCountry($this->getReference('_reference_ProviderCountry1'));
        $this->addReference('_reference_ProviderTimezone1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);
        $item2 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Dubai");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item2);

        $item2->setCountry($this->getReference('_reference_ProviderCountry58'));
        $this->addReference('_reference_ProviderTimezone2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);
        $item3 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Kabul");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item3);

        $item3->setCountry($this->getReference('_reference_ProviderCountry1'));
        $this->addReference('_reference_ProviderTimezone3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);
        $item4 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Antigua");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item4);

        $item4->setCountry($this->getReference('_reference_ProviderCountry8'));
        $this->addReference('_reference_ProviderTimezone4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);
        $item5 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Anguilla");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item5);

        $item5->setCountry($this->getReference('_reference_ProviderCountry6'));
        $this->addReference('_reference_ProviderTimezone5', $item5);
        $this->sanitizeEntityValues($item5);
        $manager->persist($item5);
        $item6 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Tirane");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item6);

        $item6->setCountry($this->getReference('_reference_ProviderCountry2'));
        $this->addReference('_reference_ProviderTimezone6', $item6);
        $this->sanitizeEntityValues($item6);
        $manager->persist($item6);
        $item7 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Yerevan");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item7);

        $item7->setCountry($this->getReference('_reference_ProviderCountry12'));
        $this->addReference('_reference_ProviderTimezone7', $item7);
        $this->sanitizeEntityValues($item7);
        $manager->persist($item7);
        $item8 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Luanda");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item8);

        $item8->setCountry($this->getReference('_reference_ProviderCountry5'));
        $this->addReference('_reference_ProviderTimezone8', $item8);
        $this->sanitizeEntityValues($item8);
        $manager->persist($item8);
        $item9 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Antarctica/McMurdo");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item9);

        $item9->setCountry($this->getReference('_reference_ProviderCountry7'));
        $this->addReference('_reference_ProviderTimezone9', $item9);
        $this->sanitizeEntityValues($item9);
        $manager->persist($item9);
        $item10 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Antarctica/Rothera");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item10);

        $item10->setCountry($this->getReference('_reference_ProviderCountry7'));
        $this->addReference('_reference_ProviderTimezone10', $item10);
        $this->sanitizeEntityValues($item10);
        $manager->persist($item10);
        $item11 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Antarctica/Palmer");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item11);

        $item11->setCountry($this->getReference('_reference_ProviderCountry7'));
        $this->addReference('_reference_ProviderTimezone11', $item11);
        $this->sanitizeEntityValues($item11);
        $manager->persist($item11);
        $item12 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Antarctica/Mawson");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item12);

        $item12->setCountry($this->getReference('_reference_ProviderCountry7'));
        $this->addReference('_reference_ProviderTimezone12', $item12);
        $this->sanitizeEntityValues($item12);
        $manager->persist($item12);
        $item13 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Antarctica/Davis");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item13);

        $item13->setCountry($this->getReference('_reference_ProviderCountry7'));
        $this->addReference('_reference_ProviderTimezone13', $item13);
        $this->sanitizeEntityValues($item13);
        $manager->persist($item13);
        $item14 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Antarctica/Casey");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item14);

        $item14->setCountry($this->getReference('_reference_ProviderCountry7'));
        $this->addReference('_reference_ProviderTimezone14', $item14);
        $this->sanitizeEntityValues($item14);
        $manager->persist($item14);
        $item15 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Antarctica/Vostok");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item15);

        $item15->setCountry($this->getReference('_reference_ProviderCountry7'));
        $this->addReference('_reference_ProviderTimezone15', $item15);
        $this->sanitizeEntityValues($item15);
        $manager->persist($item15);
        $item16 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Antarctica/DumontDUrville");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item16);

        $item16->setCountry($this->getReference('_reference_ProviderCountry7'));
        $this->addReference('_reference_ProviderTimezone16', $item16);
        $this->sanitizeEntityValues($item16);
        $manager->persist($item16);
        $item17 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Antarctica/Syowa");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item17);

        $item17->setCountry($this->getReference('_reference_ProviderCountry7'));
        $this->addReference('_reference_ProviderTimezone17', $item17);
        $this->sanitizeEntityValues($item17);
        $manager->persist($item17);
        $item18 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Antarctica/Troll");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item18);

        $item18->setCountry($this->getReference('_reference_ProviderCountry7'));
        $this->addReference('_reference_ProviderTimezone18', $item18);
        $this->sanitizeEntityValues($item18);
        $manager->persist($item18);
        $item19 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Argentina/Buenos_Aires");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item19);

        $item19->setCountry($this->getReference('_reference_ProviderCountry11'));
        $this->addReference('_reference_ProviderTimezone19', $item19);
        $this->sanitizeEntityValues($item19);
        $manager->persist($item19);
        $item20 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Argentina/Cordoba");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item20);

        $item20->setCountry($this->getReference('_reference_ProviderCountry11'));
        $this->addReference('_reference_ProviderTimezone20', $item20);
        $this->sanitizeEntityValues($item20);
        $manager->persist($item20);
        $item21 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Argentina/Salta");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item21);

        $item21->setCountry($this->getReference('_reference_ProviderCountry11'));
        $this->addReference('_reference_ProviderTimezone21', $item21);
        $this->sanitizeEntityValues($item21);
        $manager->persist($item21);
        $item22 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Argentina/Jujuy");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item22);

        $item22->setCountry($this->getReference('_reference_ProviderCountry11'));
        $this->addReference('_reference_ProviderTimezone22', $item22);
        $this->sanitizeEntityValues($item22);
        $manager->persist($item22);
        $item23 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Argentina/Tucuman");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item23);

        $item23->setCountry($this->getReference('_reference_ProviderCountry11'));
        $this->addReference('_reference_ProviderTimezone23', $item23);
        $this->sanitizeEntityValues($item23);
        $manager->persist($item23);
        $item24 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Argentina/Catamarca");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item24);

        $item24->setCountry($this->getReference('_reference_ProviderCountry11'));
        $this->addReference('_reference_ProviderTimezone24', $item24);
        $this->sanitizeEntityValues($item24);
        $manager->persist($item24);
        $item25 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Argentina/La_Rioja");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item25);

        $item25->setCountry($this->getReference('_reference_ProviderCountry11'));
        $this->addReference('_reference_ProviderTimezone25', $item25);
        $this->sanitizeEntityValues($item25);
        $manager->persist($item25);
        $item26 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Argentina/San_Juan");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item26);

        $item26->setCountry($this->getReference('_reference_ProviderCountry11'));
        $this->addReference('_reference_ProviderTimezone26', $item26);
        $this->sanitizeEntityValues($item26);
        $manager->persist($item26);
        $item27 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Argentina/Mendoza");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item27);

        $item27->setCountry($this->getReference('_reference_ProviderCountry11'));
        $this->addReference('_reference_ProviderTimezone27', $item27);
        $this->sanitizeEntityValues($item27);
        $manager->persist($item27);
        $item28 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Argentina/San_Luis");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item28);

        $item28->setCountry($this->getReference('_reference_ProviderCountry11'));
        $this->addReference('_reference_ProviderTimezone28', $item28);
        $this->sanitizeEntityValues($item28);
        $manager->persist($item28);
        $item29 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Argentina/Rio_Gallegos");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item29);

        $item29->setCountry($this->getReference('_reference_ProviderCountry11'));
        $this->addReference('_reference_ProviderTimezone29', $item29);
        $this->sanitizeEntityValues($item29);
        $manager->persist($item29);
        $item30 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Argentina/Ushuaia");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item30);

        $item30->setCountry($this->getReference('_reference_ProviderCountry11'));
        $this->addReference('_reference_ProviderTimezone30', $item30);
        $this->sanitizeEntityValues($item30);
        $manager->persist($item30);
        $item31 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Pago_Pago");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item31);

        $item31->setCountry($this->getReference('_reference_ProviderCountry193'));
        $this->addReference('_reference_ProviderTimezone31', $item31);
        $this->sanitizeEntityValues($item31);
        $manager->persist($item31);
        $item32 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Vienna");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item32);

        $item32->setCountry($this->getReference('_reference_ProviderCountry15'));
        $this->addReference('_reference_ProviderTimezone32', $item32);
        $this->sanitizeEntityValues($item32);
        $manager->persist($item32);
        $item33 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Australia/Lord_Howe");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item33);

        $item33->setCountry($this->getReference('_reference_ProviderCountry14'));
        $this->addReference('_reference_ProviderTimezone33', $item33);
        $this->sanitizeEntityValues($item33);
        $manager->persist($item33);
        $item34 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Antarctica/Macquarie");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item34);

        $item34->setCountry($this->getReference('_reference_ProviderCountry14'));
        $this->addReference('_reference_ProviderTimezone34', $item34);
        $this->sanitizeEntityValues($item34);
        $manager->persist($item34);
        $item35 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Australia/Hobart");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item35);

        $item35->setCountry($this->getReference('_reference_ProviderCountry14'));
        $this->addReference('_reference_ProviderTimezone35', $item35);
        $this->sanitizeEntityValues($item35);
        $manager->persist($item35);
        $item36 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Australia/Currie");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item36);

        $item36->setCountry($this->getReference('_reference_ProviderCountry14'));
        $this->addReference('_reference_ProviderTimezone36', $item36);
        $this->sanitizeEntityValues($item36);
        $manager->persist($item36);
        $item37 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Australia/Melbourne");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item37);

        $item37->setCountry($this->getReference('_reference_ProviderCountry14'));
        $this->addReference('_reference_ProviderTimezone37', $item37);
        $this->sanitizeEntityValues($item37);
        $manager->persist($item37);
        $item38 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Australia/Sydney");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item38);

        $item38->setCountry($this->getReference('_reference_ProviderCountry14'));
        $this->addReference('_reference_ProviderTimezone38', $item38);
        $this->sanitizeEntityValues($item38);
        $manager->persist($item38);
        $item39 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Australia/Broken_Hill");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item39);

        $item39->setCountry($this->getReference('_reference_ProviderCountry14'));
        $this->addReference('_reference_ProviderTimezone39', $item39);
        $this->sanitizeEntityValues($item39);
        $manager->persist($item39);
        $item40 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Australia/Brisbane");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item40);

        $item40->setCountry($this->getReference('_reference_ProviderCountry14'));
        $this->addReference('_reference_ProviderTimezone40', $item40);
        $this->sanitizeEntityValues($item40);
        $manager->persist($item40);
        $item41 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Australia/Lindeman");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item41);

        $item41->setCountry($this->getReference('_reference_ProviderCountry14'));
        $this->addReference('_reference_ProviderTimezone41', $item41);
        $this->sanitizeEntityValues($item41);
        $manager->persist($item41);
        $item42 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Australia/Adelaide");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item42);

        $item42->setCountry($this->getReference('_reference_ProviderCountry14'));
        $this->addReference('_reference_ProviderTimezone42', $item42);
        $this->sanitizeEntityValues($item42);
        $manager->persist($item42);
        $item43 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Australia/Darwin");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item43);

        $item43->setCountry($this->getReference('_reference_ProviderCountry14'));
        $this->addReference('_reference_ProviderTimezone43', $item43);
        $this->sanitizeEntityValues($item43);
        $manager->persist($item43);
        $item44 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Australia/Perth");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item44);

        $item44->setCountry($this->getReference('_reference_ProviderCountry14'));
        $this->addReference('_reference_ProviderTimezone44', $item44);
        $this->sanitizeEntityValues($item44);
        $manager->persist($item44);
        $item45 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Australia/Eucla");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item45);

        $item45->setCountry($this->getReference('_reference_ProviderCountry14'));
        $this->addReference('_reference_ProviderTimezone45', $item45);
        $this->sanitizeEntityValues($item45);
        $manager->persist($item45);
        $item46 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Aruba");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item46);

        $item46->setCountry($this->getReference('_reference_ProviderCountry13'));
        $this->addReference('_reference_ProviderTimezone46', $item46);
        $this->sanitizeEntityValues($item46);
        $manager->persist($item46);
        $item47 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Mariehamn");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item47);

        $item47->setCountry($this->getReference('_reference_ProviderCountry101'));
        $this->addReference('_reference_ProviderTimezone47', $item47);
        $this->sanitizeEntityValues($item47);
        $manager->persist($item47);
        $item48 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Baku");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item48);

        $item48->setCountry($this->getReference('_reference_ProviderCountry16'));
        $this->addReference('_reference_ProviderTimezone48', $item48);
        $this->sanitizeEntityValues($item48);
        $manager->persist($item48);
        $item49 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Sarajevo");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item49);

        $item49->setCountry($this->getReference('_reference_ProviderCountry27'));
        $this->addReference('_reference_ProviderTimezone49', $item49);
        $this->sanitizeEntityValues($item49);
        $manager->persist($item49);
        $item50 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Barbados");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item50);

        $item50->setCountry($this->getReference('_reference_ProviderCountry20'));
        $this->addReference('_reference_ProviderTimezone50', $item50);
        $this->sanitizeEntityValues($item50);
        $manager->persist($item50);
        $item51 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Dhaka");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item51);

        $item51->setCountry($this->getReference('_reference_ProviderCountry19'));
        $this->addReference('_reference_ProviderTimezone51', $item51);
        $this->sanitizeEntityValues($item51);
        $manager->persist($item51);
        $item52 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Brussels");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item52);

        $item52->setCountry($this->getReference('_reference_ProviderCountry21'));
        $this->addReference('_reference_ProviderTimezone52', $item52);
        $this->sanitizeEntityValues($item52);
        $manager->persist($item52);
        $item53 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Ouagadougou");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item53);

        $item53->setCountry($this->getReference('_reference_ProviderCountry32'));
        $this->addReference('_reference_ProviderTimezone53', $item53);
        $this->sanitizeEntityValues($item53);
        $manager->persist($item53);
        $item54 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Sofia");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item54);

        $item54->setCountry($this->getReference('_reference_ProviderCountry31'));
        $this->addReference('_reference_ProviderTimezone54', $item54);
        $this->sanitizeEntityValues($item54);
        $manager->persist($item54);
        $item55 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Bahrain");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item55);

        $item55->setCountry($this->getReference('_reference_ProviderCountry18'));
        $this->addReference('_reference_ProviderTimezone55', $item55);
        $this->sanitizeEntityValues($item55);
        $manager->persist($item55);
        $item56 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Bujumbura");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item56);

        $item56->setCountry($this->getReference('_reference_ProviderCountry33'));
        $this->addReference('_reference_ProviderTimezone56', $item56);
        $this->sanitizeEntityValues($item56);
        $manager->persist($item56);
        $item57 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Porto-Novo");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item57);

        $item57->setCountry($this->getReference('_reference_ProviderCountry23'));
        $this->addReference('_reference_ProviderTimezone57', $item57);
        $this->sanitizeEntityValues($item57);
        $manager->persist($item57);
        $item58 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/St_Barthelemy");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item58);

        $item58->setCountry($this->getReference('_reference_ProviderCountry194'));
        $this->addReference('_reference_ProviderTimezone58', $item58);
        $this->sanitizeEntityValues($item58);
        $manager->persist($item58);
        $item59 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Atlantic/Bermuda");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item59);

        $item59->setCountry($this->getReference('_reference_ProviderCountry24'));
        $this->addReference('_reference_ProviderTimezone59', $item59);
        $this->sanitizeEntityValues($item59);
        $manager->persist($item59);
        $item60 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Brunei");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item60);

        $item60->setCountry($this->getReference('_reference_ProviderCountry30'));
        $this->addReference('_reference_ProviderTimezone60', $item60);
        $this->sanitizeEntityValues($item60);
        $manager->persist($item60);
        $item61 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/La_Paz");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item61);

        $item61->setCountry($this->getReference('_reference_ProviderCountry26'));
        $this->addReference('_reference_ProviderTimezone61', $item61);
        $this->sanitizeEntityValues($item61);
        $manager->persist($item61);
        $item62 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Kralendijk");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item62);

        $item62->setCountry($this->getReference('_reference_ProviderCountry246'));
        $this->addReference('_reference_ProviderTimezone62', $item62);
        $this->sanitizeEntityValues($item62);
        $manager->persist($item62);
        $item63 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Noronha");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item63);

        $item63->setCountry($this->getReference('_reference_ProviderCountry29'));
        $this->addReference('_reference_ProviderTimezone63', $item63);
        $this->sanitizeEntityValues($item63);
        $manager->persist($item63);
        $item64 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Belem");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item64);

        $item64->setCountry($this->getReference('_reference_ProviderCountry29'));
        $this->addReference('_reference_ProviderTimezone64', $item64);
        $this->sanitizeEntityValues($item64);
        $manager->persist($item64);
        $item65 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Fortaleza");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item65);

        $item65->setCountry($this->getReference('_reference_ProviderCountry29'));
        $this->addReference('_reference_ProviderTimezone65', $item65);
        $this->sanitizeEntityValues($item65);
        $manager->persist($item65);
        $item66 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Recife");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item66);

        $item66->setCountry($this->getReference('_reference_ProviderCountry29'));
        $this->addReference('_reference_ProviderTimezone66', $item66);
        $this->sanitizeEntityValues($item66);
        $manager->persist($item66);
        $item67 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Araguaina");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item67);

        $item67->setCountry($this->getReference('_reference_ProviderCountry29'));
        $this->addReference('_reference_ProviderTimezone67', $item67);
        $this->sanitizeEntityValues($item67);
        $manager->persist($item67);
        $item68 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Maceio");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item68);

        $item68->setCountry($this->getReference('_reference_ProviderCountry29'));
        $this->addReference('_reference_ProviderTimezone68', $item68);
        $this->sanitizeEntityValues($item68);
        $manager->persist($item68);
        $item69 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Bahia");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item69);

        $item69->setCountry($this->getReference('_reference_ProviderCountry29'));
        $this->addReference('_reference_ProviderTimezone69', $item69);
        $this->sanitizeEntityValues($item69);
        $manager->persist($item69);
        $item70 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Sao_Paulo");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item70);

        $item70->setCountry($this->getReference('_reference_ProviderCountry29'));
        $this->addReference('_reference_ProviderTimezone70', $item70);
        $this->sanitizeEntityValues($item70);
        $manager->persist($item70);
        $item71 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Campo_Grande");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item71);

        $item71->setCountry($this->getReference('_reference_ProviderCountry29'));
        $this->addReference('_reference_ProviderTimezone71', $item71);
        $this->sanitizeEntityValues($item71);
        $manager->persist($item71);
        $item72 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Cuiaba");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item72);

        $item72->setCountry($this->getReference('_reference_ProviderCountry29'));
        $this->addReference('_reference_ProviderTimezone72', $item72);
        $this->sanitizeEntityValues($item72);
        $manager->persist($item72);
        $item73 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Santarem");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item73);

        $item73->setCountry($this->getReference('_reference_ProviderCountry29'));
        $this->addReference('_reference_ProviderTimezone73', $item73);
        $this->sanitizeEntityValues($item73);
        $manager->persist($item73);
        $item74 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Porto_Velho");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item74);

        $item74->setCountry($this->getReference('_reference_ProviderCountry29'));
        $this->addReference('_reference_ProviderTimezone74', $item74);
        $this->sanitizeEntityValues($item74);
        $manager->persist($item74);
        $item75 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Boa_Vista");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item75);

        $item75->setCountry($this->getReference('_reference_ProviderCountry29'));
        $this->addReference('_reference_ProviderTimezone75', $item75);
        $this->sanitizeEntityValues($item75);
        $manager->persist($item75);
        $item76 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Manaus");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item76);

        $item76->setCountry($this->getReference('_reference_ProviderCountry29'));
        $this->addReference('_reference_ProviderTimezone76', $item76);
        $this->sanitizeEntityValues($item76);
        $manager->persist($item76);
        $item77 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Eirunepe");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item77);

        $item77->setCountry($this->getReference('_reference_ProviderCountry29'));
        $this->addReference('_reference_ProviderTimezone77', $item77);
        $this->sanitizeEntityValues($item77);
        $manager->persist($item77);
        $item78 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Rio_Branco");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item78);

        $item78->setCountry($this->getReference('_reference_ProviderCountry29'));
        $this->addReference('_reference_ProviderTimezone78', $item78);
        $this->sanitizeEntityValues($item78);
        $manager->persist($item78);
        $item79 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Nassau");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item79);

        $item79->setCountry($this->getReference('_reference_ProviderCountry17'));
        $this->addReference('_reference_ProviderTimezone79', $item79);
        $this->sanitizeEntityValues($item79);
        $manager->persist($item79);
        $item80 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Thimphu");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item80);

        $item80->setCountry($this->getReference('_reference_ProviderCountry34'));
        $this->addReference('_reference_ProviderTimezone80', $item80);
        $this->sanitizeEntityValues($item80);
        $manager->persist($item80);
        $item81 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Gaborone");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item81);

        $item81->setCountry($this->getReference('_reference_ProviderCountry28'));
        $this->addReference('_reference_ProviderTimezone81', $item81);
        $this->sanitizeEntityValues($item81);
        $manager->persist($item81);
        $item82 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Minsk");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item82);

        $item82->setCountry($this->getReference('_reference_ProviderCountry25'));
        $this->addReference('_reference_ProviderTimezone82', $item82);
        $this->sanitizeEntityValues($item82);
        $manager->persist($item82);
        $item83 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Belize");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item83);

        $item83->setCountry($this->getReference('_reference_ProviderCountry22'));
        $this->addReference('_reference_ProviderTimezone83', $item83);
        $this->sanitizeEntityValues($item83);
        $manager->persist($item83);
        $item84 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/St_Johns");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item84);

        $item84->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone84', $item84);
        $this->sanitizeEntityValues($item84);
        $manager->persist($item84);
        $item85 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Halifax");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item85);

        $item85->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone85', $item85);
        $this->sanitizeEntityValues($item85);
        $manager->persist($item85);
        $item86 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Glace_Bay");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item86);

        $item86->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone86', $item86);
        $this->sanitizeEntityValues($item86);
        $manager->persist($item86);
        $item87 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Moncton");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item87);

        $item87->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone87', $item87);
        $this->sanitizeEntityValues($item87);
        $manager->persist($item87);
        $item88 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Goose_Bay");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item88);

        $item88->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone88', $item88);
        $this->sanitizeEntityValues($item88);
        $manager->persist($item88);
        $item89 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Blanc-Sablon");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item89);

        $item89->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone89', $item89);
        $this->sanitizeEntityValues($item89);
        $manager->persist($item89);
        $item90 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Toronto");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item90);

        $item90->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone90', $item90);
        $this->sanitizeEntityValues($item90);
        $manager->persist($item90);
        $item91 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Nipigon");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item91);

        $item91->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone91', $item91);
        $this->sanitizeEntityValues($item91);
        $manager->persist($item91);
        $item92 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Thunder_Bay");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item92);

        $item92->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone92', $item92);
        $this->sanitizeEntityValues($item92);
        $manager->persist($item92);
        $item93 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Iqaluit");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item93);

        $item93->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone93', $item93);
        $this->sanitizeEntityValues($item93);
        $manager->persist($item93);
        $item94 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Pangnirtung");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item94);

        $item94->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone94', $item94);
        $this->sanitizeEntityValues($item94);
        $manager->persist($item94);
        $item95 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Resolute");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item95);

        $item95->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone95', $item95);
        $this->sanitizeEntityValues($item95);
        $manager->persist($item95);
        $item96 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Atikokan");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item96);

        $item96->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone96', $item96);
        $this->sanitizeEntityValues($item96);
        $manager->persist($item96);
        $item97 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Rankin_Inlet");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item97);

        $item97->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone97', $item97);
        $this->sanitizeEntityValues($item97);
        $manager->persist($item97);
        $item98 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Winnipeg");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item98);

        $item98->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone98', $item98);
        $this->sanitizeEntityValues($item98);
        $manager->persist($item98);
        $item99 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Rainy_River");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item99);

        $item99->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone99', $item99);
        $this->sanitizeEntityValues($item99);
        $manager->persist($item99);
        $item100 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Regina");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item100);

        $item100->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone100', $item100);
        $this->sanitizeEntityValues($item100);
        $manager->persist($item100);
        $item101 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Swift_Current");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item101);

        $item101->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone101', $item101);
        $this->sanitizeEntityValues($item101);
        $manager->persist($item101);
        $item102 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Edmonton");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item102);

        $item102->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone102', $item102);
        $this->sanitizeEntityValues($item102);
        $manager->persist($item102);
        $item103 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Cambridge_Bay");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item103);

        $item103->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone103', $item103);
        $this->sanitizeEntityValues($item103);
        $manager->persist($item103);
        $item104 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Yellowknife");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item104);

        $item104->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone104', $item104);
        $this->sanitizeEntityValues($item104);
        $manager->persist($item104);
        $item105 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Inuvik");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item105);

        $item105->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone105', $item105);
        $this->sanitizeEntityValues($item105);
        $manager->persist($item105);
        $item106 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Creston");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item106);

        $item106->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone106', $item106);
        $this->sanitizeEntityValues($item106);
        $manager->persist($item106);
        $item107 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Dawson_Creek");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item107);

        $item107->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone107', $item107);
        $this->sanitizeEntityValues($item107);
        $manager->persist($item107);
        $item108 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Vancouver");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item108);

        $item108->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone108', $item108);
        $this->sanitizeEntityValues($item108);
        $manager->persist($item108);
        $item109 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Whitehorse");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item109);

        $item109->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone109', $item109);
        $this->sanitizeEntityValues($item109);
        $manager->persist($item109);
        $item110 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Dawson");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item110);

        $item110->setCountry($this->getReference('_reference_ProviderCountry38'));
        $this->addReference('_reference_ProviderTimezone110', $item110);
        $this->sanitizeEntityValues($item110);
        $manager->persist($item110);
        $item111 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Indian/Cocos");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item111);

        $item111->setCountry($this->getReference('_reference_ProviderCountry103'));
        $this->addReference('_reference_ProviderTimezone111', $item111);
        $this->sanitizeEntityValues($item111);
        $manager->persist($item111);
        $item112 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Kinshasa");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item112);

        $item112->setCountry($this->getReference('_reference_ProviderCountry185'));
        $this->addReference('_reference_ProviderTimezone112', $item112);
        $this->sanitizeEntityValues($item112);
        $manager->persist($item112);
        $item113 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Lubumbashi");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item113);

        $item113->setCountry($this->getReference('_reference_ProviderCountry185'));
        $this->addReference('_reference_ProviderTimezone113', $item113);
        $this->sanitizeEntityValues($item113);
        $manager->persist($item113);
        $item114 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Bangui");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item114);

        $item114->setCountry($this->getReference('_reference_ProviderCountry183'));
        $this->addReference('_reference_ProviderTimezone114', $item114);
        $this->sanitizeEntityValues($item114);
        $manager->persist($item114);
        $item115 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Brazzaville");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item115);

        $item115->setCountry($this->getReference('_reference_ProviderCountry46'));
        $this->addReference('_reference_ProviderTimezone115', $item115);
        $this->sanitizeEntityValues($item115);
        $manager->persist($item115);
        $item116 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Zurich");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item116);

        $item116->setCountry($this->getReference('_reference_ProviderCountry215'));
        $this->addReference('_reference_ProviderTimezone116', $item116);
        $this->sanitizeEntityValues($item116);
        $manager->persist($item116);
        $item117 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Abidjan");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item117);

        $item117->setCountry($this->getReference('_reference_ProviderCountry49'));
        $this->addReference('_reference_ProviderTimezone117', $item117);
        $this->sanitizeEntityValues($item117);
        $manager->persist($item117);
        $item118 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Rarotonga");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item118);

        $item118->setCountry($this->getReference('_reference_ProviderCountry104'));
        $this->addReference('_reference_ProviderTimezone118', $item118);
        $this->sanitizeEntityValues($item118);
        $manager->persist($item118);
        $item119 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Santiago");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item119);

        $item119->setCountry($this->getReference('_reference_ProviderCountry40'));
        $this->addReference('_reference_ProviderTimezone119', $item119);
        $this->sanitizeEntityValues($item119);
        $manager->persist($item119);
        $item120 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Easter");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item120);

        $item120->setCountry($this->getReference('_reference_ProviderCountry40'));
        $this->addReference('_reference_ProviderTimezone120', $item120);
        $this->sanitizeEntityValues($item120);
        $manager->persist($item120);
        $item121 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Douala");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item121);

        $item121->setCountry($this->getReference('_reference_ProviderCountry37'));
        $this->addReference('_reference_ProviderTimezone121', $item121);
        $this->sanitizeEntityValues($item121);
        $manager->persist($item121);
        $item122 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Shanghai");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item122);

        $item122->setCountry($this->getReference('_reference_ProviderCountry41'));
        $this->addReference('_reference_ProviderTimezone122', $item122);
        $this->sanitizeEntityValues($item122);
        $manager->persist($item122);
        $item123 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Urumqi");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item123);

        $item123->setCountry($this->getReference('_reference_ProviderCountry41'));
        $this->addReference('_reference_ProviderTimezone123', $item123);
        $this->sanitizeEntityValues($item123);
        $manager->persist($item123);
        $item124 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Bogota");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item124);

        $item124->setCountry($this->getReference('_reference_ProviderCountry44'));
        $this->addReference('_reference_ProviderTimezone124', $item124);
        $this->sanitizeEntityValues($item124);
        $manager->persist($item124);
        $item125 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Costa_Rica");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item125);

        $item125->setCountry($this->getReference('_reference_ProviderCountry50'));
        $this->addReference('_reference_ProviderTimezone125', $item125);
        $this->sanitizeEntityValues($item125);
        $manager->persist($item125);
        $item126 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Havana");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item126);

        $item126->setCountry($this->getReference('_reference_ProviderCountry52'));
        $this->addReference('_reference_ProviderTimezone126', $item126);
        $this->sanitizeEntityValues($item126);
        $manager->persist($item126);
        $item127 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Atlantic/Cape_Verde");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item127);

        $item127->setCountry($this->getReference('_reference_ProviderCountry35'));
        $this->addReference('_reference_ProviderTimezone127', $item127);
        $this->sanitizeEntityValues($item127);
        $manager->persist($item127);
        $item128 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Curacao");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item128);

        $item128->setCountry($this->getReference('_reference_ProviderCountry247'));
        $this->addReference('_reference_ProviderTimezone128', $item128);
        $this->sanitizeEntityValues($item128);
        $manager->persist($item128);
        $item129 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Indian/Christmas");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item129);

        $item129->setCountry($this->getReference('_reference_ProviderCountry96'));
        $this->addReference('_reference_ProviderTimezone129', $item129);
        $this->sanitizeEntityValues($item129);
        $manager->persist($item129);
        $item130 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Nicosia");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item130);

        $item130->setCountry($this->getReference('_reference_ProviderCountry42'));
        $this->addReference('_reference_ProviderTimezone130', $item130);
        $this->sanitizeEntityValues($item130);
        $manager->persist($item130);
        $item131 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Prague");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item131);

        $item131->setCountry($this->getReference('_reference_ProviderCountry184'));
        $this->addReference('_reference_ProviderTimezone131', $item131);
        $this->sanitizeEntityValues($item131);
        $manager->persist($item131);
        $item132 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Berlin");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item132);

        $item132->setCountry($this->getReference('_reference_ProviderCountry3'));
        $this->addReference('_reference_ProviderTimezone132', $item132);
        $this->sanitizeEntityValues($item132);
        $manager->persist($item132);
        $item133 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Busingen");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item133);

        $item133->setCountry($this->getReference('_reference_ProviderCountry3'));
        $this->addReference('_reference_ProviderTimezone133', $item133);
        $this->sanitizeEntityValues($item133);
        $manager->persist($item133);
        $item134 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Djibouti");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item134);

        $item134->setCountry($this->getReference('_reference_ProviderCountry243'));
        $this->addReference('_reference_ProviderTimezone134', $item134);
        $this->sanitizeEntityValues($item134);
        $manager->persist($item134);
        $item135 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Copenhagen");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item135);

        $item135->setCountry($this->getReference('_reference_ProviderCountry53'));
        $this->addReference('_reference_ProviderTimezone135', $item135);
        $this->sanitizeEntityValues($item135);
        $manager->persist($item135);
        $item136 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Dominica");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item136);

        $item136->setCountry($this->getReference('_reference_ProviderCountry54'));
        $this->addReference('_reference_ProviderTimezone136', $item136);
        $this->sanitizeEntityValues($item136);
        $manager->persist($item136);
        $item137 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Santo_Domingo");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item137);

        $item137->setCountry($this->getReference('_reference_ProviderCountry186'));
        $this->addReference('_reference_ProviderTimezone137', $item137);
        $this->sanitizeEntityValues($item137);
        $manager->persist($item137);
        $item138 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Algiers");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item138);

        $item138->setCountry($this->getReference('_reference_ProviderCountry10'));
        $this->addReference('_reference_ProviderTimezone138', $item138);
        $this->sanitizeEntityValues($item138);
        $manager->persist($item138);
        $item139 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Guayaquil");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item139);

        $item139->setCountry($this->getReference('_reference_ProviderCountry55'));
        $this->addReference('_reference_ProviderTimezone139', $item139);
        $this->sanitizeEntityValues($item139);
        $manager->persist($item139);
        $item140 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Galapagos");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item140);

        $item140->setCountry($this->getReference('_reference_ProviderCountry55'));
        $this->addReference('_reference_ProviderTimezone140', $item140);
        $this->sanitizeEntityValues($item140);
        $manager->persist($item140);
        $item141 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Tallinn");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item141);

        $item141->setCountry($this->getReference('_reference_ProviderCountry64'));
        $this->addReference('_reference_ProviderTimezone141', $item141);
        $this->sanitizeEntityValues($item141);
        $manager->persist($item141);
        $item142 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Cairo");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item142);

        $item142->setCountry($this->getReference('_reference_ProviderCountry56'));
        $this->addReference('_reference_ProviderTimezone142', $item142);
        $this->sanitizeEntityValues($item142);
        $manager->persist($item142);
        $item143 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/El_Aaiun");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item143);

        $item143->setCountry($this->getReference('_reference_ProviderCountry191'));
        $this->addReference('_reference_ProviderTimezone143', $item143);
        $this->sanitizeEntityValues($item143);
        $manager->persist($item143);
        $item144 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Asmara");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item144);

        $item144->setCountry($this->getReference('_reference_ProviderCountry59'));
        $this->addReference('_reference_ProviderTimezone144', $item144);
        $this->sanitizeEntityValues($item144);
        $manager->persist($item144);
        $item145 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Madrid");
            $this->setComment("mainland");
            $this->setLabel(new Label('en', 'es', 'ca', 'it'));
        })->call($item145);

        $item145->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone145', $item145);
        $this->sanitizeEntityValues($item145);
        $manager->persist($item145);
        $item146 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Ceuta");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item146);

        $item146->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone146', $item146);
        $this->sanitizeEntityValues($item146);
        $manager->persist($item146);
        $item147 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Atlantic/Canary");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item147);

        $item147->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone147', $item147);
        $this->sanitizeEntityValues($item147);
        $manager->persist($item147);
        $item148 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Addis_Ababa");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item148);

        $item148->setCountry($this->getReference('_reference_ProviderCountry65'));
        $this->addReference('_reference_ProviderTimezone148', $item148);
        $this->sanitizeEntityValues($item148);
        $manager->persist($item148);
        $item149 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Helsinki");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item149);

        $item149->setCountry($this->getReference('_reference_ProviderCountry67'));
        $this->addReference('_reference_ProviderTimezone149', $item149);
        $this->sanitizeEntityValues($item149);
        $manager->persist($item149);
        $item150 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Fiji");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item150);

        $item150->setCountry($this->getReference('_reference_ProviderCountry68'));
        $this->addReference('_reference_ProviderTimezone150', $item150);
        $this->sanitizeEntityValues($item150);
        $manager->persist($item150);
        $item151 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Atlantic/Stanley");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item151);

        $item151->setCountry($this->getReference('_reference_ProviderCountry108'));
        $this->addReference('_reference_ProviderTimezone151', $item151);
        $this->sanitizeEntityValues($item151);
        $manager->persist($item151);
        $item152 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Chuuk");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item152);

        $item152->setCountry($this->getReference('_reference_ProviderCountry150'));
        $this->addReference('_reference_ProviderTimezone152', $item152);
        $this->sanitizeEntityValues($item152);
        $manager->persist($item152);
        $item153 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Pohnpei");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item153);

        $item153->setCountry($this->getReference('_reference_ProviderCountry150'));
        $this->addReference('_reference_ProviderTimezone153', $item153);
        $this->sanitizeEntityValues($item153);
        $manager->persist($item153);
        $item154 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Kosrae");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item154);

        $item154->setCountry($this->getReference('_reference_ProviderCountry150'));
        $this->addReference('_reference_ProviderTimezone154', $item154);
        $this->sanitizeEntityValues($item154);
        $manager->persist($item154);
        $item155 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Atlantic/Faroe");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item155);

        $item155->setCountry($this->getReference('_reference_ProviderCountry105'));
        $this->addReference('_reference_ProviderTimezone155', $item155);
        $this->sanitizeEntityValues($item155);
        $manager->persist($item155);
        $item156 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Paris");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item156);

        $item156->setCountry($this->getReference('_reference_ProviderCountry69'));
        $this->addReference('_reference_ProviderTimezone156', $item156);
        $this->sanitizeEntityValues($item156);
        $manager->persist($item156);
        $item157 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Libreville");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item157);

        $item157->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone157', $item157);
        $this->sanitizeEntityValues($item157);
        $manager->persist($item157);

        $item158 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/London");
            $this->setLabel(new Label('en', 'es', 'ca', 'it'));
        })->call($item158);

        $item158->setCountry($this->getReference('_reference_ProviderCountry182'));
        $this->addReference('_reference_ProviderTimezone158', $item158);
        $this->sanitizeEntityValues($item158);
        $manager->persist($item158);
        $item159 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Grenada");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item159);

        $item159->setCountry($this->getReference('_reference_ProviderCountry75'));
        $this->addReference('_reference_ProviderTimezone159', $item159);
        $this->sanitizeEntityValues($item159);
        $manager->persist($item159);
        $item160 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Tbilisi");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item160);

        $item160->setCountry($this->getReference('_reference_ProviderCountry72'));
        $this->addReference('_reference_ProviderTimezone160', $item160);
        $this->sanitizeEntityValues($item160);
        $manager->persist($item160);
        $item161 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Cayenne");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item161);

        $item161->setCountry($this->getReference('_reference_ProviderCountry81'));
        $this->addReference('_reference_ProviderTimezone161', $item161);
        $this->sanitizeEntityValues($item161);
        $manager->persist($item161);
        $item162 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Guernsey");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item162);

        $item162->setCountry($this->getReference('_reference_ProviderCountry82'));
        $this->addReference('_reference_ProviderTimezone162', $item162);
        $this->sanitizeEntityValues($item162);
        $manager->persist($item162);
        $item163 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Accra");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item163);

        $item163->setCountry($this->getReference('_reference_ProviderCountry73'));
        $this->addReference('_reference_ProviderTimezone163', $item163);
        $this->sanitizeEntityValues($item163);
        $manager->persist($item163);
        $item164 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Gibraltar");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item164);

        $item164->setCountry($this->getReference('_reference_ProviderCountry74'));
        $this->addReference('_reference_ProviderTimezone164', $item164);
        $this->sanitizeEntityValues($item164);
        $manager->persist($item164);
        $item165 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Godthab");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item165);

        $item165->setCountry($this->getReference('_reference_ProviderCountry77'));
        $this->addReference('_reference_ProviderTimezone165', $item165);
        $this->sanitizeEntityValues($item165);
        $manager->persist($item165);
        $item166 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Danmarkshavn");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item166);

        $item166->setCountry($this->getReference('_reference_ProviderCountry77'));
        $this->addReference('_reference_ProviderTimezone166', $item166);
        $this->sanitizeEntityValues($item166);
        $manager->persist($item166);
        $item167 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Scoresbysund");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item167);

        $item167->setCountry($this->getReference('_reference_ProviderCountry77'));
        $this->addReference('_reference_ProviderTimezone167', $item167);
        $this->sanitizeEntityValues($item167);
        $manager->persist($item167);
        $item168 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Thule");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item168);

        $item168->setCountry($this->getReference('_reference_ProviderCountry77'));
        $this->addReference('_reference_ProviderTimezone168', $item168);
        $this->sanitizeEntityValues($item168);
        $manager->persist($item168);
        $item169 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Banjul");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item169);

        $item169->setCountry($this->getReference('_reference_ProviderCountry71'));
        $this->addReference('_reference_ProviderTimezone169', $item169);
        $this->sanitizeEntityValues($item169);
        $manager->persist($item169);
        $item170 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Conakry");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item170);

        $item170->setCountry($this->getReference('_reference_ProviderCountry83'));
        $this->addReference('_reference_ProviderTimezone170', $item170);
        $this->sanitizeEntityValues($item170);
        $manager->persist($item170);
        $item171 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Guadeloupe");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item171);

        $item171->setCountry($this->getReference('_reference_ProviderCountry78'));
        $this->addReference('_reference_ProviderTimezone171', $item171);
        $this->sanitizeEntityValues($item171);
        $manager->persist($item171);
        $item172 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Malabo");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item172);

        $item172->setCountry($this->getReference('_reference_ProviderCountry84'));
        $this->addReference('_reference_ProviderTimezone172', $item172);
        $this->sanitizeEntityValues($item172);
        $manager->persist($item172);
        $item173 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Athens");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item173);

        $item173->setCountry($this->getReference('_reference_ProviderCountry76'));
        $this->addReference('_reference_ProviderTimezone173', $item173);
        $this->sanitizeEntityValues($item173);
        $manager->persist($item173);
        $item174 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Atlantic/South_Georgia");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item174);

        $item174->setCountry($this->getReference('_reference_ProviderCountry106'));
        $this->addReference('_reference_ProviderTimezone174', $item174);
        $this->sanitizeEntityValues($item174);
        $manager->persist($item174);
        $item175 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Guatemala");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item175);

        $item175->setCountry($this->getReference('_reference_ProviderCountry80'));
        $this->addReference('_reference_ProviderTimezone175', $item175);
        $this->sanitizeEntityValues($item175);
        $manager->persist($item175);
        $item176 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Guam");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item176);

        $item176->setCountry($this->getReference('_reference_ProviderCountry79'));
        $this->addReference('_reference_ProviderTimezone176', $item176);
        $this->sanitizeEntityValues($item176);
        $manager->persist($item176);
        $item177 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Bissau");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item177);

        $item177->setCountry($this->getReference('_reference_ProviderCountry85'));
        $this->addReference('_reference_ProviderTimezone177', $item177);
        $this->sanitizeEntityValues($item177);
        $manager->persist($item177);
        $item178 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Guyana");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item178);

        $item178->setCountry($this->getReference('_reference_ProviderCountry86'));
        $this->addReference('_reference_ProviderTimezone178', $item178);
        $this->sanitizeEntityValues($item178);
        $manager->persist($item178);
        $item179 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Hong_Kong");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item179);

        $item179->setCountry($this->getReference('_reference_ProviderCountry180'));
        $this->addReference('_reference_ProviderTimezone179', $item179);
        $this->sanitizeEntityValues($item179);
        $manager->persist($item179);
        $item180 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Tegucigalpa");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item180);

        $item180->setCountry($this->getReference('_reference_ProviderCountry88'));
        $this->addReference('_reference_ProviderTimezone180', $item180);
        $this->sanitizeEntityValues($item180);
        $manager->persist($item180);
        $item181 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Zagreb");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item181);

        $item181->setCountry($this->getReference('_reference_ProviderCountry51'));
        $this->addReference('_reference_ProviderTimezone181', $item181);
        $this->sanitizeEntityValues($item181);
        $manager->persist($item181);
        $item182 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Port-au-Prince");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item182);

        $item182->setCountry($this->getReference('_reference_ProviderCountry87'));
        $this->addReference('_reference_ProviderTimezone182', $item182);
        $this->sanitizeEntityValues($item182);
        $manager->persist($item182);
        $item183 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Budapest");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item183);

        $item183->setCountry($this->getReference('_reference_ProviderCountry89'));
        $this->addReference('_reference_ProviderTimezone183', $item183);
        $this->sanitizeEntityValues($item183);
        $manager->persist($item183);
        $item184 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Jakarta");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item184);

        $item184->setCountry($this->getReference('_reference_ProviderCountry91'));
        $this->addReference('_reference_ProviderTimezone184', $item184);
        $this->sanitizeEntityValues($item184);
        $manager->persist($item184);
        $item185 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Pontianak");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item185);

        $item185->setCountry($this->getReference('_reference_ProviderCountry91'));
        $this->addReference('_reference_ProviderTimezone185', $item185);
        $this->sanitizeEntityValues($item185);
        $manager->persist($item185);
        $item186 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Makassar");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item186);

        $item186->setCountry($this->getReference('_reference_ProviderCountry91'));
        $this->addReference('_reference_ProviderTimezone186', $item186);
        $this->sanitizeEntityValues($item186);
        $manager->persist($item186);
        $item187 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Jayapura");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item187);

        $item187->setCountry($this->getReference('_reference_ProviderCountry91'));
        $this->addReference('_reference_ProviderTimezone187', $item187);
        $this->sanitizeEntityValues($item187);
        $manager->persist($item187);
        $item188 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Dublin");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item188);

        $item188->setCountry($this->getReference('_reference_ProviderCountry94'));
        $this->addReference('_reference_ProviderTimezone188', $item188);
        $this->sanitizeEntityValues($item188);
        $manager->persist($item188);
        $item189 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Jerusalem");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item189);

        $item189->setCountry($this->getReference('_reference_ProviderCountry117'));
        $this->addReference('_reference_ProviderTimezone189', $item189);
        $this->sanitizeEntityValues($item189);
        $manager->persist($item189);
        $item190 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Isle_of_Man");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item190);

        $item190->setCountry($this->getReference('_reference_ProviderCountry97'));
        $this->addReference('_reference_ProviderTimezone190', $item190);
        $this->sanitizeEntityValues($item190);
        $manager->persist($item190);
        $item191 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Kolkata");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item191);

        $item191->setCountry($this->getReference('_reference_ProviderCountry90'));
        $this->addReference('_reference_ProviderTimezone191', $item191);
        $this->sanitizeEntityValues($item191);
        $manager->persist($item191);
        $item192 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Indian/Chagos");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item192);

        $item192->setCountry($this->getReference('_reference_ProviderCountry222'));
        $this->addReference('_reference_ProviderTimezone192', $item192);
        $this->sanitizeEntityValues($item192);
        $manager->persist($item192);
        $item193 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Baghdad");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item193);

        $item193->setCountry($this->getReference('_reference_ProviderCountry93'));
        $this->addReference('_reference_ProviderTimezone193', $item193);
        $this->sanitizeEntityValues($item193);
        $manager->persist($item193);
        $item194 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Tehran");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item194);

        $item194->setCountry($this->getReference('_reference_ProviderCountry92'));
        $this->addReference('_reference_ProviderTimezone194', $item194);
        $this->sanitizeEntityValues($item194);
        $manager->persist($item194);
        $item195 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Atlantic/Reykjavik");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item195);

        $item195->setCountry($this->getReference('_reference_ProviderCountry100'));
        $this->addReference('_reference_ProviderTimezone195', $item195);
        $this->sanitizeEntityValues($item195);
        $manager->persist($item195);
        $item196 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Rome");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item196);

        $item196->setCountry($this->getReference('_reference_ProviderCountry118'));
        $this->addReference('_reference_ProviderTimezone196', $item196);
        $this->sanitizeEntityValues($item196);
        $manager->persist($item196);
        $item197 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Jersey");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item197);

        $item197->setCountry($this->getReference('_reference_ProviderCountry121'));
        $this->addReference('_reference_ProviderTimezone197', $item197);
        $this->sanitizeEntityValues($item197);
        $manager->persist($item197);
        $item198 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Jamaica");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item198);

        $item198->setCountry($this->getReference('_reference_ProviderCountry119'));
        $this->addReference('_reference_ProviderTimezone198', $item198);
        $this->sanitizeEntityValues($item198);
        $manager->persist($item198);
        $item199 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Amman");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item199);

        $item199->setCountry($this->getReference('_reference_ProviderCountry122'));
        $this->addReference('_reference_ProviderTimezone199', $item199);
        $this->sanitizeEntityValues($item199);
        $manager->persist($item199);
        $item200 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Tokyo");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item200);

        $item200->setCountry($this->getReference('_reference_ProviderCountry120'));
        $this->addReference('_reference_ProviderTimezone200', $item200);
        $this->sanitizeEntityValues($item200);
        $manager->persist($item200);
        $item201 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Nairobi");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item201);

        $item201->setCountry($this->getReference('_reference_ProviderCountry124'));
        $this->addReference('_reference_ProviderTimezone201', $item201);
        $this->sanitizeEntityValues($item201);
        $manager->persist($item201);
        $item202 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Bishkek");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item202);

        $item202->setCountry($this->getReference('_reference_ProviderCountry125'));
        $this->addReference('_reference_ProviderTimezone202', $item202);
        $this->sanitizeEntityValues($item202);
        $manager->persist($item202);
        $item203 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Phnom_Penh");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item203);

        $item203->setCountry($this->getReference('_reference_ProviderCountry36'));
        $this->addReference('_reference_ProviderTimezone203', $item203);
        $this->sanitizeEntityValues($item203);
        $manager->persist($item203);
        $item204 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Tarawa");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item204);

        $item204->setCountry($this->getReference('_reference_ProviderCountry126'));
        $this->addReference('_reference_ProviderTimezone204', $item204);
        $this->sanitizeEntityValues($item204);
        $manager->persist($item204);
        $item205 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Enderbury");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item205);

        $item205->setCountry($this->getReference('_reference_ProviderCountry126'));
        $this->addReference('_reference_ProviderTimezone205', $item205);
        $this->sanitizeEntityValues($item205);
        $manager->persist($item205);
        $item206 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Kiritimati");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item206);

        $item206->setCountry($this->getReference('_reference_ProviderCountry126'));
        $this->addReference('_reference_ProviderTimezone206', $item206);
        $this->sanitizeEntityValues($item206);
        $manager->persist($item206);
        $item207 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Indian/Comoro");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item207);

        $item207->setCountry($this->getReference('_reference_ProviderCountry45'));
        $this->addReference('_reference_ProviderTimezone207', $item207);
        $this->sanitizeEntityValues($item207);
        $manager->persist($item207);
        $item208 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/St_Kitts");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item208);

        $item208->setCountry($this->getReference('_reference_ProviderCountry195'));
        $this->addReference('_reference_ProviderTimezone208', $item208);
        $this->sanitizeEntityValues($item208);
        $manager->persist($item208);
        $item209 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Pyongyang");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item209);

        $item209->setCountry($this->getReference('_reference_ProviderCountry47'));
        $this->addReference('_reference_ProviderTimezone209', $item209);
        $this->sanitizeEntityValues($item209);
        $manager->persist($item209);
        $item210 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Seoul");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item210);

        $item210->setCountry($this->getReference('_reference_ProviderCountry48'));
        $this->addReference('_reference_ProviderTimezone210', $item210);
        $this->sanitizeEntityValues($item210);
        $manager->persist($item210);
        $item211 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Kuwait");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item211);

        $item211->setCountry($this->getReference('_reference_ProviderCountry127'));
        $this->addReference('_reference_ProviderTimezone211', $item211);
        $this->sanitizeEntityValues($item211);
        $manager->persist($item211);
        $item212 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Cayman");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item212);

        $item212->setCountry($this->getReference('_reference_ProviderCountry102'));
        $this->addReference('_reference_ProviderTimezone212', $item212);
        $this->sanitizeEntityValues($item212);
        $manager->persist($item212);
        $item213 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Almaty");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item213);

        $item213->setCountry($this->getReference('_reference_ProviderCountry123'));
        $this->addReference('_reference_ProviderTimezone213', $item213);
        $this->sanitizeEntityValues($item213);
        $manager->persist($item213);
        $item214 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Qyzylorda");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item214);

        $item214->setCountry($this->getReference('_reference_ProviderCountry123'));
        $this->addReference('_reference_ProviderTimezone214', $item214);
        $this->sanitizeEntityValues($item214);
        $manager->persist($item214);
        $item215 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Aqtobe");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item215);

        $item215->setCountry($this->getReference('_reference_ProviderCountry123'));
        $this->addReference('_reference_ProviderTimezone215', $item215);
        $this->sanitizeEntityValues($item215);
        $manager->persist($item215);
        $item216 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Aqtau");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item216);

        $item216->setCountry($this->getReference('_reference_ProviderCountry123'));
        $this->addReference('_reference_ProviderTimezone216', $item216);
        $this->sanitizeEntityValues($item216);
        $manager->persist($item216);
        $item217 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Oral");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item217);

        $item217->setCountry($this->getReference('_reference_ProviderCountry123'));
        $this->addReference('_reference_ProviderTimezone217', $item217);
        $this->sanitizeEntityValues($item217);
        $manager->persist($item217);
        $item218 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Vientiane");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item218);

        $item218->setCountry($this->getReference('_reference_ProviderCountry128'));
        $this->addReference('_reference_ProviderTimezone218', $item218);
        $this->sanitizeEntityValues($item218);
        $manager->persist($item218);
        $item219 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Beirut");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item219);

        $item219->setCountry($this->getReference('_reference_ProviderCountry131'));
        $this->addReference('_reference_ProviderTimezone219', $item219);
        $this->sanitizeEntityValues($item219);
        $manager->persist($item219);
        $item220 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/St_Lucia");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item220);

        $item220->setCountry($this->getReference('_reference_ProviderCountry201'));
        $this->addReference('_reference_ProviderTimezone220', $item220);
        $this->sanitizeEntityValues($item220);
        $manager->persist($item220);
        $item221 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Vaduz");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item221);

        $item221->setCountry($this->getReference('_reference_ProviderCountry134'));
        $this->addReference('_reference_ProviderTimezone221', $item221);
        $this->sanitizeEntityValues($item221);
        $manager->persist($item221);
        $item222 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Colombo");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item222);

        $item222->setCountry($this->getReference('_reference_ProviderCountry210'));
        $this->addReference('_reference_ProviderTimezone222', $item222);
        $this->sanitizeEntityValues($item222);
        $manager->persist($item222);
        $item223 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Monrovia");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item223);

        $item223->setCountry($this->getReference('_reference_ProviderCountry132'));
        $this->addReference('_reference_ProviderTimezone223', $item223);
        $this->sanitizeEntityValues($item223);
        $manager->persist($item223);
        $item224 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Maseru");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item224);

        $item224->setCountry($this->getReference('_reference_ProviderCountry129'));
        $this->addReference('_reference_ProviderTimezone224', $item224);
        $this->sanitizeEntityValues($item224);
        $manager->persist($item224);
        $item225 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Vilnius");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item225);

        $item225->setCountry($this->getReference('_reference_ProviderCountry135'));
        $this->addReference('_reference_ProviderTimezone225', $item225);
        $this->sanitizeEntityValues($item225);
        $manager->persist($item225);
        $item226 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Luxembourg");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item226);

        $item226->setCountry($this->getReference('_reference_ProviderCountry136'));
        $this->addReference('_reference_ProviderTimezone226', $item226);
        $this->sanitizeEntityValues($item226);
        $manager->persist($item226);
        $item227 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Riga");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item227);

        $item227->setCountry($this->getReference('_reference_ProviderCountry130'));
        $this->addReference('_reference_ProviderTimezone227', $item227);
        $this->sanitizeEntityValues($item227);
        $manager->persist($item227);
        $item228 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Tripoli");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item228);

        $item228->setCountry($this->getReference('_reference_ProviderCountry133'));
        $this->addReference('_reference_ProviderTimezone228', $item228);
        $this->sanitizeEntityValues($item228);
        $manager->persist($item228);
        $item229 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Casablanca");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item229);

        $item229->setCountry($this->getReference('_reference_ProviderCountry144'));
        $this->addReference('_reference_ProviderTimezone229', $item229);
        $this->sanitizeEntityValues($item229);
        $manager->persist($item229);
        $item230 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Monaco");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item230);

        $item230->setCountry($this->getReference('_reference_ProviderCountry152'));
        $this->addReference('_reference_ProviderTimezone230', $item230);
        $this->sanitizeEntityValues($item230);
        $manager->persist($item230);
        $item231 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Chisinau");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item231);

        $item231->setCountry($this->getReference('_reference_ProviderCountry151'));
        $this->addReference('_reference_ProviderTimezone231', $item231);
        $this->sanitizeEntityValues($item231);
        $manager->persist($item231);
        $item232 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Podgorica");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item232);

        $item232->setCountry($this->getReference('_reference_ProviderCountry154'));
        $this->addReference('_reference_ProviderTimezone232', $item232);
        $this->sanitizeEntityValues($item232);
        $manager->persist($item232);
        $item233 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Marigot");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item233);

        $item233->setCountry($this->getReference('_reference_ProviderCountry197'));
        $this->addReference('_reference_ProviderTimezone233', $item233);
        $this->sanitizeEntityValues($item233);
        $manager->persist($item233);
        $item234 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Indian/Antananarivo");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item234);

        $item234->setCountry($this->getReference('_reference_ProviderCountry138'));
        $this->addReference('_reference_ProviderTimezone234', $item234);
        $this->sanitizeEntityValues($item234);
        $manager->persist($item234);
        $item235 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Majuro");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item235);

        $item235->setCountry($this->getReference('_reference_ProviderCountry110'));
        $this->addReference('_reference_ProviderTimezone235', $item235);
        $this->sanitizeEntityValues($item235);
        $manager->persist($item235);
        $item236 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Kwajalein");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item236);

        $item236->setCountry($this->getReference('_reference_ProviderCountry110'));
        $this->addReference('_reference_ProviderTimezone236', $item236);
        $this->sanitizeEntityValues($item236);
        $manager->persist($item236);
        $item237 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Skopje");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item237);

        $item237->setCountry($this->getReference('_reference_ProviderCountry137'));
        $this->addReference('_reference_ProviderTimezone237', $item237);
        $this->sanitizeEntityValues($item237);
        $manager->persist($item237);
        $item238 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Bamako");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item238);

        $item238->setCountry($this->getReference('_reference_ProviderCountry142'));
        $this->addReference('_reference_ProviderTimezone238', $item238);
        $this->sanitizeEntityValues($item238);
        $manager->persist($item238);
        $item239 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Rangoon");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item239);

        $item239->setCountry($this->getReference('_reference_ProviderCountry157'));
        $this->addReference('_reference_ProviderTimezone239', $item239);
        $this->sanitizeEntityValues($item239);
        $manager->persist($item239);
        $item240 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Ulaanbaatar");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item240);

        $item240->setCountry($this->getReference('_reference_ProviderCountry153'));
        $this->addReference('_reference_ProviderTimezone240', $item240);
        $this->sanitizeEntityValues($item240);
        $manager->persist($item240);
        $item241 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Hovd");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item241);

        $item241->setCountry($this->getReference('_reference_ProviderCountry153'));
        $this->addReference('_reference_ProviderTimezone241', $item241);
        $this->sanitizeEntityValues($item241);
        $manager->persist($item241);
        $item242 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Choibalsan");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item242);

        $item242->setCountry($this->getReference('_reference_ProviderCountry153'));
        $this->addReference('_reference_ProviderTimezone242', $item242);
        $this->sanitizeEntityValues($item242);
        $manager->persist($item242);
        $item243 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Macau");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item243);

        $item243->setCountry($this->getReference('_reference_ProviderCountry181'));
        $this->addReference('_reference_ProviderTimezone243', $item243);
        $this->sanitizeEntityValues($item243);
        $manager->persist($item243);
        $item244 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Saipan");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item244);

        $item244->setCountry($this->getReference('_reference_ProviderCountry109'));
        $this->addReference('_reference_ProviderTimezone244', $item244);
        $this->sanitizeEntityValues($item244);
        $manager->persist($item244);
        $item245 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Martinique");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item245);

        $item245->setCountry($this->getReference('_reference_ProviderCountry145'));
        $this->addReference('_reference_ProviderTimezone245', $item245);
        $this->sanitizeEntityValues($item245);
        $manager->persist($item245);
        $item246 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Nouakchott");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item246);

        $item246->setCountry($this->getReference('_reference_ProviderCountry147'));
        $this->addReference('_reference_ProviderTimezone246', $item246);
        $this->sanitizeEntityValues($item246);
        $manager->persist($item246);
        $item247 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Montserrat");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item247);

        $item247->setCountry($this->getReference('_reference_ProviderCountry155'));
        $this->addReference('_reference_ProviderTimezone247', $item247);
        $this->sanitizeEntityValues($item247);
        $manager->persist($item247);
        $item248 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Malta");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item248);

        $item248->setCountry($this->getReference('_reference_ProviderCountry143'));
        $this->addReference('_reference_ProviderTimezone248', $item248);
        $this->sanitizeEntityValues($item248);
        $manager->persist($item248);
        $item249 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Indian/Mauritius");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item249);

        $item249->setCountry($this->getReference('_reference_ProviderCountry146'));
        $this->addReference('_reference_ProviderTimezone249', $item249);
        $this->sanitizeEntityValues($item249);
        $manager->persist($item249);
        $item250 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Indian/Maldives");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item250);

        $item250->setCountry($this->getReference('_reference_ProviderCountry141'));
        $this->addReference('_reference_ProviderTimezone250', $item250);
        $this->sanitizeEntityValues($item250);
        $manager->persist($item250);
        $item251 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Blantyre");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item251);

        $item251->setCountry($this->getReference('_reference_ProviderCountry140'));
        $this->addReference('_reference_ProviderTimezone251', $item251);
        $this->sanitizeEntityValues($item251);
        $manager->persist($item251);
        $item252 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Mexico_City");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item252);

        $item252->setCountry($this->getReference('_reference_ProviderCountry149'));
        $this->addReference('_reference_ProviderTimezone252', $item252);
        $this->sanitizeEntityValues($item252);
        $manager->persist($item252);
        $item253 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Cancun");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item253);

        $item253->setCountry($this->getReference('_reference_ProviderCountry149'));
        $this->addReference('_reference_ProviderTimezone253', $item253);
        $this->sanitizeEntityValues($item253);
        $manager->persist($item253);
        $item254 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Merida");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item254);

        $item254->setCountry($this->getReference('_reference_ProviderCountry149'));
        $this->addReference('_reference_ProviderTimezone254', $item254);
        $this->sanitizeEntityValues($item254);
        $manager->persist($item254);
        $item255 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Monterrey");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item255);

        $item255->setCountry($this->getReference('_reference_ProviderCountry149'));
        $this->addReference('_reference_ProviderTimezone255', $item255);
        $this->sanitizeEntityValues($item255);
        $manager->persist($item255);
        $item256 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Matamoros");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item256);

        $item256->setCountry($this->getReference('_reference_ProviderCountry149'));
        $this->addReference('_reference_ProviderTimezone256', $item256);
        $this->sanitizeEntityValues($item256);
        $manager->persist($item256);
        $item257 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Mazatlan");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item257);

        $item257->setCountry($this->getReference('_reference_ProviderCountry149'));
        $this->addReference('_reference_ProviderTimezone257', $item257);
        $this->sanitizeEntityValues($item257);
        $manager->persist($item257);
        $item258 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Chihuahua");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item258);

        $item258->setCountry($this->getReference('_reference_ProviderCountry149'));
        $this->addReference('_reference_ProviderTimezone258', $item258);
        $this->sanitizeEntityValues($item258);
        $manager->persist($item258);
        $item259 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Ojinaga");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item259);

        $item259->setCountry($this->getReference('_reference_ProviderCountry149'));
        $this->addReference('_reference_ProviderTimezone259', $item259);
        $this->sanitizeEntityValues($item259);
        $manager->persist($item259);
        $item260 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Hermosillo");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item260);

        $item260->setCountry($this->getReference('_reference_ProviderCountry149'));
        $this->addReference('_reference_ProviderTimezone260', $item260);
        $this->sanitizeEntityValues($item260);
        $manager->persist($item260);
        $item261 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Tijuana");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item261);

        $item261->setCountry($this->getReference('_reference_ProviderCountry149'));
        $this->addReference('_reference_ProviderTimezone261', $item261);
        $this->sanitizeEntityValues($item261);
        $manager->persist($item261);
        $item262 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Santa_Isabel");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item262);

        $item262->setCountry($this->getReference('_reference_ProviderCountry149'));
        $this->addReference('_reference_ProviderTimezone262', $item262);
        $this->sanitizeEntityValues($item262);
        $manager->persist($item262);
        $item263 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Bahia_Banderas");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item263);

        $item263->setCountry($this->getReference('_reference_ProviderCountry149'));
        $this->addReference('_reference_ProviderTimezone263', $item263);
        $this->sanitizeEntityValues($item263);
        $manager->persist($item263);
        $item264 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Kuala_Lumpur");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item264);

        $item264->setCountry($this->getReference('_reference_ProviderCountry139'));
        $this->addReference('_reference_ProviderTimezone264', $item264);
        $this->sanitizeEntityValues($item264);
        $manager->persist($item264);
        $item265 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Kuching");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item265);

        $item265->setCountry($this->getReference('_reference_ProviderCountry139'));
        $this->addReference('_reference_ProviderTimezone265', $item265);
        $this->sanitizeEntityValues($item265);
        $manager->persist($item265);
        $item266 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Maputo");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item266);

        $item266->setCountry($this->getReference('_reference_ProviderCountry156'));
        $this->addReference('_reference_ProviderTimezone266', $item266);
        $this->sanitizeEntityValues($item266);
        $manager->persist($item266);
        $item267 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Windhoek");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item267);

        $item267->setCountry($this->getReference('_reference_ProviderCountry158'));
        $this->addReference('_reference_ProviderTimezone267', $item267);
        $this->sanitizeEntityValues($item267);
        $manager->persist($item267);
        $item268 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Noumea");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item268);

        $item268->setCountry($this->getReference('_reference_ProviderCountry165'));
        $this->addReference('_reference_ProviderTimezone268', $item268);
        $this->sanitizeEntityValues($item268);
        $manager->persist($item268);
        $item269 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Niamey");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item269);

        $item269->setCountry($this->getReference('_reference_ProviderCountry162'));
        $this->addReference('_reference_ProviderTimezone269', $item269);
        $this->sanitizeEntityValues($item269);
        $manager->persist($item269);
        $item270 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Norfolk");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item270);

        $item270->setCountry($this->getReference('_reference_ProviderCountry99'));
        $this->addReference('_reference_ProviderTimezone270', $item270);
        $this->sanitizeEntityValues($item270);
        $manager->persist($item270);
        $item271 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Lagos");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item271);

        $item271->setCountry($this->getReference('_reference_ProviderCountry163'));
        $this->addReference('_reference_ProviderTimezone271', $item271);
        $this->sanitizeEntityValues($item271);
        $manager->persist($item271);
        $item272 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Managua");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item272);

        $item272->setCountry($this->getReference('_reference_ProviderCountry161'));
        $this->addReference('_reference_ProviderTimezone272', $item272);
        $this->sanitizeEntityValues($item272);
        $manager->persist($item272);
        $item273 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Amsterdam");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item273);

        $item273->setCountry($this->getReference('_reference_ProviderCountry168'));
        $this->addReference('_reference_ProviderTimezone273', $item273);
        $this->sanitizeEntityValues($item273);
        $manager->persist($item273);
        $item274 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Oslo");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item274);

        $item274->setCountry($this->getReference('_reference_ProviderCountry164'));
        $this->addReference('_reference_ProviderTimezone274', $item274);
        $this->sanitizeEntityValues($item274);
        $manager->persist($item274);
        $item275 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Kathmandu");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item275);

        $item275->setCountry($this->getReference('_reference_ProviderCountry160'));
        $this->addReference('_reference_ProviderTimezone275', $item275);
        $this->sanitizeEntityValues($item275);
        $manager->persist($item275);
        $item276 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Nauru");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item276);

        $item276->setCountry($this->getReference('_reference_ProviderCountry159'));
        $this->addReference('_reference_ProviderTimezone276', $item276);
        $this->sanitizeEntityValues($item276);
        $manager->persist($item276);
        $item277 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Niue");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item277);

        $item277->setCountry($this->getReference('_reference_ProviderCountry98'));
        $this->addReference('_reference_ProviderTimezone277', $item277);
        $this->sanitizeEntityValues($item277);
        $manager->persist($item277);
        $item278 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Auckland");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item278);

        $item278->setCountry($this->getReference('_reference_ProviderCountry166'));
        $this->addReference('_reference_ProviderTimezone278', $item278);
        $this->sanitizeEntityValues($item278);
        $manager->persist($item278);
        $item279 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Chatham");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item279);

        $item279->setCountry($this->getReference('_reference_ProviderCountry166'));
        $this->addReference('_reference_ProviderTimezone279', $item279);
        $this->sanitizeEntityValues($item279);
        $manager->persist($item279);
        $item280 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Muscat");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item280);

        $item280->setCountry($this->getReference('_reference_ProviderCountry167'));
        $this->addReference('_reference_ProviderTimezone280', $item280);
        $this->sanitizeEntityValues($item280);
        $manager->persist($item280);
        $item281 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Panama");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item281);

        $item281->setCountry($this->getReference('_reference_ProviderCountry171'));
        $this->addReference('_reference_ProviderTimezone281', $item281);
        $this->sanitizeEntityValues($item281);
        $manager->persist($item281);
        $item282 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Lima");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item282);

        $item282->setCountry($this->getReference('_reference_ProviderCountry174'));
        $this->addReference('_reference_ProviderTimezone282', $item282);
        $this->sanitizeEntityValues($item282);
        $manager->persist($item282);
        $item283 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Tahiti");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item283);

        $item283->setCountry($this->getReference('_reference_ProviderCountry175'));
        $this->addReference('_reference_ProviderTimezone283', $item283);
        $this->sanitizeEntityValues($item283);
        $manager->persist($item283);
        $item284 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Marquesas");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item284);

        $item284->setCountry($this->getReference('_reference_ProviderCountry175'));
        $this->addReference('_reference_ProviderTimezone284', $item284);
        $this->sanitizeEntityValues($item284);
        $manager->persist($item284);
        $item285 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Gambier");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item285);

        $item285->setCountry($this->getReference('_reference_ProviderCountry175'));
        $this->addReference('_reference_ProviderTimezone285', $item285);
        $this->sanitizeEntityValues($item285);
        $manager->persist($item285);
        $item286 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Port_Moresby");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item286);

        $item286->setCountry($this->getReference('_reference_ProviderCountry172'));
        $this->addReference('_reference_ProviderTimezone286', $item286);
        $this->sanitizeEntityValues($item286);
        $manager->persist($item286);
        $item287 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Bougainville");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item287);

        $item287->setCountry($this->getReference('_reference_ProviderCountry172'));
        $this->addReference('_reference_ProviderTimezone287', $item287);
        $this->sanitizeEntityValues($item287);
        $manager->persist($item287);
        $item288 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Manila");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item288);

        $item288->setCountry($this->getReference('_reference_ProviderCountry66'));
        $this->addReference('_reference_ProviderTimezone288', $item288);
        $this->sanitizeEntityValues($item288);
        $manager->persist($item288);
        $item289 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Karachi");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item289);

        $item289->setCountry($this->getReference('_reference_ProviderCountry169'));
        $this->addReference('_reference_ProviderTimezone289', $item289);
        $this->sanitizeEntityValues($item289);
        $manager->persist($item289);
        $item290 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Warsaw");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item290);

        $item290->setCountry($this->getReference('_reference_ProviderCountry176'));
        $this->addReference('_reference_ProviderTimezone290', $item290);
        $this->sanitizeEntityValues($item290);
        $manager->persist($item290);
        $item291 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Miquelon");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item291);

        $item291->setCountry($this->getReference('_reference_ProviderCountry198'));
        $this->addReference('_reference_ProviderTimezone291', $item291);
        $this->sanitizeEntityValues($item291);
        $manager->persist($item291);
        $item292 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Pitcairn");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item292);

        $item292->setCountry($this->getReference('_reference_ProviderCountry112'));
        $this->addReference('_reference_ProviderTimezone292', $item292);
        $this->sanitizeEntityValues($item292);
        $manager->persist($item292);
        $item293 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Puerto_Rico");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item293);

        $item293->setCountry($this->getReference('_reference_ProviderCountry178'));
        $this->addReference('_reference_ProviderTimezone293', $item293);
        $this->sanitizeEntityValues($item293);
        $manager->persist($item293);
        $item294 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Gaza");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item294);

        $item294->setCountry($this->getReference('_reference_ProviderCountry224'));
        $this->addReference('_reference_ProviderTimezone294', $item294);
        $this->sanitizeEntityValues($item294);
        $manager->persist($item294);
        $item295 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Hebron");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item295);

        $item295->setCountry($this->getReference('_reference_ProviderCountry224'));
        $this->addReference('_reference_ProviderTimezone295', $item295);
        $this->sanitizeEntityValues($item295);
        $manager->persist($item295);
        $item296 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Lisbon");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item296);

        $item296->setCountry($this->getReference('_reference_ProviderCountry177'));
        $this->addReference('_reference_ProviderTimezone296', $item296);
        $this->sanitizeEntityValues($item296);
        $manager->persist($item296);
        $item297 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Atlantic/Madeira");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item297);

        $item297->setCountry($this->getReference('_reference_ProviderCountry177'));
        $this->addReference('_reference_ProviderTimezone297', $item297);
        $this->sanitizeEntityValues($item297);
        $manager->persist($item297);
        $item298 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Atlantic/Azores");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item298);

        $item298->setCountry($this->getReference('_reference_ProviderCountry177'));
        $this->addReference('_reference_ProviderTimezone298', $item298);
        $this->sanitizeEntityValues($item298);
        $manager->persist($item298);
        $item299 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Palau");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item299);

        $item299->setCountry($this->getReference('_reference_ProviderCountry170'));
        $this->addReference('_reference_ProviderTimezone299', $item299);
        $this->sanitizeEntityValues($item299);
        $manager->persist($item299);
        $item300 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Asuncion");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item300);

        $item300->setCountry($this->getReference('_reference_ProviderCountry173'));
        $this->addReference('_reference_ProviderTimezone300', $item300);
        $this->sanitizeEntityValues($item300);
        $manager->persist($item300);
        $item301 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Qatar");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item301);

        $item301->setCountry($this->getReference('_reference_ProviderCountry179'));
        $this->addReference('_reference_ProviderTimezone301', $item301);
        $this->sanitizeEntityValues($item301);
        $manager->persist($item301);
        $item302 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Indian/Reunion");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item302);

        $item302->setCountry($this->getReference('_reference_ProviderCountry187'));
        $this->addReference('_reference_ProviderTimezone302', $item302);
        $this->sanitizeEntityValues($item302);
        $manager->persist($item302);
        $item303 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Bucharest");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item303);

        $item303->setCountry($this->getReference('_reference_ProviderCountry189'));
        $this->addReference('_reference_ProviderTimezone303', $item303);
        $this->sanitizeEntityValues($item303);
        $manager->persist($item303);
        $item304 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Belgrade");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item304);

        $item304->setCountry($this->getReference('_reference_ProviderCountry204'));
        $this->addReference('_reference_ProviderTimezone304', $item304);
        $this->sanitizeEntityValues($item304);
        $manager->persist($item304);
        $item305 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Kaliningrad");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item305);

        $item305->setCountry($this->getReference('_reference_ProviderCountry190'));
        $this->addReference('_reference_ProviderTimezone305', $item305);
        $this->sanitizeEntityValues($item305);
        $manager->persist($item305);
        $item306 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Moscow");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item306);

        $item306->setCountry($this->getReference('_reference_ProviderCountry190'));
        $this->addReference('_reference_ProviderTimezone306', $item306);
        $this->sanitizeEntityValues($item306);
        $manager->persist($item306);
        $item307 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Simferopol");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item307);

        $item307->setCountry($this->getReference('_reference_ProviderCountry190'));
        $this->addReference('_reference_ProviderTimezone307', $item307);
        $this->sanitizeEntityValues($item307);
        $manager->persist($item307);
        $item308 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Volgograd");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item308);

        $item308->setCountry($this->getReference('_reference_ProviderCountry190'));
        $this->addReference('_reference_ProviderTimezone308', $item308);
        $this->sanitizeEntityValues($item308);
        $manager->persist($item308);
        $item309 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Samara");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item309);

        $item309->setCountry($this->getReference('_reference_ProviderCountry190'));
        $this->addReference('_reference_ProviderTimezone309', $item309);
        $this->sanitizeEntityValues($item309);
        $manager->persist($item309);
        $item310 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Yekaterinburg");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item310);

        $item310->setCountry($this->getReference('_reference_ProviderCountry190'));
        $this->addReference('_reference_ProviderTimezone310', $item310);
        $this->sanitizeEntityValues($item310);
        $manager->persist($item310);
        $item311 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Omsk");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item311);

        $item311->setCountry($this->getReference('_reference_ProviderCountry190'));
        $this->addReference('_reference_ProviderTimezone311', $item311);
        $this->sanitizeEntityValues($item311);
        $manager->persist($item311);
        $item312 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Novosibirsk");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item312);

        $item312->setCountry($this->getReference('_reference_ProviderCountry190'));
        $this->addReference('_reference_ProviderTimezone312', $item312);
        $this->sanitizeEntityValues($item312);
        $manager->persist($item312);
        $item313 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Novokuznetsk");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item313);

        $item313->setCountry($this->getReference('_reference_ProviderCountry190'));
        $this->addReference('_reference_ProviderTimezone313', $item313);
        $this->sanitizeEntityValues($item313);
        $manager->persist($item313);
        $item314 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Krasnoyarsk");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item314);

        $item314->setCountry($this->getReference('_reference_ProviderCountry190'));
        $this->addReference('_reference_ProviderTimezone314', $item314);
        $this->sanitizeEntityValues($item314);
        $manager->persist($item314);
        $item315 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Irkutsk");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item315);

        $item315->setCountry($this->getReference('_reference_ProviderCountry190'));
        $this->addReference('_reference_ProviderTimezone315', $item315);
        $this->sanitizeEntityValues($item315);
        $manager->persist($item315);
        $item316 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Chita");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item316);

        $item316->setCountry($this->getReference('_reference_ProviderCountry190'));
        $this->addReference('_reference_ProviderTimezone316', $item316);
        $this->sanitizeEntityValues($item316);
        $manager->persist($item316);
        $item317 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Yakutsk");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item317);

        $item317->setCountry($this->getReference('_reference_ProviderCountry190'));
        $this->addReference('_reference_ProviderTimezone317', $item317);
        $this->sanitizeEntityValues($item317);
        $manager->persist($item317);
        $item318 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Khandyga");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item318);

        $item318->setCountry($this->getReference('_reference_ProviderCountry190'));
        $this->addReference('_reference_ProviderTimezone318', $item318);
        $this->sanitizeEntityValues($item318);
        $manager->persist($item318);
        $item319 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Vladivostok");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item319);

        $item319->setCountry($this->getReference('_reference_ProviderCountry190'));
        $this->addReference('_reference_ProviderTimezone319', $item319);
        $this->sanitizeEntityValues($item319);
        $manager->persist($item319);
        $item320 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Sakhalin");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item320);

        $item320->setCountry($this->getReference('_reference_ProviderCountry190'));
        $this->addReference('_reference_ProviderTimezone320', $item320);
        $this->sanitizeEntityValues($item320);
        $manager->persist($item320);
        $item321 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Ust-Nera");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item321);

        $item321->setCountry($this->getReference('_reference_ProviderCountry190'));
        $this->addReference('_reference_ProviderTimezone321', $item321);
        $this->sanitizeEntityValues($item321);
        $manager->persist($item321);
        $item322 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Magadan");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item322);

        $item322->setCountry($this->getReference('_reference_ProviderCountry190'));
        $this->addReference('_reference_ProviderTimezone322', $item322);
        $this->sanitizeEntityValues($item322);
        $manager->persist($item322);
        $item323 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Srednekolymsk");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item323);

        $item323->setCountry($this->getReference('_reference_ProviderCountry190'));
        $this->addReference('_reference_ProviderTimezone323', $item323);
        $this->sanitizeEntityValues($item323);
        $manager->persist($item323);
        $item324 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Kamchatka");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item324);

        $item324->setCountry($this->getReference('_reference_ProviderCountry190'));
        $this->addReference('_reference_ProviderTimezone324', $item324);
        $this->sanitizeEntityValues($item324);
        $manager->persist($item324);
        $item325 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Anadyr");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item325);

        $item325->setCountry($this->getReference('_reference_ProviderCountry190'));
        $this->addReference('_reference_ProviderTimezone325', $item325);
        $this->sanitizeEntityValues($item325);
        $manager->persist($item325);
        $item326 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Kigali");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item326);

        $item326->setCountry($this->getReference('_reference_ProviderCountry188'));
        $this->addReference('_reference_ProviderTimezone326', $item326);
        $this->sanitizeEntityValues($item326);
        $manager->persist($item326);
        $item327 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Riyadh");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item327);

        $item327->setCountry($this->getReference('_reference_ProviderCountry9'));
        $this->addReference('_reference_ProviderTimezone327', $item327);
        $this->sanitizeEntityValues($item327);
        $manager->persist($item327);
        $item328 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Guadalcanal");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item328);

        $item328->setCountry($this->getReference('_reference_ProviderCountry113'));
        $this->addReference('_reference_ProviderTimezone328', $item328);
        $this->sanitizeEntityValues($item328);
        $manager->persist($item328);
        $item329 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Indian/Mahe");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item329);

        $item329->setCountry($this->getReference('_reference_ProviderCountry205'));
        $this->addReference('_reference_ProviderTimezone329', $item329);
        $this->sanitizeEntityValues($item329);
        $manager->persist($item329);
        $item330 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Khartoum");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item330);

        $item330->setCountry($this->getReference('_reference_ProviderCountry213'));
        $this->addReference('_reference_ProviderTimezone330', $item330);
        $this->sanitizeEntityValues($item330);
        $manager->persist($item330);
        $item331 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Stockholm");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item331);

        $item331->setCountry($this->getReference('_reference_ProviderCountry214'));
        $this->addReference('_reference_ProviderTimezone331', $item331);
        $this->sanitizeEntityValues($item331);
        $manager->persist($item331);
        $item332 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Singapore");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item332);

        $item332->setCountry($this->getReference('_reference_ProviderCountry207'));
        $this->addReference('_reference_ProviderTimezone332', $item332);
        $this->sanitizeEntityValues($item332);
        $manager->persist($item332);
        $item333 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Atlantic/St_Helena");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item333);

        $item333->setCountry($this->getReference('_reference_ProviderCountry200'));
        $this->addReference('_reference_ProviderTimezone333', $item333);
        $this->sanitizeEntityValues($item333);
        $manager->persist($item333);
        $item334 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Ljubljana");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item334);

        $item334->setCountry($this->getReference('_reference_ProviderCountry61'));
        $this->addReference('_reference_ProviderTimezone334', $item334);
        $this->sanitizeEntityValues($item334);
        $manager->persist($item334);
        $item335 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Arctic/Longyearbyen");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item335);

        $item335->setCountry($this->getReference('_reference_ProviderCountry217'));
        $this->addReference('_reference_ProviderTimezone335', $item335);
        $this->sanitizeEntityValues($item335);
        $manager->persist($item335);
        $item336 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Bratislava");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item336);

        $item336->setCountry($this->getReference('_reference_ProviderCountry60'));
        $this->addReference('_reference_ProviderTimezone336', $item336);
        $this->sanitizeEntityValues($item336);
        $manager->persist($item336);
        $item337 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Freetown");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item337);

        $item337->setCountry($this->getReference('_reference_ProviderCountry206'));
        $this->addReference('_reference_ProviderTimezone337', $item337);
        $this->sanitizeEntityValues($item337);
        $manager->persist($item337);
        $item338 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/San_Marino");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item338);

        $item338->setCountry($this->getReference('_reference_ProviderCountry196'));
        $this->addReference('_reference_ProviderTimezone338', $item338);
        $this->sanitizeEntityValues($item338);
        $manager->persist($item338);
        $item339 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Dakar");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item339);

        $item339->setCountry($this->getReference('_reference_ProviderCountry203'));
        $this->addReference('_reference_ProviderTimezone339', $item339);
        $this->sanitizeEntityValues($item339);
        $manager->persist($item339);
        $item340 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Mogadishu");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item340);

        $item340->setCountry($this->getReference('_reference_ProviderCountry209'));
        $this->addReference('_reference_ProviderTimezone340', $item340);
        $this->sanitizeEntityValues($item340);
        $manager->persist($item340);
        $item341 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Paramaribo");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item341);

        $item341->setCountry($this->getReference('_reference_ProviderCountry216'));
        $this->addReference('_reference_ProviderTimezone341', $item341);
        $this->sanitizeEntityValues($item341);
        $manager->persist($item341);
        $item342 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Juba");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item342);

        $item342->setCountry($this->getReference('_reference_ProviderCountry249'));
        $this->addReference('_reference_ProviderTimezone342', $item342);
        $this->sanitizeEntityValues($item342);
        $manager->persist($item342);
        $item343 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Sao_Tome");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item343);

        $item343->setCountry($this->getReference('_reference_ProviderCountry202'));
        $this->addReference('_reference_ProviderTimezone343', $item343);
        $this->sanitizeEntityValues($item343);
        $manager->persist($item343);
        $item344 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/El_Salvador");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item344);

        $item344->setCountry($this->getReference('_reference_ProviderCountry57'));
        $this->addReference('_reference_ProviderTimezone344', $item344);
        $this->sanitizeEntityValues($item344);
        $manager->persist($item344);
        $item345 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Lower_Princes");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item345);

        $item345->setCountry($this->getReference('_reference_ProviderCountry248'));
        $this->addReference('_reference_ProviderTimezone345', $item345);
        $this->sanitizeEntityValues($item345);
        $manager->persist($item345);
        $item346 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Damascus");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item346);

        $item346->setCountry($this->getReference('_reference_ProviderCountry208'));
        $this->addReference('_reference_ProviderTimezone346', $item346);
        $this->sanitizeEntityValues($item346);
        $manager->persist($item346);
        $item347 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Mbabane");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item347);

        $item347->setCountry($this->getReference('_reference_ProviderCountry211'));
        $this->addReference('_reference_ProviderTimezone347', $item347);
        $this->sanitizeEntityValues($item347);
        $manager->persist($item347);
        $item348 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Grand_Turk");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item348);

        $item348->setCountry($this->getReference('_reference_ProviderCountry114'));
        $this->addReference('_reference_ProviderTimezone348', $item348);
        $this->sanitizeEntityValues($item348);
        $manager->persist($item348);
        $item349 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Ndjamena");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item349);

        $item349->setCountry($this->getReference('_reference_ProviderCountry39'));
        $this->addReference('_reference_ProviderTimezone349', $item349);
        $this->sanitizeEntityValues($item349);
        $manager->persist($item349);
        $item350 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Indian/Kerguelen");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item350);

        $item350->setCountry($this->getReference('_reference_ProviderCountry223'));
        $this->addReference('_reference_ProviderTimezone350', $item350);
        $this->sanitizeEntityValues($item350);
        $manager->persist($item350);
        $item351 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Lome");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item351);

        $item351->setCountry($this->getReference('_reference_ProviderCountry226'));
        $this->addReference('_reference_ProviderTimezone351', $item351);
        $this->sanitizeEntityValues($item351);
        $manager->persist($item351);
        $item352 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Bangkok");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item352);

        $item352->setCountry($this->getReference('_reference_ProviderCountry218'));
        $this->addReference('_reference_ProviderTimezone352', $item352);
        $this->sanitizeEntityValues($item352);
        $manager->persist($item352);
        $item353 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Dushanbe");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item353);

        $item353->setCountry($this->getReference('_reference_ProviderCountry221'));
        $this->addReference('_reference_ProviderTimezone353', $item353);
        $this->sanitizeEntityValues($item353);
        $manager->persist($item353);
        $item354 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Fakaofo");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item354);

        $item354->setCountry($this->getReference('_reference_ProviderCountry227'));
        $this->addReference('_reference_ProviderTimezone354', $item354);
        $this->sanitizeEntityValues($item354);
        $manager->persist($item354);
        $item355 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Dili");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item355);

        $item355->setCountry($this->getReference('_reference_ProviderCountry225'));
        $this->addReference('_reference_ProviderTimezone355', $item355);
        $this->sanitizeEntityValues($item355);
        $manager->persist($item355);
        $item356 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Ashgabat");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item356);

        $item356->setCountry($this->getReference('_reference_ProviderCountry231'));
        $this->addReference('_reference_ProviderTimezone356', $item356);
        $this->sanitizeEntityValues($item356);
        $manager->persist($item356);
        $item357 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Tunis");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item357);

        $item357->setCountry($this->getReference('_reference_ProviderCountry230'));
        $this->addReference('_reference_ProviderTimezone357', $item357);
        $this->sanitizeEntityValues($item357);
        $manager->persist($item357);
        $item358 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Tongatapu");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item358);

        $item358->setCountry($this->getReference('_reference_ProviderCountry228'));
        $this->addReference('_reference_ProviderTimezone358', $item358);
        $this->sanitizeEntityValues($item358);
        $manager->persist($item358);
        $item359 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Istanbul");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item359);

        $item359->setCountry($this->getReference('_reference_ProviderCountry232'));
        $this->addReference('_reference_ProviderTimezone359', $item359);
        $this->sanitizeEntityValues($item359);
        $manager->persist($item359);
        $item360 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Port_of_Spain");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item360);

        $item360->setCountry($this->getReference('_reference_ProviderCountry229'));
        $this->addReference('_reference_ProviderTimezone360', $item360);
        $this->sanitizeEntityValues($item360);
        $manager->persist($item360);
        $item361 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Funafuti");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item361);

        $item361->setCountry($this->getReference('_reference_ProviderCountry233'));
        $this->addReference('_reference_ProviderTimezone361', $item361);
        $this->sanitizeEntityValues($item361);
        $manager->persist($item361);
        $item362 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Taipei");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item362);

        $item362->setCountry($this->getReference('_reference_ProviderCountry219'));
        $this->addReference('_reference_ProviderTimezone362', $item362);
        $this->sanitizeEntityValues($item362);
        $manager->persist($item362);
        $item363 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Dar_es_Salaam");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item363);

        $item363->setCountry($this->getReference('_reference_ProviderCountry220'));
        $this->addReference('_reference_ProviderTimezone363', $item363);
        $this->sanitizeEntityValues($item363);
        $manager->persist($item363);
        $item364 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Kiev");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item364);

        $item364->setCountry($this->getReference('_reference_ProviderCountry234'));
        $this->addReference('_reference_ProviderTimezone364', $item364);
        $this->sanitizeEntityValues($item364);
        $manager->persist($item364);
        $item365 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Uzhgorod");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item365);

        $item365->setCountry($this->getReference('_reference_ProviderCountry234'));
        $this->addReference('_reference_ProviderTimezone365', $item365);
        $this->sanitizeEntityValues($item365);
        $manager->persist($item365);
        $item366 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Zaporozhye");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item366);

        $item366->setCountry($this->getReference('_reference_ProviderCountry234'));
        $this->addReference('_reference_ProviderTimezone366', $item366);
        $this->sanitizeEntityValues($item366);
        $manager->persist($item366);
        $item367 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Kampala");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item367);

        $item367->setCountry($this->getReference('_reference_ProviderCountry235'));
        $this->addReference('_reference_ProviderTimezone367', $item367);
        $this->sanitizeEntityValues($item367);
        $manager->persist($item367);
        $item368 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Johnston");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item368);

        $item368->setCountry($this->getReference('_reference_ProviderCountry111'));
        $this->addReference('_reference_ProviderTimezone368', $item368);
        $this->sanitizeEntityValues($item368);
        $manager->persist($item368);
        $item369 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Midway");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item369);

        $item369->setCountry($this->getReference('_reference_ProviderCountry111'));
        $this->addReference('_reference_ProviderTimezone369', $item369);
        $this->sanitizeEntityValues($item369);
        $manager->persist($item369);
        $item370 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Wake");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item370);

        $item370->setCountry($this->getReference('_reference_ProviderCountry111'));
        $this->addReference('_reference_ProviderTimezone370', $item370);
        $this->sanitizeEntityValues($item370);
        $manager->persist($item370);
        $item371 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/New_York");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item371);

        $item371->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone371', $item371);
        $this->sanitizeEntityValues($item371);
        $manager->persist($item371);
        $item372 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Detroit");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item372);

        $item372->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone372', $item372);
        $this->sanitizeEntityValues($item372);
        $manager->persist($item372);
        $item373 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Kentucky/Louisville");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item373);

        $item373->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone373', $item373);
        $this->sanitizeEntityValues($item373);
        $manager->persist($item373);
        $item374 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Kentucky/Monticello");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item374);

        $item374->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone374', $item374);
        $this->sanitizeEntityValues($item374);
        $manager->persist($item374);
        $item375 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Indiana/Indianapolis");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item375);

        $item375->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone375', $item375);
        $this->sanitizeEntityValues($item375);
        $manager->persist($item375);
        $item376 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Indiana/Vincennes");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item376);

        $item376->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone376', $item376);
        $this->sanitizeEntityValues($item376);
        $manager->persist($item376);
        $item377 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Indiana/Winamac");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item377);

        $item377->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone377', $item377);
        $this->sanitizeEntityValues($item377);
        $manager->persist($item377);
        $item378 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Indiana/Marengo");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item378);

        $item378->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone378', $item378);
        $this->sanitizeEntityValues($item378);
        $manager->persist($item378);
        $item379 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Indiana/Petersburg");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item379);

        $item379->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone379', $item379);
        $this->sanitizeEntityValues($item379);
        $manager->persist($item379);
        $item380 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Indiana/Vevay");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item380);

        $item380->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone380', $item380);
        $this->sanitizeEntityValues($item380);
        $manager->persist($item380);
        $item381 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Chicago");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item381);

        $item381->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone381', $item381);
        $this->sanitizeEntityValues($item381);
        $manager->persist($item381);
        $item382 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Indiana/Tell_City");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item382);

        $item382->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone382', $item382);
        $this->sanitizeEntityValues($item382);
        $manager->persist($item382);
        $item383 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Indiana/Knox");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item383);

        $item383->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone383', $item383);
        $this->sanitizeEntityValues($item383);
        $manager->persist($item383);
        $item384 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Menominee");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item384);

        $item384->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone384', $item384);
        $this->sanitizeEntityValues($item384);
        $manager->persist($item384);
        $item385 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/North_Dakota/Center");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item385);

        $item385->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone385', $item385);
        $this->sanitizeEntityValues($item385);
        $manager->persist($item385);
        $item386 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/North_Dakota/New_Salem");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item386);

        $item386->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone386', $item386);
        $this->sanitizeEntityValues($item386);
        $manager->persist($item386);
        $item387 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/North_Dakota/Beulah");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item387);

        $item387->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone387', $item387);
        $this->sanitizeEntityValues($item387);
        $manager->persist($item387);
        $item388 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Denver");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item388);

        $item388->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone388', $item388);
        $this->sanitizeEntityValues($item388);
        $manager->persist($item388);
        $item389 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Boise");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item389);

        $item389->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone389', $item389);
        $this->sanitizeEntityValues($item389);
        $manager->persist($item389);
        $item390 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Phoenix");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item390);

        $item390->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone390', $item390);
        $this->sanitizeEntityValues($item390);
        $manager->persist($item390);
        $item391 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Los_Angeles");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item391);

        $item391->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone391', $item391);
        $this->sanitizeEntityValues($item391);
        $manager->persist($item391);
        $item392 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Metlakatla");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item392);

        $item392->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone392', $item392);
        $this->sanitizeEntityValues($item392);
        $manager->persist($item392);
        $item393 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Anchorage");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item393);

        $item393->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone393', $item393);
        $this->sanitizeEntityValues($item393);
        $manager->persist($item393);
        $item394 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Juneau");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item394);

        $item394->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone394', $item394);
        $this->sanitizeEntityValues($item394);
        $manager->persist($item394);
        $item395 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Sitka");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item395);

        $item395->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone395', $item395);
        $this->sanitizeEntityValues($item395);
        $manager->persist($item395);
        $item396 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Yakutat");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item396);

        $item396->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone396', $item396);
        $this->sanitizeEntityValues($item396);
        $manager->persist($item396);
        $item397 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Nome");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item397);

        $item397->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone397', $item397);
        $this->sanitizeEntityValues($item397);
        $manager->persist($item397);
        $item398 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Adak");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item398);

        $item398->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone398', $item398);
        $this->sanitizeEntityValues($item398);
        $manager->persist($item398);
        $item399 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Honolulu");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item399);

        $item399->setCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderTimezone399', $item399);
        $this->sanitizeEntityValues($item399);
        $manager->persist($item399);
        $item400 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Montevideo");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item400);

        $item400->setCountry($this->getReference('_reference_ProviderCountry236'));
        $this->addReference('_reference_ProviderTimezone400', $item400);
        $this->sanitizeEntityValues($item400);
        $manager->persist($item400);
        $item401 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Samarkand");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item401);

        $item401->setCountry($this->getReference('_reference_ProviderCountry237'));
        $this->addReference('_reference_ProviderTimezone401', $item401);
        $this->sanitizeEntityValues($item401);
        $manager->persist($item401);
        $item402 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Tashkent");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item402);

        $item402->setCountry($this->getReference('_reference_ProviderCountry237'));
        $this->addReference('_reference_ProviderTimezone402', $item402);
        $this->sanitizeEntityValues($item402);
        $manager->persist($item402);
        $item403 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Europe/Vatican");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item403);

        $item403->setCountry($this->getReference('_reference_ProviderCountry43'));
        $this->addReference('_reference_ProviderTimezone403', $item403);
        $this->sanitizeEntityValues($item403);
        $manager->persist($item403);
        $item404 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/St_Vincent");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item404);

        $item404->setCountry($this->getReference('_reference_ProviderCountry199'));
        $this->addReference('_reference_ProviderTimezone404', $item404);
        $this->sanitizeEntityValues($item404);
        $manager->persist($item404);
        $item405 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Caracas");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item405);

        $item405->setCountry($this->getReference('_reference_ProviderCountry239'));
        $this->addReference('_reference_ProviderTimezone405', $item405);
        $this->sanitizeEntityValues($item405);
        $manager->persist($item405);
        $item406 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/Tortola");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item406);

        $item406->setCountry($this->getReference('_reference_ProviderCountry115'));
        $this->addReference('_reference_ProviderTimezone406', $item406);
        $this->sanitizeEntityValues($item406);
        $manager->persist($item406);
        $item407 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("America/St_Thomas");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item407);

        $item407->setCountry($this->getReference('_reference_ProviderCountry116'));
        $this->addReference('_reference_ProviderTimezone407', $item407);
        $this->sanitizeEntityValues($item407);
        $manager->persist($item407);
        $item408 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Ho_Chi_Minh");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item408);

        $item408->setCountry($this->getReference('_reference_ProviderCountry240'));
        $this->addReference('_reference_ProviderTimezone408', $item408);
        $this->sanitizeEntityValues($item408);
        $manager->persist($item408);
        $item409 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Efate");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item409);

        $item409->setCountry($this->getReference('_reference_ProviderCountry238'));
        $this->addReference('_reference_ProviderTimezone409', $item409);
        $this->sanitizeEntityValues($item409);
        $manager->persist($item409);
        $item410 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Wallis");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item410);

        $item410->setCountry($this->getReference('_reference_ProviderCountry241'));
        $this->addReference('_reference_ProviderTimezone410', $item410);
        $this->sanitizeEntityValues($item410);
        $manager->persist($item410);
        $item411 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Pacific/Apia");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item411);

        $item411->setCountry($this->getReference('_reference_ProviderCountry192'));
        $this->addReference('_reference_ProviderTimezone411', $item411);
        $this->sanitizeEntityValues($item411);
        $manager->persist($item411);
        $item412 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Asia/Aden");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item412);

        $item412->setCountry($this->getReference('_reference_ProviderCountry242'));
        $this->addReference('_reference_ProviderTimezone412', $item412);
        $this->sanitizeEntityValues($item412);
        $manager->persist($item412);
        $item413 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Indian/Mayotte");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item413);

        $item413->setCountry($this->getReference('_reference_ProviderCountry148'));
        $this->addReference('_reference_ProviderTimezone413', $item413);
        $this->sanitizeEntityValues($item413);
        $manager->persist($item413);
        $item414 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Johannesburg");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item414);

        $item414->setCountry($this->getReference('_reference_ProviderCountry212'));
        $this->addReference('_reference_ProviderTimezone414', $item414);
        $this->sanitizeEntityValues($item414);
        $manager->persist($item414);
        $item415 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Lusaka");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item415);

        $item415->setCountry($this->getReference('_reference_ProviderCountry244'));
        $this->addReference('_reference_ProviderTimezone415', $item415);
        $this->sanitizeEntityValues($item415);
        $manager->persist($item415);
        $item416 = $this->createEntityInstance(Timezone::class);
        (function () {
            $this->setTz("Africa/Harare");
            $this->setLabel(new Label('', '', '', ''));
        })->call($item416);

        $item416->setCountry($this->getReference('_reference_ProviderCountry245'));
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
