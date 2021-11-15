<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Country\Country;
use Ivoz\Provider\Domain\Model\Country\Name;
use Ivoz\Provider\Domain\Model\Country\Zone;

class ProviderCountry extends Fixture
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Country::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);


        $item1 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("AD");
            $this->setCountryCode("+376");
            $this->name = new Name('Andorra', 'Andorra', 'Andorra', 'Andorra');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item1);

        $this->addReference('_reference_ProviderCountry1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);


        $item2 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("AE");
            $this->setCountryCode("+971");
            $this->name = new Name('United Arab Emirates', 'Emiratos Árabes Unidos', 'Emiratos Árabes Unidos', 'United Arab Emirates');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item2);

        $this->addReference('_reference_ProviderCountry2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);


        $item3 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("AF");
            $this->setCountryCode("+93");
            $this->name = new Name('Afghanistan', 'Afganistán', 'Afganistán', 'Afghanistan');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item3);

        $this->addReference('_reference_ProviderCountry3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);


        $item4 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("AG");
            $this->setCountryCode("+1268");
            $this->name = new Name('Antigua and Barbuda', 'Antigua y Barbuda', 'Antigua y Barbuda', 'Antigua and Barbuda');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item4);

        $this->addReference('_reference_ProviderCountry4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);


        $item5 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("AI");
            $this->setCountryCode("+1264");
            $this->name = new Name('Anguilla', 'Anguila', 'Anguila', 'Anguilla');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item5);

        $this->addReference('_reference_ProviderCountry5', $item5);
        $this->sanitizeEntityValues($item5);
        $manager->persist($item5);


        $item6 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("AL");
            $this->setCountryCode("+355");
            $this->name = new Name('Albania', 'Albania', 'Albania', 'Albania');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item6);

        $this->addReference('_reference_ProviderCountry6', $item6);
        $this->sanitizeEntityValues($item6);
        $manager->persist($item6);


        $item7 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("AM");
            $this->setCountryCode("+374");
            $this->name = new Name('Armenia', 'Armenia', 'Armenia', 'Armenia');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item7);

        $this->addReference('_reference_ProviderCountry7', $item7);
        $this->sanitizeEntityValues($item7);
        $manager->persist($item7);


        $item8 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("AO");
            $this->setCountryCode("+244");
            $this->name = new Name('Angola', 'Angola', 'Angola', 'Angola');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item8);

        $this->addReference('_reference_ProviderCountry8', $item8);
        $this->sanitizeEntityValues($item8);
        $manager->persist($item8);


        $item9 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("AQ");
            $this->setCountryCode("+672");
            $this->name = new Name('Antarctica', 'Antártida', 'Antártida', 'Antarctica');
            $this->zone = new Zone('Antarctica', 'Antarctica', 'Antarctica', 'Antarctica');
        })->call($item9);

        $this->addReference('_reference_ProviderCountry9', $item9);
        $this->sanitizeEntityValues($item9);
        $manager->persist($item9);


        $item10 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("AR");
            $this->setCountryCode("+54");
            $this->name = new Name('Argentina', 'Argentina', 'Argentina', 'Argentina');
            $this->zone = new Zone('South america', 'South america', 'South america', 'South america');
        })->call($item10);

        $this->addReference('_reference_ProviderCountry10', $item10);
        $this->sanitizeEntityValues($item10);
        $manager->persist($item10);


        $item11 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("AS");
            $this->setCountryCode("+1684");
            $this->name = new Name('American Samoa', 'Samoa Americana', 'Samoa Americana', 'American Samoa');
            $this->zone = new Zone('Oceania', 'Oceania', 'Oceania', 'Oceania');
        })->call($item11);

        $this->addReference('_reference_ProviderCountry11', $item11);
        $this->sanitizeEntityValues($item11);
        $manager->persist($item11);


        $item12 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("AT");
            $this->setCountryCode("+43");
            $this->name = new Name('Austria', 'Austria', 'Austria', 'Austria');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item12);

        $this->addReference('_reference_ProviderCountry12', $item12);
        $this->sanitizeEntityValues($item12);
        $manager->persist($item12);


        $item13 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("AU");
            $this->setCountryCode("+61");
            $this->name = new Name('Australia', 'Australia', 'Australia', 'Australia');
            $this->zone = new Zone('Oceania', 'Oceania', 'Oceania', 'Oceania');
        })->call($item13);

        $this->addReference('_reference_ProviderCountry13', $item13);
        $this->sanitizeEntityValues($item13);
        $manager->persist($item13);


        $item14 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("AW");
            $this->setCountryCode("+297");
            $this->name = new Name('Aruba', 'Aruba', 'Aruba', 'Aruba');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item14);

        $this->addReference('_reference_ProviderCountry14', $item14);
        $this->sanitizeEntityValues($item14);
        $manager->persist($item14);


        $item15 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("AX");
            $this->setCountryCode("+358");
            $this->name = new Name('Åland Islands', 'Islas de Åland', 'Islas de Åland', 'Åland Islands');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item15);

        $this->addReference('_reference_ProviderCountry15', $item15);
        $this->sanitizeEntityValues($item15);
        $manager->persist($item15);


        $item16 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("AZ");
            $this->setCountryCode("+994");
            $this->name = new Name('Azerbaijan', 'Azerbayán', 'Azerbayán', 'Azerbaijan');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item16);

        $this->addReference('_reference_ProviderCountry16', $item16);
        $this->sanitizeEntityValues($item16);
        $manager->persist($item16);


        $item17 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("BA");
            $this->setCountryCode("+387");
            $this->name = new Name('Bosnia and Herzegovina', 'Bosnia y Herzegovina', 'Bosnia y Herzegovina', 'Bosnia and Herzegovina');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item17);

        $this->addReference('_reference_ProviderCountry17', $item17);
        $this->sanitizeEntityValues($item17);
        $manager->persist($item17);


        $item18 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("BB");
            $this->setCountryCode("+1246");
            $this->name = new Name('Barbados', 'Barbados', 'Barbados', 'Barbados');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item18);

        $this->addReference('_reference_ProviderCountry18', $item18);
        $this->sanitizeEntityValues($item18);
        $manager->persist($item18);


        $item19 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("BD");
            $this->setCountryCode("+880");
            $this->name = new Name('Bangladesh', 'Bangladesh', 'Bangladesh', 'Bangladesh');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item19);

        $this->addReference('_reference_ProviderCountry19', $item19);
        $this->sanitizeEntityValues($item19);
        $manager->persist($item19);


        $item20 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("BE");
            $this->setCountryCode("+32");
            $this->name = new Name('Belgium', 'Bélgica', 'Bélgica', 'Belgium');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item20);

        $this->addReference('_reference_ProviderCountry20', $item20);
        $this->sanitizeEntityValues($item20);
        $manager->persist($item20);


        $item21 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("BF");
            $this->setCountryCode("+226");
            $this->name = new Name('Burkina Faso', 'Burkina Faso', 'Burkina Faso', 'Burkina Faso');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item21);

        $this->addReference('_reference_ProviderCountry21', $item21);
        $this->sanitizeEntityValues($item21);
        $manager->persist($item21);


        $item22 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("BG");
            $this->setCountryCode("+359");
            $this->name = new Name('Bulgaria', 'Bulgaria', 'Bulgaria', 'Bulgaria');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item22);

        $this->addReference('_reference_ProviderCountry22', $item22);
        $this->sanitizeEntityValues($item22);
        $manager->persist($item22);


        $item23 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("BH");
            $this->setCountryCode("+973");
            $this->name = new Name('Bahrain', 'Bahrein', 'Bahrein', 'Bahrain');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item23);

        $this->addReference('_reference_ProviderCountry23', $item23);
        $this->sanitizeEntityValues($item23);
        $manager->persist($item23);


        $item24 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("BI");
            $this->setCountryCode("+257");
            $this->name = new Name('Burundi', 'Burundi', 'Burundi', 'Burundi');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item24);

        $this->addReference('_reference_ProviderCountry24', $item24);
        $this->sanitizeEntityValues($item24);
        $manager->persist($item24);


        $item25 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("BJ");
            $this->setCountryCode("+229");
            $this->name = new Name('Benin', 'Benín', 'Benín', 'Benin');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item25);

        $this->addReference('_reference_ProviderCountry25', $item25);
        $this->sanitizeEntityValues($item25);
        $manager->persist($item25);


        $item26 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("BL");
            $this->setCountryCode("+590");
            $this->name = new Name('Saint Barthélemy', 'San Bartolomé', 'San Bartolomé', 'Saint Barthélemy');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item26);

        $this->addReference('_reference_ProviderCountry26', $item26);
        $this->sanitizeEntityValues($item26);
        $manager->persist($item26);


        $item27 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("BM");
            $this->setCountryCode("+1441");
            $this->name = new Name('Bermuda Islands', 'Islas Bermudas', 'Islas Bermudas', 'Bermuda Islands');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item27);

        $this->addReference('_reference_ProviderCountry27', $item27);
        $this->sanitizeEntityValues($item27);
        $manager->persist($item27);


        $item28 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("BN");
            $this->setCountryCode("+673");
            $this->name = new Name('Brunei', 'Brunéi', 'Brunéi', 'Brunei');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item28);

        $this->addReference('_reference_ProviderCountry28', $item28);
        $this->sanitizeEntityValues($item28);
        $manager->persist($item28);


        $item29 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("BO");
            $this->setCountryCode("+591");
            $this->name = new Name('Bolivia', 'Bolivia', 'Bolivia', 'Bolivia');
            $this->zone = new Zone('South america', 'South america', 'South america', 'South america');
        })->call($item29);

        $this->addReference('_reference_ProviderCountry29', $item29);
        $this->sanitizeEntityValues($item29);
        $manager->persist($item29);


        $item30 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("BQ");
            $this->setCountryCode("+599");
            $this->name = new Name('Bonaire', 'Bonaire', 'Bonaire', 'Bonaire');
            $this->zone = new Zone('South america', 'South america', 'South america', 'South america');
        })->call($item30);

        $this->addReference('_reference_ProviderCountry30', $item30);
        $this->sanitizeEntityValues($item30);
        $manager->persist($item30);


        $item31 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("BR");
            $this->setCountryCode("+55");
            $this->name = new Name('Brazil', 'Brasil', 'Brasil', 'Brazil');
            $this->zone = new Zone('South america', 'South america', 'South america', 'South america');
        })->call($item31);

        $this->addReference('_reference_ProviderCountry31', $item31);
        $this->sanitizeEntityValues($item31);
        $manager->persist($item31);


        $item32 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("BS");
            $this->setCountryCode("+1242");
            $this->name = new Name('Bahamas', 'Bahamas', 'Bahamas', 'Bahamas');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item32);

        $this->addReference('_reference_ProviderCountry32', $item32);
        $this->sanitizeEntityValues($item32);
        $manager->persist($item32);


        $item33 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("BT");
            $this->setCountryCode("+975");
            $this->name = new Name('Bhutan', 'Bhután', 'Bhután', 'Bhutan');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item33);

        $this->addReference('_reference_ProviderCountry33', $item33);
        $this->sanitizeEntityValues($item33);
        $manager->persist($item33);


        $item34 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("BV");
            $this->setCountryCode("+47");
            $this->name = new Name('Bouvet Island', 'Isla Bouvet', 'Isla Bouvet', 'Bouvet Island');
            $this->zone = new Zone('Antarctica', 'Antarctica', 'Antarctica', 'Antarctica');
        })->call($item34);

        $this->addReference('_reference_ProviderCountry34', $item34);
        $this->sanitizeEntityValues($item34);
        $manager->persist($item34);


        $item35 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("BW");
            $this->setCountryCode("+267");
            $this->name = new Name('Botswana', 'Botsuana', 'Botsuana', 'Botswana');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item35);

        $this->addReference('_reference_ProviderCountry35', $item35);
        $this->sanitizeEntityValues($item35);
        $manager->persist($item35);


        $item36 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("BY");
            $this->setCountryCode("+375");
            $this->name = new Name('Belarus', 'Bielorrusia', 'Bielorrusia', 'Belarus');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item36);

        $this->addReference('_reference_ProviderCountry36', $item36);
        $this->sanitizeEntityValues($item36);
        $manager->persist($item36);


        $item37 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("BZ");
            $this->setCountryCode("+501");
            $this->name = new Name('Belize', 'Belice', 'Belice', 'Belize');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item37);

        $this->addReference('_reference_ProviderCountry37', $item37);
        $this->sanitizeEntityValues($item37);
        $manager->persist($item37);


        $item38 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("CA");
            $this->setCountryCode("+1");
            $this->name = new Name('Canada', 'Canadá', 'Canadá', 'Canada');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item38);

        $this->addReference('_reference_ProviderCountry38', $item38);
        $this->sanitizeEntityValues($item38);
        $manager->persist($item38);


        $item39 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("CC");
            $this->setCountryCode("+61");
            $this->name = new Name('Cocos (Keeling) Islands', 'Islas Cocos (Keeling)', 'Islas Cocos (Keeling)', 'Cocos (Keeling) Islands');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item39);

        $this->addReference('_reference_ProviderCountry39', $item39);
        $this->sanitizeEntityValues($item39);
        $manager->persist($item39);


        $item40 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("CD");
            $this->setCountryCode("+243");
            $this->name = new Name('Congo', 'Congo', 'Congo', 'Congo');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item40);

        $this->addReference('_reference_ProviderCountry40', $item40);
        $this->sanitizeEntityValues($item40);
        $manager->persist($item40);


        $item41 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("CF");
            $this->setCountryCode("+236");
            $this->name = new Name('Central African Republic', 'República Centroafricana', 'República Centroafricana', 'Central African Republic');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item41);

        $this->addReference('_reference_ProviderCountry41', $item41);
        $this->sanitizeEntityValues($item41);
        $manager->persist($item41);


        $item42 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("CG");
            $this->setCountryCode("+242");
            $this->name = new Name('Congo', 'Congo', 'Congo', 'Congo');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item42);

        $this->addReference('_reference_ProviderCountry42', $item42);
        $this->sanitizeEntityValues($item42);
        $manager->persist($item42);


        $item43 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("CH");
            $this->setCountryCode("+41");
            $this->name = new Name('Switzerland', 'Suiza', 'Suiza', 'Switzerland');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item43);

        $this->addReference('_reference_ProviderCountry43', $item43);
        $this->sanitizeEntityValues($item43);
        $manager->persist($item43);


        $item44 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("CI");
            $this->setCountryCode("+225");
            $this->name = new Name('Ivory Coast', 'Costa de Marfil', 'Costa de Marfil', 'Ivory Coast');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item44);

        $this->addReference('_reference_ProviderCountry44', $item44);
        $this->sanitizeEntityValues($item44);
        $manager->persist($item44);


        $item45 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("CK");
            $this->setCountryCode("+682");
            $this->name = new Name('Cook Islands', 'Islas Cook', 'Islas Cook', 'Cook Islands');
            $this->zone = new Zone('Oceania', 'Oceania', 'Oceania', 'Oceania');
        })->call($item45);

        $this->addReference('_reference_ProviderCountry45', $item45);
        $this->sanitizeEntityValues($item45);
        $manager->persist($item45);


        $item46 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("CL");
            $this->setCountryCode("+56");
            $this->name = new Name('Chile', 'Chile', 'Chile', 'Chile');
            $this->zone = new Zone('South america', 'South america', 'South america', 'South america');
        })->call($item46);

        $this->addReference('_reference_ProviderCountry46', $item46);
        $this->sanitizeEntityValues($item46);
        $manager->persist($item46);


        $item47 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("CM");
            $this->setCountryCode("+237");
            $this->name = new Name('Cameroon', 'Camerún', 'Camerún', 'Cameroon');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item47);

        $this->addReference('_reference_ProviderCountry47', $item47);
        $this->sanitizeEntityValues($item47);
        $manager->persist($item47);


        $item48 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("CN");
            $this->setCountryCode("+86");
            $this->name = new Name('China', 'China', 'China', 'China');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item48);

        $this->addReference('_reference_ProviderCountry48', $item48);
        $this->sanitizeEntityValues($item48);
        $manager->persist($item48);


        $item49 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("CO");
            $this->setCountryCode("+57");
            $this->name = new Name('Colombia', 'Colombia', 'Colombia', 'Colombia');
            $this->zone = new Zone('South america', 'South america', 'South america', 'South america');
        })->call($item49);

        $this->addReference('_reference_ProviderCountry49', $item49);
        $this->sanitizeEntityValues($item49);
        $manager->persist($item49);


        $item50 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("CR");
            $this->setCountryCode("+506");
            $this->name = new Name('Costa Rica', 'Costa Rica', 'Costa Rica', 'Costa Rica');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item50);

        $this->addReference('_reference_ProviderCountry50', $item50);
        $this->sanitizeEntityValues($item50);
        $manager->persist($item50);


        $item51 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("CU");
            $this->setCountryCode("+53");
            $this->name = new Name('Cuba', 'Cuba', 'Cuba', 'Cuba');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item51);

        $this->addReference('_reference_ProviderCountry51', $item51);
        $this->sanitizeEntityValues($item51);
        $manager->persist($item51);


        $item52 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("CV");
            $this->setCountryCode("+238");
            $this->name = new Name('Cape Verde', 'Cabo Verde', 'Cabo Verde', 'Cape Verde');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item52);

        $this->addReference('_reference_ProviderCountry52', $item52);
        $this->sanitizeEntityValues($item52);
        $manager->persist($item52);


        $item53 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("CW");
            $this->setCountryCode("+599");
            $this->name = new Name('Curaçao', 'Curaçao', 'Curaçao', 'Curaçao');
            $this->zone = new Zone('South america', 'South america', 'South america', 'South america');
        })->call($item53);

        $this->addReference('_reference_ProviderCountry53', $item53);
        $this->sanitizeEntityValues($item53);
        $manager->persist($item53);


        $item54 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("CX");
            $this->setCountryCode("+61");
            $this->name = new Name('Christmas Island', 'Isla de Navidad', 'Isla de Navidad', 'Christmas Island');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item54);

        $this->addReference('_reference_ProviderCountry54', $item54);
        $this->sanitizeEntityValues($item54);
        $manager->persist($item54);


        $item55 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("CY");
            $this->setCountryCode("+357");
            $this->name = new Name('Cyprus', 'Chipre', 'Chipre', 'Cyprus');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item55);

        $this->addReference('_reference_ProviderCountry55', $item55);
        $this->sanitizeEntityValues($item55);
        $manager->persist($item55);


        $item56 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("CZ");
            $this->setCountryCode("+420");
            $this->name = new Name('Czech Republic', 'República Checa', 'República Checa', 'Czech Republic');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item56);

        $this->addReference('_reference_ProviderCountry56', $item56);
        $this->sanitizeEntityValues($item56);
        $manager->persist($item56);


        $item57 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("DE");
            $this->setCountryCode("+49");
            $this->name = new Name('Germany', 'Alemania', 'Alemania', 'Germany');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item57);

        $this->addReference('_reference_ProviderCountry57', $item57);
        $this->sanitizeEntityValues($item57);
        $manager->persist($item57);


        $item58 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("DJ");
            $this->setCountryCode("+253");
            $this->name = new Name('Djibouti', 'Yibuti', 'Yibuti', 'Djibouti');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item58);

        $this->addReference('_reference_ProviderCountry58', $item58);
        $this->sanitizeEntityValues($item58);
        $manager->persist($item58);


        $item59 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("DK");
            $this->setCountryCode("+45");
            $this->name = new Name('Denmark', 'Dinamarca', 'Dinamarca', 'Denmark');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item59);

        $this->addReference('_reference_ProviderCountry59', $item59);
        $this->sanitizeEntityValues($item59);
        $manager->persist($item59);


        $item60 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("DM");
            $this->setCountryCode("+1767");
            $this->name = new Name('Dominica', 'Dominica', 'Dominica', 'Dominica');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item60);

        $this->addReference('_reference_ProviderCountry60', $item60);
        $this->sanitizeEntityValues($item60);
        $manager->persist($item60);


        $item61 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("DO");
            $this->setCountryCode("+1809");
            $this->name = new Name('Dominican Republic', 'República Dominicana', 'República Dominicana', 'Dominican Republic');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item61);

        $this->addReference('_reference_ProviderCountry61', $item61);
        $this->sanitizeEntityValues($item61);
        $manager->persist($item61);


        $item64 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("DZ");
            $this->setCountryCode("+213");
            $this->name = new Name('Algeria', 'Algeria', 'Algeria', 'Algeria');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item64);

        $this->addReference('_reference_ProviderCountry64', $item64);
        $this->sanitizeEntityValues($item64);
        $manager->persist($item64);


        $item65 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("EC");
            $this->setCountryCode("+593");
            $this->name = new Name('Ecuador', 'Ecuador', 'Ecuador', 'Ecuador');
            $this->zone = new Zone('South america', 'South america', 'South america', 'South america');
        })->call($item65);

        $this->addReference('_reference_ProviderCountry65', $item65);
        $this->sanitizeEntityValues($item65);
        $manager->persist($item65);


        $item66 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("EE");
            $this->setCountryCode("+372");
            $this->name = new Name('Estonia', 'Estonia', 'Estonia', 'Estonia');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item66);

        $this->addReference('_reference_ProviderCountry66', $item66);
        $this->sanitizeEntityValues($item66);
        $manager->persist($item66);


        $item67 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("EG");
            $this->setCountryCode("+20");
            $this->name = new Name('Egypt', 'Egipto', 'Egipto', 'Egypt');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item67);

        $this->addReference('_reference_ProviderCountry67', $item67);
        $this->sanitizeEntityValues($item67);
        $manager->persist($item67);


        $item68 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("EH");
            $this->setCountryCode("+212");
            $this->name = new Name('Western Sahara', 'Sahara Occidental', 'Sahara Occidental', 'Western Sahara');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item68);

        $this->addReference('_reference_ProviderCountry68', $item68);
        $this->sanitizeEntityValues($item68);
        $manager->persist($item68);


        $item69 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("ER");
            $this->setCountryCode("+291");
            $this->name = new Name('Eritrea', 'Eritrea', 'Eritrea', 'Eritrea');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item69);

        $this->addReference('_reference_ProviderCountry69', $item69);
        $this->sanitizeEntityValues($item69);
        $manager->persist($item69);


        $item70 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("ES");
            $this->setCountryCode("+34");
            $this->name = new Name('Spain', 'España', 'España', 'Spagna');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item70);

        $this->addReference('_reference_ProviderCountry70', $item70);
        $this->sanitizeEntityValues($item70);
        $manager->persist($item70);


        $item71 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("ET");
            $this->setCountryCode("+251");
            $this->name = new Name('Ethiopia', 'Etiopía', 'Etiopía', 'Ethiopia');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item71);

        $this->addReference('_reference_ProviderCountry71', $item71);
        $this->sanitizeEntityValues($item71);
        $manager->persist($item71);


        $item72 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("FI");
            $this->setCountryCode("+358");
            $this->name = new Name('Finland', 'Finlandia', 'Finlandia', 'Finland');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item72);

        $this->addReference('_reference_ProviderCountry72', $item72);
        $this->sanitizeEntityValues($item72);
        $manager->persist($item72);


        $item73 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("FJ");
            $this->setCountryCode("+679");
            $this->name = new Name('Fiji', 'Fiyi', 'Fiyi', 'Fiji');
            $this->zone = new Zone('Oceania', 'Oceania', 'Oceania', 'Oceania');
        })->call($item73);

        $this->addReference('_reference_ProviderCountry73', $item73);
        $this->sanitizeEntityValues($item73);
        $manager->persist($item73);


        $item74 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("FK");
            $this->setCountryCode("+500");
            $this->name = new Name('Falkland Islands (Malvinas)', 'Islas Malvinas', 'Islas Malvinas', 'Falkland Islands (Malvinas)');
            $this->zone = new Zone('South america', 'South america', 'South america', 'South america');
        })->call($item74);

        $this->addReference('_reference_ProviderCountry74', $item74);
        $this->sanitizeEntityValues($item74);
        $manager->persist($item74);


        $item75 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("FM");
            $this->setCountryCode("+691");
            $this->name = new Name('Estados Federados de', 'Micronesia', 'Micronesia', 'Estados Federados de');
            $this->zone = new Zone('Oceania', 'Oceania', 'Oceania', 'Oceania');
        })->call($item75);

        $this->addReference('_reference_ProviderCountry75', $item75);
        $this->sanitizeEntityValues($item75);
        $manager->persist($item75);


        $item76 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("FO");
            $this->setCountryCode("+298");
            $this->name = new Name('Faroe Islands', 'Islas Feroe', 'Islas Feroe', 'Faroe Islands');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item76);

        $this->addReference('_reference_ProviderCountry76', $item76);
        $this->sanitizeEntityValues($item76);
        $manager->persist($item76);


        $item77 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("FR");
            $this->setCountryCode("+33");
            $this->name = new Name('France', 'Francia', 'Francia', 'France');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item77);

        $this->addReference('_reference_ProviderCountry77', $item77);
        $this->sanitizeEntityValues($item77);
        $manager->persist($item77);


        $item78 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("GA");
            $this->setCountryCode("+241");
            $this->name = new Name('Gabon', 'Gabón', 'Gabón', 'Gabon');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item78);

        $this->addReference('_reference_ProviderCountry78', $item78);
        $this->sanitizeEntityValues($item78);
        $manager->persist($item78);


        $item79 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("GB");
            $this->setCountryCode("+44");
            $this->name = new Name('United Kingdom', 'Reino Unido', 'Reino Unido', 'United Kingdom');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item79);

        $this->addReference('_reference_ProviderCountry79', $item79);
        $this->sanitizeEntityValues($item79);
        $manager->persist($item79);


        $item80 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("GD");
            $this->setCountryCode("+1473");
            $this->name = new Name('Grenada', 'Granada', 'Granada', 'Grenada');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item80);

        $this->addReference('_reference_ProviderCountry80', $item80);
        $this->sanitizeEntityValues($item80);
        $manager->persist($item80);


        $item81 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("GE");
            $this->setCountryCode("+995");
            $this->name = new Name('Georgia', 'Georgia', 'Georgia', 'Georgia');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item81);

        $this->addReference('_reference_ProviderCountry81', $item81);
        $this->sanitizeEntityValues($item81);
        $manager->persist($item81);


        $item82 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("GF");
            $this->setCountryCode("+594");
            $this->name = new Name('French Guiana', 'Guayana Francesa', 'Guayana Francesa', 'French Guiana');
            $this->zone = new Zone('South america', 'South america', 'South america', 'South america');
        })->call($item82);

        $this->addReference('_reference_ProviderCountry82', $item82);
        $this->sanitizeEntityValues($item82);
        $manager->persist($item82);


        $item83 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("GG");
            $this->setCountryCode("+44");
            $this->name = new Name('Guernsey', 'Guernsey', 'Guernsey', 'Guernsey');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item83);

        $this->addReference('_reference_ProviderCountry83', $item83);
        $this->sanitizeEntityValues($item83);
        $manager->persist($item83);


        $item84 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("GH");
            $this->setCountryCode("+233");
            $this->name = new Name('Ghana', 'Ghana', 'Ghana', 'Ghana');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item84);

        $this->addReference('_reference_ProviderCountry84', $item84);
        $this->sanitizeEntityValues($item84);
        $manager->persist($item84);


        $item85 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("GI");
            $this->setCountryCode("+350");
            $this->name = new Name('Gibraltar', 'Gibraltar', 'Gibraltar', 'Gibraltar');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item85);

        $this->addReference('_reference_ProviderCountry85', $item85);
        $this->sanitizeEntityValues($item85);
        $manager->persist($item85);


        $item86 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("GL");
            $this->setCountryCode("+299");
            $this->name = new Name('Greenland', 'Groenlandia', 'Groenlandia', 'Greenland');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item86);

        $this->addReference('_reference_ProviderCountry86', $item86);
        $this->sanitizeEntityValues($item86);
        $manager->persist($item86);


        $item87 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("GM");
            $this->setCountryCode("+220");
            $this->name = new Name('Gambia', 'Gambia', 'Gambia', 'Gambia');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item87);

        $this->addReference('_reference_ProviderCountry87', $item87);
        $this->sanitizeEntityValues($item87);
        $manager->persist($item87);


        $item88 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("GN");
            $this->setCountryCode("+224");
            $this->name = new Name('Guinea', 'Guinea', 'Guinea', 'Guinea');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item88);

        $this->addReference('_reference_ProviderCountry88', $item88);
        $this->sanitizeEntityValues($item88);
        $manager->persist($item88);


        $item89 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("GP");
            $this->setCountryCode("+590");
            $this->name = new Name('Guadeloupe', 'Guadalupe', 'Guadalupe', 'Guadeloupe');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item89);

        $this->addReference('_reference_ProviderCountry89', $item89);
        $this->sanitizeEntityValues($item89);
        $manager->persist($item89);


        $item90 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("GQ");
            $this->setCountryCode("+240");
            $this->name = new Name('Equatorial Guinea', 'Guinea Ecuatorial', 'Guinea Ecuatorial', 'Equatorial Guinea');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item90);

        $this->addReference('_reference_ProviderCountry90', $item90);
        $this->sanitizeEntityValues($item90);
        $manager->persist($item90);


        $item91 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("GR");
            $this->setCountryCode("+30");
            $this->name = new Name('Greece', 'Grecia', 'Grecia', 'Greece');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item91);

        $this->addReference('_reference_ProviderCountry91', $item91);
        $this->sanitizeEntityValues($item91);
        $manager->persist($item91);


        $item92 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("GS");
            $this->setCountryCode("+500");
            $this->name = new Name('South Georgia and the South Sandwich Islands', 'Islas Georgias del Sur y Sandwich del Sur', 'Islas Georgias del Sur y Sandwich del Sur', 'South Georgia and the South Sandwich Islands');
            $this->zone = new Zone('Antarctica', 'Antarctica', 'Antarctica', 'Antarctica');
        })->call($item92);

        $this->addReference('_reference_ProviderCountry92', $item92);
        $this->sanitizeEntityValues($item92);
        $manager->persist($item92);


        $item93 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("GT");
            $this->setCountryCode("+502");
            $this->name = new Name('Guatemala', 'Guatemala', 'Guatemala', 'Guatemala');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item93);

        $this->addReference('_reference_ProviderCountry93', $item93);
        $this->sanitizeEntityValues($item93);
        $manager->persist($item93);


        $item94 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("GU");
            $this->setCountryCode("+1671");
            $this->name = new Name('Guam', 'Guam', 'Guam', 'Guam');
            $this->zone = new Zone('Oceania', 'Oceania', 'Oceania', 'Oceania');
        })->call($item94);

        $this->addReference('_reference_ProviderCountry94', $item94);
        $this->sanitizeEntityValues($item94);
        $manager->persist($item94);


        $item95 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("GW");
            $this->setCountryCode("+245");
            $this->name = new Name('Guinea-Bissau', 'Guinea-Bissau', 'Guinea-Bissau', 'Guinea-Bissau');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item95);

        $this->addReference('_reference_ProviderCountry95', $item95);
        $this->sanitizeEntityValues($item95);
        $manager->persist($item95);


        $item96 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("GY");
            $this->setCountryCode("+592");
            $this->name = new Name('Guyana', 'Guyana', 'Guyana', 'Guyana');
            $this->zone = new Zone('South america', 'South america', 'South america', 'South america');
        })->call($item96);

        $this->addReference('_reference_ProviderCountry96', $item96);
        $this->sanitizeEntityValues($item96);
        $manager->persist($item96);


        $item97 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("HK");
            $this->setCountryCode("+852");
            $this->name = new Name('Hong Kong', 'Hong kong', 'Hong kong', 'Hong Kong');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item97);

        $this->addReference('_reference_ProviderCountry97', $item97);
        $this->sanitizeEntityValues($item97);
        $manager->persist($item97);


        $item98 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("HM");
            $this->setCountryCode("+672");
            $this->name = new Name('Heard Island and McDonald Islands', 'Islas Heard y McDonald', 'Islas Heard y McDonald', 'Heard Island and McDonald Islands');
            $this->zone = new Zone('Antarctica', 'Antarctica', 'Antarctica', 'Antarctica');
        })->call($item98);

        $this->addReference('_reference_ProviderCountry98', $item98);
        $this->sanitizeEntityValues($item98);
        $manager->persist($item98);


        $item99 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("HN");
            $this->setCountryCode("+504");
            $this->name = new Name('Honduras', 'Honduras', 'Honduras', 'Honduras');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item99);

        $this->addReference('_reference_ProviderCountry99', $item99);
        $this->sanitizeEntityValues($item99);
        $manager->persist($item99);


        $item100 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("HR");
            $this->setCountryCode("+385");
            $this->name = new Name('Croatia', 'Croacia', 'Croacia', 'Croatia');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item100);

        $this->addReference('_reference_ProviderCountry100', $item100);
        $this->sanitizeEntityValues($item100);
        $manager->persist($item100);


        $item101 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("HT");
            $this->setCountryCode("+509");
            $this->name = new Name('Haiti', 'Haití', 'Haití', 'Haiti');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item101);

        $this->addReference('_reference_ProviderCountry101', $item101);
        $this->sanitizeEntityValues($item101);
        $manager->persist($item101);


        $item102 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("HU");
            $this->setCountryCode("+36");
            $this->name = new Name('Hungary', 'Hungría', 'Hungría', 'Hungary');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item102);

        $this->addReference('_reference_ProviderCountry102', $item102);
        $this->sanitizeEntityValues($item102);
        $manager->persist($item102);


        $item103 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("ID");
            $this->setCountryCode("+62");
            $this->name = new Name('Indonesia', 'Indonesia', 'Indonesia', 'Indonesia');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item103);

        $this->addReference('_reference_ProviderCountry103', $item103);
        $this->sanitizeEntityValues($item103);
        $manager->persist($item103);


        $item104 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("IE");
            $this->setCountryCode("+353");
            $this->name = new Name('Ireland', 'Irlanda', 'Irlanda', 'Ireland');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item104);

        $this->addReference('_reference_ProviderCountry104', $item104);
        $this->sanitizeEntityValues($item104);
        $manager->persist($item104);


        $item105 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("IL");
            $this->setCountryCode("+972");
            $this->name = new Name('Israel', 'Israel', 'Israel', 'Israel');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item105);

        $this->addReference('_reference_ProviderCountry105', $item105);
        $this->sanitizeEntityValues($item105);
        $manager->persist($item105);


        $item106 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("IM");
            $this->setCountryCode("+44");
            $this->name = new Name('Isle of Man', 'Isla de Man', 'Isla de Man', 'Isle of Man');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item106);

        $this->addReference('_reference_ProviderCountry106', $item106);
        $this->sanitizeEntityValues($item106);
        $manager->persist($item106);


        $item107 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("IN");
            $this->setCountryCode("+91");
            $this->name = new Name('India', 'India', 'India', 'India');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item107);

        $this->addReference('_reference_ProviderCountry107', $item107);
        $this->sanitizeEntityValues($item107);
        $manager->persist($item107);


        $item108 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("IO");
            $this->setCountryCode("+246");
            $this->name = new Name('British Indian Ocean Territory', 'Territorio Británico del Océano Índico', 'Territorio Británico del Océano Índico', 'British Indian Ocean Territory');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item108);

        $this->addReference('_reference_ProviderCountry108', $item108);
        $this->sanitizeEntityValues($item108);
        $manager->persist($item108);


        $item109 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("IQ");
            $this->setCountryCode("+964");
            $this->name = new Name('Iraq', 'Irak', 'Irak', 'Iraq');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item109);

        $this->addReference('_reference_ProviderCountry109', $item109);
        $this->sanitizeEntityValues($item109);
        $manager->persist($item109);


        $item110 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("IR");
            $this->setCountryCode("+98");
            $this->name = new Name('Iran', 'Irán', 'Irán', 'Iran');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item110);

        $this->addReference('_reference_ProviderCountry110', $item110);
        $this->sanitizeEntityValues($item110);
        $manager->persist($item110);


        $item111 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("IS");
            $this->setCountryCode("+354");
            $this->name = new Name('Iceland', 'Islandia', 'Islandia', 'Iceland');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item111);

        $this->addReference('_reference_ProviderCountry111', $item111);
        $this->sanitizeEntityValues($item111);
        $manager->persist($item111);


        $item112 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("IT");
            $this->setCountryCode("+39");
            $this->name = new Name('Italy', 'Italia', 'Italia', 'Italy');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item112);

        $this->addReference('_reference_ProviderCountry112', $item112);
        $this->sanitizeEntityValues($item112);
        $manager->persist($item112);


        $item113 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("JE");
            $this->setCountryCode("+44");
            $this->name = new Name('Jersey', 'Jersey', 'Jersey', 'Jersey');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item113);

        $this->addReference('_reference_ProviderCountry113', $item113);
        $this->sanitizeEntityValues($item113);
        $manager->persist($item113);


        $item114 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("JM");
            $this->setCountryCode("+1876");
            $this->name = new Name('Jamaica', 'Jamaica', 'Jamaica', 'Jamaica');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item114);

        $this->addReference('_reference_ProviderCountry114', $item114);
        $this->sanitizeEntityValues($item114);
        $manager->persist($item114);


        $item115 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("JO");
            $this->setCountryCode("+962");
            $this->name = new Name('Jordan', 'Jordania', 'Jordania', 'Jordan');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item115);

        $this->addReference('_reference_ProviderCountry115', $item115);
        $this->sanitizeEntityValues($item115);
        $manager->persist($item115);


        $item116 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("JP");
            $this->setCountryCode("+81");
            $this->name = new Name('Japan', 'Japón', 'Japón', 'Japan');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item116);

        $this->addReference('_reference_ProviderCountry116', $item116);
        $this->sanitizeEntityValues($item116);
        $manager->persist($item116);


        $item117 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("KE");
            $this->setCountryCode("+254");
            $this->name = new Name('Kenya', 'Kenia', 'Kenia', 'Kenya');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item117);

        $this->addReference('_reference_ProviderCountry117', $item117);
        $this->sanitizeEntityValues($item117);
        $manager->persist($item117);


        $item118 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("KG");
            $this->setCountryCode("+996");
            $this->name = new Name('Kyrgyzstan', 'Kirgizstán', 'Kirgizstán', 'Kyrgyzstan');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item118);

        $this->addReference('_reference_ProviderCountry118', $item118);
        $this->sanitizeEntityValues($item118);
        $manager->persist($item118);


        $item119 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("KH");
            $this->setCountryCode("+855");
            $this->name = new Name('Cambodia', 'Camboya', 'Camboya', 'Cambodia');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item119);

        $this->addReference('_reference_ProviderCountry119', $item119);
        $this->sanitizeEntityValues($item119);
        $manager->persist($item119);


        $item120 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("KI");
            $this->setCountryCode("+686");
            $this->name = new Name('Kiribati', 'Kiribati', 'Kiribati', 'Kiribati');
            $this->zone = new Zone('Oceania', 'Oceania', 'Oceania', 'Oceania');
        })->call($item120);

        $this->addReference('_reference_ProviderCountry120', $item120);
        $this->sanitizeEntityValues($item120);
        $manager->persist($item120);


        $item121 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("KM");
            $this->setCountryCode("+269");
            $this->name = new Name('Comoros', 'Comoras', 'Comoras', 'Comoros');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item121);

        $this->addReference('_reference_ProviderCountry121', $item121);
        $this->sanitizeEntityValues($item121);
        $manager->persist($item121);


        $item122 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("KN");
            $this->setCountryCode("+1869");
            $this->name = new Name('Saint Kitts and Nevis', 'San Cristóbal y Nieves', 'San Cristóbal y Nieves', 'Saint Kitts and Nevis');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item122);

        $this->addReference('_reference_ProviderCountry122', $item122);
        $this->sanitizeEntityValues($item122);
        $manager->persist($item122);


        $item123 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("KP");
            $this->setCountryCode("+850");
            $this->name = new Name('North Korea', 'Corea del Norte', 'Corea del Norte', 'North Korea');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item123);

        $this->addReference('_reference_ProviderCountry123', $item123);
        $this->sanitizeEntityValues($item123);
        $manager->persist($item123);


        $item124 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("KR");
            $this->setCountryCode("+82");
            $this->name = new Name('South Korea', 'Corea del Sur', 'Corea del Sur', 'South Korea');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item124);

        $this->addReference('_reference_ProviderCountry124', $item124);
        $this->sanitizeEntityValues($item124);
        $manager->persist($item124);


        $item125 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("KW");
            $this->setCountryCode("+965");
            $this->name = new Name('Kuwait', 'Kuwait', 'Kuwait', 'Kuwait');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item125);

        $this->addReference('_reference_ProviderCountry125', $item125);
        $this->sanitizeEntityValues($item125);
        $manager->persist($item125);


        $item126 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("KY");
            $this->setCountryCode("+1345");
            $this->name = new Name('Cayman Islands', 'Islas Caimán', 'Islas Caimán', 'Cayman Islands');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item126);

        $this->addReference('_reference_ProviderCountry126', $item126);
        $this->sanitizeEntityValues($item126);
        $manager->persist($item126);


        $item127 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("KZ");
            $this->setCountryCode("+7");
            $this->name = new Name('Kazakhstan', 'Kazajistán', 'Kazajistán', 'Kazakhstan');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item127);

        $this->addReference('_reference_ProviderCountry127', $item127);
        $this->sanitizeEntityValues($item127);
        $manager->persist($item127);


        $item128 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("LA");
            $this->setCountryCode("+856");
            $this->name = new Name('Laos', 'Laos', 'Laos', 'Laos');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item128);

        $this->addReference('_reference_ProviderCountry128', $item128);
        $this->sanitizeEntityValues($item128);
        $manager->persist($item128);


        $item129 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("LB");
            $this->setCountryCode("+961");
            $this->name = new Name('Lebanon', 'Líbano', 'Líbano', 'Lebanon');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item129);

        $this->addReference('_reference_ProviderCountry129', $item129);
        $this->sanitizeEntityValues($item129);
        $manager->persist($item129);


        $item130 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("LC");
            $this->setCountryCode("+1758");
            $this->name = new Name('Saint Lucia', 'Santa Lucía', 'Santa Lucía', 'Saint Lucia');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item130);

        $this->addReference('_reference_ProviderCountry130', $item130);
        $this->sanitizeEntityValues($item130);
        $manager->persist($item130);


        $item131 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("LI");
            $this->setCountryCode("+423");
            $this->name = new Name('Liechtenstein', 'Liechtenstein', 'Liechtenstein', 'Liechtenstein');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item131);

        $this->addReference('_reference_ProviderCountry131', $item131);
        $this->sanitizeEntityValues($item131);
        $manager->persist($item131);


        $item132 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("LK");
            $this->setCountryCode("+94");
            $this->name = new Name('Sri Lanka', 'Sri lanka', 'Sri lanka', 'Sri Lanka');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item132);

        $this->addReference('_reference_ProviderCountry132', $item132);
        $this->sanitizeEntityValues($item132);
        $manager->persist($item132);


        $item133 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("LR");
            $this->setCountryCode("+231");
            $this->name = new Name('Liberia', 'Liberia', 'Liberia', 'Liberia');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item133);

        $this->addReference('_reference_ProviderCountry133', $item133);
        $this->sanitizeEntityValues($item133);
        $manager->persist($item133);


        $item134 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("LS");
            $this->setCountryCode("+266");
            $this->name = new Name('Lesotho', 'Lesoto', 'Lesoto', 'Lesotho');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item134);

        $this->addReference('_reference_ProviderCountry134', $item134);
        $this->sanitizeEntityValues($item134);
        $manager->persist($item134);


        $item135 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("LT");
            $this->setCountryCode("+370");
            $this->name = new Name('Lithuania', 'Lituania', 'Lituania', 'Lithuania');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item135);

        $this->addReference('_reference_ProviderCountry135', $item135);
        $this->sanitizeEntityValues($item135);
        $manager->persist($item135);


        $item136 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("LU");
            $this->setCountryCode("+352");
            $this->name = new Name('Luxembourg', 'Luxemburgo', 'Luxemburgo', 'Luxembourg');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item136);

        $this->addReference('_reference_ProviderCountry136', $item136);
        $this->sanitizeEntityValues($item136);
        $manager->persist($item136);


        $item137 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("LV");
            $this->setCountryCode("+371");
            $this->name = new Name('Latvia', 'Letonia', 'Letonia', 'Latvia');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item137);

        $this->addReference('_reference_ProviderCountry137', $item137);
        $this->sanitizeEntityValues($item137);
        $manager->persist($item137);


        $item138 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("LY");
            $this->setCountryCode("+218");
            $this->name = new Name('Libya', 'Libia', 'Libia', 'Libya');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item138);

        $this->addReference('_reference_ProviderCountry138', $item138);
        $this->sanitizeEntityValues($item138);
        $manager->persist($item138);


        $item139 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("MA");
            $this->setCountryCode("+212");
            $this->name = new Name('Morocco', 'Marruecos', 'Marruecos', 'Morocco');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item139);

        $this->addReference('_reference_ProviderCountry139', $item139);
        $this->sanitizeEntityValues($item139);
        $manager->persist($item139);


        $item140 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("MC");
            $this->setCountryCode("+377");
            $this->name = new Name('Monaco', 'Mónaco', 'Mónaco', 'Monaco');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item140);

        $this->addReference('_reference_ProviderCountry140', $item140);
        $this->sanitizeEntityValues($item140);
        $manager->persist($item140);


        $item141 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("MD");
            $this->setCountryCode("+373");
            $this->name = new Name('Moldova', 'Moldavia', 'Moldavia', 'Moldova');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item141);

        $this->addReference('_reference_ProviderCountry141', $item141);
        $this->sanitizeEntityValues($item141);
        $manager->persist($item141);


        $item142 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("ME");
            $this->setCountryCode("+382");
            $this->name = new Name('Montenegro', 'Montenegro', 'Montenegro', 'Montenegro');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item142);

        $this->addReference('_reference_ProviderCountry142', $item142);
        $this->sanitizeEntityValues($item142);
        $manager->persist($item142);


        $item143 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("MF");
            $this->setCountryCode("+1599");
            $this->name = new Name('Saint Martin (French part)', 'San Martín (Francia)', 'San Martín (Francia)', 'Saint Martin (French part)');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item143);

        $this->addReference('_reference_ProviderCountry143', $item143);
        $this->sanitizeEntityValues($item143);
        $manager->persist($item143);


        $item144 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("MG");
            $this->setCountryCode("+261");
            $this->name = new Name('Madagascar', 'Madagascar', 'Madagascar', 'Madagascar');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item144);

        $this->addReference('_reference_ProviderCountry144', $item144);
        $this->sanitizeEntityValues($item144);
        $manager->persist($item144);


        $item145 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("MH");
            $this->setCountryCode("+692");
            $this->name = new Name('Marshall Islands', 'Islas Marshall', 'Islas Marshall', 'Marshall Islands');
            $this->zone = new Zone('Oceania', 'Oceania', 'Oceania', 'Oceania');
        })->call($item145);

        $this->addReference('_reference_ProviderCountry145', $item145);
        $this->sanitizeEntityValues($item145);
        $manager->persist($item145);


        $item146 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("MK");
            $this->setCountryCode("+389");
            $this->name = new Name('Macedonia', 'Macedônia', 'Macedônia', 'Macedonia');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item146);

        $this->addReference('_reference_ProviderCountry146', $item146);
        $this->sanitizeEntityValues($item146);
        $manager->persist($item146);


        $item147 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("ML");
            $this->setCountryCode("+223");
            $this->name = new Name('Mali', 'Mali', 'Mali', 'Mali');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item147);

        $this->addReference('_reference_ProviderCountry147', $item147);
        $this->sanitizeEntityValues($item147);
        $manager->persist($item147);


        $item148 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("MM");
            $this->setCountryCode("+95");
            $this->name = new Name('Myanmar', 'Birmania', 'Birmania', 'Myanmar');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item148);

        $this->addReference('_reference_ProviderCountry148', $item148);
        $this->sanitizeEntityValues($item148);
        $manager->persist($item148);


        $item149 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("MN");
            $this->setCountryCode("+976");
            $this->name = new Name('Mongolia', 'Mongolia', 'Mongolia', 'Mongolia');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item149);

        $this->addReference('_reference_ProviderCountry149', $item149);
        $this->sanitizeEntityValues($item149);
        $manager->persist($item149);


        $item150 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("MO");
            $this->setCountryCode("+853");
            $this->name = new Name('Macao', 'Macao', 'Macao', 'Macao');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item150);

        $this->addReference('_reference_ProviderCountry150', $item150);
        $this->sanitizeEntityValues($item150);
        $manager->persist($item150);


        $item151 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("MP");
            $this->setCountryCode("+1670");
            $this->name = new Name('Northern Mariana Islands', 'Islas Marianas del Norte', 'Islas Marianas del Norte', 'Northern Mariana Islands');
            $this->zone = new Zone('Oceania', 'Oceania', 'Oceania', 'Oceania');
        })->call($item151);

        $this->addReference('_reference_ProviderCountry151', $item151);
        $this->sanitizeEntityValues($item151);
        $manager->persist($item151);


        $item152 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("MQ");
            $this->setCountryCode("+596");
            $this->name = new Name('Martinique', 'Martinica', 'Martinica', 'Martinique');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item152);

        $this->addReference('_reference_ProviderCountry152', $item152);
        $this->sanitizeEntityValues($item152);
        $manager->persist($item152);


        $item153 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("MR");
            $this->setCountryCode("+222");
            $this->name = new Name('Mauritania', 'Mauritania', 'Mauritania', 'Mauritania');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item153);

        $this->addReference('_reference_ProviderCountry153', $item153);
        $this->sanitizeEntityValues($item153);
        $manager->persist($item153);


        $item154 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("MS");
            $this->setCountryCode("+1664");
            $this->name = new Name('Montserrat', 'Montserrat', 'Montserrat', 'Montserrat');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item154);

        $this->addReference('_reference_ProviderCountry154', $item154);
        $this->sanitizeEntityValues($item154);
        $manager->persist($item154);


        $item155 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("MT");
            $this->setCountryCode("+356");
            $this->name = new Name('Malta', 'Malta', 'Malta', 'Malta');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item155);

        $this->addReference('_reference_ProviderCountry155', $item155);
        $this->sanitizeEntityValues($item155);
        $manager->persist($item155);


        $item156 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("MU");
            $this->setCountryCode("+230");
            $this->name = new Name('Mauritius', 'Mauricio', 'Mauricio', 'Mauritius');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item156);

        $this->addReference('_reference_ProviderCountry156', $item156);
        $this->sanitizeEntityValues($item156);
        $manager->persist($item156);


        $item157 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("MV");
            $this->setCountryCode("+960");
            $this->name = new Name('Maldives', 'Islas Maldivas', 'Islas Maldivas', 'Maldives');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item157);

        $this->addReference('_reference_ProviderCountry157', $item157);
        $this->sanitizeEntityValues($item157);
        $manager->persist($item157);


        $item158 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("MW");
            $this->setCountryCode("+265");
            $this->name = new Name('Malawi', 'Malawi', 'Malawi', 'Malawi');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item158);

        $this->addReference('_reference_ProviderCountry158', $item158);
        $this->sanitizeEntityValues($item158);
        $manager->persist($item158);


        $item159 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("MX");
            $this->setCountryCode("+52");
            $this->name = new Name('Mexico', 'México', 'México', 'Mexico');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item159);

        $this->addReference('_reference_ProviderCountry159', $item159);
        $this->sanitizeEntityValues($item159);
        $manager->persist($item159);


        $item160 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("MY");
            $this->setCountryCode("+60");
            $this->name = new Name('Malaysia', 'Malasia', 'Malasia', 'Malaysia');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item160);

        $this->addReference('_reference_ProviderCountry160', $item160);
        $this->sanitizeEntityValues($item160);
        $manager->persist($item160);


        $item161 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("MZ");
            $this->setCountryCode("+258");
            $this->name = new Name('Mozambique', 'Mozambique', 'Mozambique', 'Mozambique');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item161);

        $this->addReference('_reference_ProviderCountry161', $item161);
        $this->sanitizeEntityValues($item161);
        $manager->persist($item161);


        $item162 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("NA");
            $this->setCountryCode("+264");
            $this->name = new Name('Namibia', 'Namibia', 'Namibia', 'Namibia');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item162);

        $this->addReference('_reference_ProviderCountry162', $item162);
        $this->sanitizeEntityValues($item162);
        $manager->persist($item162);


        $item163 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("NC");
            $this->setCountryCode("+687");
            $this->name = new Name('New Caledonia', 'Nueva Caledonia', 'Nueva Caledonia', 'New Caledonia');
            $this->zone = new Zone('Oceania', 'Oceania', 'Oceania', 'Oceania');
        })->call($item163);

        $this->addReference('_reference_ProviderCountry163', $item163);
        $this->sanitizeEntityValues($item163);
        $manager->persist($item163);


        $item164 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("NE");
            $this->setCountryCode("+227");
            $this->name = new Name('Niger', 'Niger', 'Niger', 'Niger');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item164);

        $this->addReference('_reference_ProviderCountry164', $item164);
        $this->sanitizeEntityValues($item164);
        $manager->persist($item164);


        $item165 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("NF");
            $this->setCountryCode("+672");
            $this->name = new Name('Norfolk Island', 'Isla Norfolk', 'Isla Norfolk', 'Norfolk Island');
            $this->zone = new Zone('Oceania', 'Oceania', 'Oceania', 'Oceania');
        })->call($item165);

        $this->addReference('_reference_ProviderCountry165', $item165);
        $this->sanitizeEntityValues($item165);
        $manager->persist($item165);


        $item166 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("NG");
            $this->setCountryCode("+234");
            $this->name = new Name('Nigeria', 'Nigeria', 'Nigeria', 'Nigeria');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item166);

        $this->addReference('_reference_ProviderCountry166', $item166);
        $this->sanitizeEntityValues($item166);
        $manager->persist($item166);


        $item167 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("NI");
            $this->setCountryCode("+505");
            $this->name = new Name('Nicaragua', 'Nicaragua', 'Nicaragua', 'Nicaragua');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item167);

        $this->addReference('_reference_ProviderCountry167', $item167);
        $this->sanitizeEntityValues($item167);
        $manager->persist($item167);


        $item168 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("NL");
            $this->setCountryCode("+31");
            $this->name = new Name('Netherlands', 'Países Bajos', 'Países Bajos', 'Netherlands');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item168);

        $this->addReference('_reference_ProviderCountry168', $item168);
        $this->sanitizeEntityValues($item168);
        $manager->persist($item168);


        $item169 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("NO");
            $this->setCountryCode("+47");
            $this->name = new Name('Norway', 'Noruega', 'Noruega', 'Norway');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item169);

        $this->addReference('_reference_ProviderCountry169', $item169);
        $this->sanitizeEntityValues($item169);
        $manager->persist($item169);


        $item170 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("NP");
            $this->setCountryCode("+977");
            $this->name = new Name('Nepal', 'Nepal', 'Nepal', 'Nepal');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item170);

        $this->addReference('_reference_ProviderCountry170', $item170);
        $this->sanitizeEntityValues($item170);
        $manager->persist($item170);


        $item171 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("NR");
            $this->setCountryCode("+674");
            $this->name = new Name('Nauru', 'Nauru', 'Nauru', 'Nauru');
            $this->zone = new Zone('Oceania', 'Oceania', 'Oceania', 'Oceania');
        })->call($item171);

        $this->addReference('_reference_ProviderCountry171', $item171);
        $this->sanitizeEntityValues($item171);
        $manager->persist($item171);


        $item172 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("NU");
            $this->setCountryCode("+683");
            $this->name = new Name('Niue', 'Niue', 'Niue', 'Niue');
            $this->zone = new Zone('Oceania', 'Oceania', 'Oceania', 'Oceania');
        })->call($item172);

        $this->addReference('_reference_ProviderCountry172', $item172);
        $this->sanitizeEntityValues($item172);
        $manager->persist($item172);


        $item173 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("NZ");
            $this->setCountryCode("+64");
            $this->name = new Name('New Zealand', 'Nueva Zelanda', 'Nueva Zelanda', 'New Zealand');
            $this->zone = new Zone('Oceania', 'Oceania', 'Oceania', 'Oceania');
        })->call($item173);

        $this->addReference('_reference_ProviderCountry173', $item173);
        $this->sanitizeEntityValues($item173);
        $manager->persist($item173);


        $item174 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("OM");
            $this->setCountryCode("+968");
            $this->name = new Name('Oman', 'Omán', 'Omán', 'Oman');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item174);

        $this->addReference('_reference_ProviderCountry174', $item174);
        $this->sanitizeEntityValues($item174);
        $manager->persist($item174);


        $item175 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("PA");
            $this->setCountryCode("+507");
            $this->name = new Name('Panama', 'Panamá', 'Panamá', 'Panama');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item175);

        $this->addReference('_reference_ProviderCountry175', $item175);
        $this->sanitizeEntityValues($item175);
        $manager->persist($item175);


        $item176 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("PE");
            $this->setCountryCode("+51");
            $this->name = new Name('Peru', 'Perú', 'Perú', 'Peru');
            $this->zone = new Zone('South america', 'South america', 'South america', 'South america');
        })->call($item176);

        $this->addReference('_reference_ProviderCountry176', $item176);
        $this->sanitizeEntityValues($item176);
        $manager->persist($item176);


        $item177 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("PF");
            $this->setCountryCode("+689");
            $this->name = new Name('French Polynesia', 'Polinesia Francesa', 'Polinesia Francesa', 'French Polynesia');
            $this->zone = new Zone('Oceania', 'Oceania', 'Oceania', 'Oceania');
        })->call($item177);

        $this->addReference('_reference_ProviderCountry177', $item177);
        $this->sanitizeEntityValues($item177);
        $manager->persist($item177);


        $item178 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("PG");
            $this->setCountryCode("+675");
            $this->name = new Name('Papua New Guinea', 'Papúa Nueva Guinea', 'Papúa Nueva Guinea', 'Papua New Guinea');
            $this->zone = new Zone('Oceania', 'Oceania', 'Oceania', 'Oceania');
        })->call($item178);

        $this->addReference('_reference_ProviderCountry178', $item178);
        $this->sanitizeEntityValues($item178);
        $manager->persist($item178);


        $item179 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("PH");
            $this->setCountryCode("+63");
            $this->name = new Name('Philippines', 'Filipinas', 'Filipinas', 'Philippines');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item179);

        $this->addReference('_reference_ProviderCountry179', $item179);
        $this->sanitizeEntityValues($item179);
        $manager->persist($item179);


        $item180 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("PK");
            $this->setCountryCode("+92");
            $this->name = new Name('Pakistan', 'Pakistán', 'Pakistán', 'Pakistan');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item180);

        $this->addReference('_reference_ProviderCountry180', $item180);
        $this->sanitizeEntityValues($item180);
        $manager->persist($item180);


        $item181 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("PL");
            $this->setCountryCode("+48");
            $this->name = new Name('Poland', 'Polonia', 'Polonia', 'Poland');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item181);

        $this->addReference('_reference_ProviderCountry181', $item181);
        $this->sanitizeEntityValues($item181);
        $manager->persist($item181);


        $item182 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("PM");
            $this->setCountryCode("+508");
            $this->name = new Name('Saint Pierre and Miquelon', 'San Pedro y Miquelón', 'San Pedro y Miquelón', 'Saint Pierre and Miquelon');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item182);

        $this->addReference('_reference_ProviderCountry182', $item182);
        $this->sanitizeEntityValues($item182);
        $manager->persist($item182);


        $item183 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("PN");
            $this->setCountryCode("+870");
            $this->name = new Name('Pitcairn Islands', 'Islas Pitcairn', 'Islas Pitcairn', 'Pitcairn Islands');
            $this->zone = new Zone('Oceania', 'Oceania', 'Oceania', 'Oceania');
        })->call($item183);

        $this->addReference('_reference_ProviderCountry183', $item183);
        $this->sanitizeEntityValues($item183);
        $manager->persist($item183);


        $item184 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("PR");
            $this->setCountryCode("+1");
            $this->name = new Name('Puerto Rico', 'Puerto Rico', 'Puerto Rico', 'Puerto Rico');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item184);

        $this->addReference('_reference_ProviderCountry184', $item184);
        $this->sanitizeEntityValues($item184);
        $manager->persist($item184);


        $item185 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("PS");
            $this->setCountryCode("+970");
            $this->name = new Name('Palestine', 'Palestina', 'Palestina', 'Palestine');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item185);

        $this->addReference('_reference_ProviderCountry185', $item185);
        $this->sanitizeEntityValues($item185);
        $manager->persist($item185);


        $item186 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("PT");
            $this->setCountryCode("+351");
            $this->name = new Name('Portugal', 'Portugal', 'Portugal', 'Portugal');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item186);

        $this->addReference('_reference_ProviderCountry186', $item186);
        $this->sanitizeEntityValues($item186);
        $manager->persist($item186);


        $item187 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("PW");
            $this->setCountryCode("+680");
            $this->name = new Name('Palau', 'Palau', 'Palau', 'Palau');
            $this->zone = new Zone('Oceania', 'Oceania', 'Oceania', 'Oceania');
        })->call($item187);

        $this->addReference('_reference_ProviderCountry187', $item187);
        $this->sanitizeEntityValues($item187);
        $manager->persist($item187);


        $item188 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("PY");
            $this->setCountryCode("+595");
            $this->name = new Name('Paraguay', 'Paraguay', 'Paraguay', 'Paraguay');
            $this->zone = new Zone('South america', 'South america', 'South america', 'South america');
        })->call($item188);

        $this->addReference('_reference_ProviderCountry188', $item188);
        $this->sanitizeEntityValues($item188);
        $manager->persist($item188);


        $item189 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("QA");
            $this->setCountryCode("+974");
            $this->name = new Name('Qatar', 'Qatar', 'Qatar', 'Qatar');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item189);

        $this->addReference('_reference_ProviderCountry189', $item189);
        $this->sanitizeEntityValues($item189);
        $manager->persist($item189);


        $item190 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("RE");
            $this->setCountryCode("+262");
            $this->name = new Name('Réunion', 'Reunión', 'Reunión', 'Réunion');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item190);

        $this->addReference('_reference_ProviderCountry190', $item190);
        $this->sanitizeEntityValues($item190);
        $manager->persist($item190);


        $item191 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("RO");
            $this->setCountryCode("+40");
            $this->name = new Name('Romania', 'Rumanía', 'Rumanía', 'Romania');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item191);

        $this->addReference('_reference_ProviderCountry191', $item191);
        $this->sanitizeEntityValues($item191);
        $manager->persist($item191);


        $item192 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("RS");
            $this->setCountryCode("+381");
            $this->name = new Name('Serbia', 'Serbia', 'Serbia', 'Serbia');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item192);

        $this->addReference('_reference_ProviderCountry192', $item192);
        $this->sanitizeEntityValues($item192);
        $manager->persist($item192);


        $item193 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("RU");
            $this->setCountryCode("+7");
            $this->name = new Name('Russia', 'Rusia', 'Rusia', 'Russia');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item193);

        $this->addReference('_reference_ProviderCountry193', $item193);
        $this->sanitizeEntityValues($item193);
        $manager->persist($item193);


        $item194 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("RW");
            $this->setCountryCode("+250");
            $this->name = new Name('Rwanda', 'Ruanda', 'Ruanda', 'Rwanda');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item194);

        $this->addReference('_reference_ProviderCountry194', $item194);
        $this->sanitizeEntityValues($item194);
        $manager->persist($item194);


        $item195 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("SA");
            $this->setCountryCode("+966");
            $this->name = new Name('Saudi Arabia', 'Arabia Saudita', 'Arabia Saudita', 'Saudi Arabia');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item195);

        $this->addReference('_reference_ProviderCountry195', $item195);
        $this->sanitizeEntityValues($item195);
        $manager->persist($item195);


        $item196 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("SB");
            $this->setCountryCode("+677");
            $this->name = new Name('Solomon Islands', 'Islas Salomón', 'Islas Salomón', 'Solomon Islands');
            $this->zone = new Zone('Oceania', 'Oceania', 'Oceania', 'Oceania');
        })->call($item196);

        $this->addReference('_reference_ProviderCountry196', $item196);
        $this->sanitizeEntityValues($item196);
        $manager->persist($item196);


        $item197 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("SC");
            $this->setCountryCode("+248");
            $this->name = new Name('Seychelles', 'Seychelles', 'Seychelles', 'Seychelles');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item197);

        $this->addReference('_reference_ProviderCountry197', $item197);
        $this->sanitizeEntityValues($item197);
        $manager->persist($item197);


        $item198 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("SD");
            $this->setCountryCode("+249");
            $this->name = new Name('Sudan', 'Sudán', 'Sudán', 'Sudan');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item198);

        $this->addReference('_reference_ProviderCountry198', $item198);
        $this->sanitizeEntityValues($item198);
        $manager->persist($item198);


        $item199 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("SE");
            $this->setCountryCode("+46");
            $this->name = new Name('Sweden', 'Suecia', 'Suecia', 'Sweden');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item199);

        $this->addReference('_reference_ProviderCountry199', $item199);
        $this->sanitizeEntityValues($item199);
        $manager->persist($item199);


        $item200 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("SG");
            $this->setCountryCode("+65");
            $this->name = new Name('Singapore', 'Singapur', 'Singapur', 'Singapore');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item200);

        $this->addReference('_reference_ProviderCountry200', $item200);
        $this->sanitizeEntityValues($item200);
        $manager->persist($item200);


        $item201 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("SH");
            $this->setCountryCode("+290");
            $this->name = new Name('Ascensión y Tristán de Acuña', 'Santa Elena', 'Santa Elena', 'Ascensión y Tristán de Acuña');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item201);

        $this->addReference('_reference_ProviderCountry201', $item201);
        $this->sanitizeEntityValues($item201);
        $manager->persist($item201);


        $item202 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("SI");
            $this->setCountryCode("+386");
            $this->name = new Name('Slovenia', 'Eslovenia', 'Eslovenia', 'Slovenia');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item202);

        $this->addReference('_reference_ProviderCountry202', $item202);
        $this->sanitizeEntityValues($item202);
        $manager->persist($item202);


        $item203 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("SJ");
            $this->setCountryCode("+47");
            $this->name = new Name('Svalbard and Jan Mayen', 'Svalbard y Jan Mayen', 'Svalbard y Jan Mayen', 'Svalbard and Jan Mayen');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item203);

        $this->addReference('_reference_ProviderCountry203', $item203);
        $this->sanitizeEntityValues($item203);
        $manager->persist($item203);


        $item204 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("SK");
            $this->setCountryCode("+421");
            $this->name = new Name('Slovakia', 'Eslovaquia', 'Eslovaquia', 'Slovakia');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item204);

        $this->addReference('_reference_ProviderCountry204', $item204);
        $this->sanitizeEntityValues($item204);
        $manager->persist($item204);


        $item205 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("SL");
            $this->setCountryCode("+232");
            $this->name = new Name('Sierra Leone', 'Sierra Leona', 'Sierra Leona', 'Sierra Leone');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item205);

        $this->addReference('_reference_ProviderCountry205', $item205);
        $this->sanitizeEntityValues($item205);
        $manager->persist($item205);


        $item206 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("SM");
            $this->setCountryCode("+378");
            $this->name = new Name('San Marino', 'San Marino', 'San Marino', 'San Marino');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item206);

        $this->addReference('_reference_ProviderCountry206', $item206);
        $this->sanitizeEntityValues($item206);
        $manager->persist($item206);


        $item207 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("SN");
            $this->setCountryCode("+221");
            $this->name = new Name('Senegal', 'Senegal', 'Senegal', 'Senegal');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item207);

        $this->addReference('_reference_ProviderCountry207', $item207);
        $this->sanitizeEntityValues($item207);
        $manager->persist($item207);


        $item208 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("SO");
            $this->setCountryCode("+252");
            $this->name = new Name('Somalia', 'Somalia', 'Somalia', 'Somalia');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item208);

        $this->addReference('_reference_ProviderCountry208', $item208);
        $this->sanitizeEntityValues($item208);
        $manager->persist($item208);


        $item209 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("SR");
            $this->setCountryCode("+597");
            $this->name = new Name('Suriname', 'Surinám', 'Surinám', 'Suriname');
            $this->zone = new Zone('South america', 'South america', 'South america', 'South america');
        })->call($item209);

        $this->addReference('_reference_ProviderCountry209', $item209);
        $this->sanitizeEntityValues($item209);
        $manager->persist($item209);


        $item210 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("SS");
            $this->setCountryCode("+211");
            $this->name = new Name('South Sudan', 'Sudán del Sur', 'Sudán del Sur', 'South Sudan');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item210);

        $this->addReference('_reference_ProviderCountry210', $item210);
        $this->sanitizeEntityValues($item210);
        $manager->persist($item210);


        $item211 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("ST");
            $this->setCountryCode("+239");
            $this->name = new Name('Sao Tome and Principe', 'Santo Tomé y Príncipe', 'Santo Tomé y Príncipe', 'Sao Tome and Principe');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item211);

        $this->addReference('_reference_ProviderCountry211', $item211);
        $this->sanitizeEntityValues($item211);
        $manager->persist($item211);


        $item212 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("SV");
            $this->setCountryCode("+503");
            $this->name = new Name('El Salvador', 'El Salvador', 'El Salvador', 'El Salvador');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item212);

        $this->addReference('_reference_ProviderCountry212', $item212);
        $this->sanitizeEntityValues($item212);
        $manager->persist($item212);


        $item213 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("SX");
            $this->setCountryCode("+1721");
            $this->name = new Name('Sint Maarten (Dutch part)', 'Sint Maarten (parte neerlandesa)', 'Sint Maarten (parte neerlandesa)', 'Sint Maarten (Dutch part)');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item213);

        $this->addReference('_reference_ProviderCountry213', $item213);
        $this->sanitizeEntityValues($item213);
        $manager->persist($item213);


        $item214 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("SY");
            $this->setCountryCode("+963");
            $this->name = new Name('Syria', 'Siria', 'Siria', 'Syria');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item214);

        $this->addReference('_reference_ProviderCountry214', $item214);
        $this->sanitizeEntityValues($item214);
        $manager->persist($item214);


        $item215 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("SZ");
            $this->setCountryCode("+268");
            $this->name = new Name('Swaziland', 'Swazilandia', 'Swazilandia', 'Swaziland');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item215);

        $this->addReference('_reference_ProviderCountry215', $item215);
        $this->sanitizeEntityValues($item215);
        $manager->persist($item215);


        $item216 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("TC");
            $this->setCountryCode("+1649");
            $this->name = new Name('Turks and Caicos Islands', 'Islas Turcas y Caicos', 'Islas Turcas y Caicos', 'Turks and Caicos Islands');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item216);

        $this->addReference('_reference_ProviderCountry216', $item216);
        $this->sanitizeEntityValues($item216);
        $manager->persist($item216);


        $item217 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("TD");
            $this->setCountryCode("+235");
            $this->name = new Name('Chad', 'Chad', 'Chad', 'Chad');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item217);

        $this->addReference('_reference_ProviderCountry217', $item217);
        $this->sanitizeEntityValues($item217);
        $manager->persist($item217);


        $item218 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("TF");
            $this->setCountryCode("+262");
            $this->name = new Name('French Southern Territories', 'Territorios Australes y Antárticas Franceses', 'Territorios Australes y Antárticas Franceses', 'French Southern Territories');
            $this->zone = new Zone('Antarctica', 'Antarctica', 'Antarctica', 'Antarctica');
        })->call($item218);

        $this->addReference('_reference_ProviderCountry218', $item218);
        $this->sanitizeEntityValues($item218);
        $manager->persist($item218);


        $item219 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("TG");
            $this->setCountryCode("+228");
            $this->name = new Name('Togo', 'Togo', 'Togo', 'Togo');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item219);

        $this->addReference('_reference_ProviderCountry219', $item219);
        $this->sanitizeEntityValues($item219);
        $manager->persist($item219);


        $item220 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("TH");
            $this->setCountryCode("+66");
            $this->name = new Name('Thailand', 'Tailandia', 'Tailandia', 'Thailand');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item220);

        $this->addReference('_reference_ProviderCountry220', $item220);
        $this->sanitizeEntityValues($item220);
        $manager->persist($item220);


        $item221 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("TJ");
            $this->setCountryCode("+992");
            $this->name = new Name('Tajikistan', 'Tadjikistán', 'Tadjikistán', 'Tajikistan');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item221);

        $this->addReference('_reference_ProviderCountry221', $item221);
        $this->sanitizeEntityValues($item221);
        $manager->persist($item221);


        $item222 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("TK");
            $this->setCountryCode("+690");
            $this->name = new Name('Tokelau', 'Tokelau', 'Tokelau', 'Tokelau');
            $this->zone = new Zone('Oceania', 'Oceania', 'Oceania', 'Oceania');
        })->call($item222);

        $this->addReference('_reference_ProviderCountry222', $item222);
        $this->sanitizeEntityValues($item222);
        $manager->persist($item222);


        $item223 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("TL");
            $this->setCountryCode("+670");
            $this->name = new Name('East Timor', 'Timor Oriental', 'Timor Oriental', 'East Timor');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item223);

        $this->addReference('_reference_ProviderCountry223', $item223);
        $this->sanitizeEntityValues($item223);
        $manager->persist($item223);


        $item224 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("TM");
            $this->setCountryCode("+993");
            $this->name = new Name('Turkmenistan', 'Turkmenistán', 'Turkmenistán', 'Turkmenistan');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item224);

        $this->addReference('_reference_ProviderCountry224', $item224);
        $this->sanitizeEntityValues($item224);
        $manager->persist($item224);


        $item225 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("TN");
            $this->setCountryCode("+216");
            $this->name = new Name('Tunisia', 'Tunez', 'Tunez', 'Tunisia');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item225);

        $this->addReference('_reference_ProviderCountry225', $item225);
        $this->sanitizeEntityValues($item225);
        $manager->persist($item225);


        $item226 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("TO");
            $this->setCountryCode("+676");
            $this->name = new Name('Tonga', 'Tonga', 'Tonga', 'Tonga');
            $this->zone = new Zone('Oceania', 'Oceania', 'Oceania', 'Oceania');
        })->call($item226);

        $this->addReference('_reference_ProviderCountry226', $item226);
        $this->sanitizeEntityValues($item226);
        $manager->persist($item226);


        $item227 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("TR");
            $this->setCountryCode("+90");
            $this->name = new Name('Turkey', 'Turquía', 'Turquía', 'Turkey');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item227);

        $this->addReference('_reference_ProviderCountry227', $item227);
        $this->sanitizeEntityValues($item227);
        $manager->persist($item227);


        $item228 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("TT");
            $this->setCountryCode("+1868");
            $this->name = new Name('Trinidad and Tobago', 'Trinidad y Tobago', 'Trinidad y Tobago', 'Trinidad and Tobago');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item228);

        $this->addReference('_reference_ProviderCountry228', $item228);
        $this->sanitizeEntityValues($item228);
        $manager->persist($item228);


        $item229 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("TV");
            $this->setCountryCode("+688");
            $this->name = new Name('Tuvalu', 'Tuvalu', 'Tuvalu', 'Tuvalu');
            $this->zone = new Zone('Oceania', 'Oceania', 'Oceania', 'Oceania');
        })->call($item229);

        $this->addReference('_reference_ProviderCountry229', $item229);
        $this->sanitizeEntityValues($item229);
        $manager->persist($item229);


        $item230 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("TW");
            $this->setCountryCode("+886");
            $this->name = new Name('Taiwan', 'Taiwán', 'Taiwán', 'Taiwan');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item230);

        $this->addReference('_reference_ProviderCountry230', $item230);
        $this->sanitizeEntityValues($item230);
        $manager->persist($item230);


        $item231 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("TZ");
            $this->setCountryCode("+255");
            $this->name = new Name('Tanzania', 'Tanzania', 'Tanzania', 'Tanzania');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item231);

        $this->addReference('_reference_ProviderCountry231', $item231);
        $this->sanitizeEntityValues($item231);
        $manager->persist($item231);


        $item232 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("UA");
            $this->setCountryCode("+380");
            $this->name = new Name('Ukraine', 'Ucrania', 'Ucrania', 'Ukraine');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item232);

        $this->addReference('_reference_ProviderCountry232', $item232);
        $this->sanitizeEntityValues($item232);
        $manager->persist($item232);


        $item233 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("UG");
            $this->setCountryCode("+256");
            $this->name = new Name('Uganda', 'Uganda', 'Uganda', 'Uganda');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item233);

        $this->addReference('_reference_ProviderCountry233', $item233);
        $this->sanitizeEntityValues($item233);
        $manager->persist($item233);


        $item234 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("UM");
            $this->setCountryCode("+1");
            $this->name = new Name('United States Minor Outlying Islands', 'Islas Ultramarinas Menores de Estados Unidos', 'Islas Ultramarinas Menores de Estados Unidos', 'United States Minor Outlying Islands');
            $this->zone = new Zone('Oceania', 'Oceania', 'Oceania', 'Oceania');
        })->call($item234);

        $this->addReference('_reference_ProviderCountry234', $item234);
        $this->sanitizeEntityValues($item234);
        $manager->persist($item234);


        $item235 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("US");
            $this->setCountryCode("+1");
            $this->name = new Name('United States of America', 'Estados Unidos de América', 'Estados Unidos de América', 'United States of America');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item235);

        $this->addReference('_reference_ProviderCountry235', $item235);
        $this->sanitizeEntityValues($item235);
        $manager->persist($item235);


        $item236 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("UY");
            $this->setCountryCode("+598");
            $this->name = new Name('Uruguay', 'Uruguay', 'Uruguay', 'Uruguay');
            $this->zone = new Zone('South america', 'South america', 'South america', 'South america');
        })->call($item236);

        $this->addReference('_reference_ProviderCountry236', $item236);
        $this->sanitizeEntityValues($item236);
        $manager->persist($item236);


        $item237 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("UZ");
            $this->setCountryCode("+998");
            $this->name = new Name('Uzbekistan', 'Uzbekistán', 'Uzbekistán', 'Uzbekistan');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item237);

        $this->addReference('_reference_ProviderCountry237', $item237);
        $this->sanitizeEntityValues($item237);
        $manager->persist($item237);


        $item238 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("VA");
            $this->setCountryCode("+39");
            $this->name = new Name('Vatican City State', 'Ciudad del Vaticano', 'Ciudad del Vaticano', 'Vatican City State');
            $this->zone = new Zone('Europe', 'Europa', 'Europa', 'Europe');
        })->call($item238);

        $this->addReference('_reference_ProviderCountry238', $item238);
        $this->sanitizeEntityValues($item238);
        $manager->persist($item238);


        $item239 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("VC");
            $this->setCountryCode("+1784");
            $this->name = new Name('Saint Vincent and the Grenadines', 'San Vicente y las Granadinas', 'San Vicente y las Granadinas', 'Saint Vincent and the Grenadines');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item239);

        $this->addReference('_reference_ProviderCountry239', $item239);
        $this->sanitizeEntityValues($item239);
        $manager->persist($item239);


        $item240 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("VE");
            $this->setCountryCode("+58");
            $this->name = new Name('Venezuela', 'Venezuela', 'Venezuela', 'Venezuela');
            $this->zone = new Zone('South america', 'South america', 'South america', 'South america');
        })->call($item240);

        $this->addReference('_reference_ProviderCountry240', $item240);
        $this->sanitizeEntityValues($item240);
        $manager->persist($item240);


        $item241 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("VG");
            $this->setCountryCode("+1284");
            $this->name = new Name('Virgin Islands', 'Islas Vírgenes Británicas', 'Islas Vírgenes Británicas', 'Virgin Islands');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item241);

        $this->addReference('_reference_ProviderCountry241', $item241);
        $this->sanitizeEntityValues($item241);
        $manager->persist($item241);


        $item242 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("VI");
            $this->setCountryCode("+1340");
            $this->name = new Name('United States Virgin Islands', 'Islas Vírgenes de los Estados Unidos', 'Islas Vírgenes de los Estados Unidos', 'United States Virgin Islands');
            $this->zone = new Zone('North america', 'North america', 'North america', 'North america');
        })->call($item242);

        $this->addReference('_reference_ProviderCountry242', $item242);
        $this->sanitizeEntityValues($item242);
        $manager->persist($item242);


        $item243 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("VN");
            $this->setCountryCode("+84");
            $this->name = new Name('Vietnam', 'Vietnam', 'Vietnam', 'Vietnam');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item243);

        $this->addReference('_reference_ProviderCountry243', $item243);
        $this->sanitizeEntityValues($item243);
        $manager->persist($item243);


        $item244 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("VU");
            $this->setCountryCode("+678");
            $this->name = new Name('Vanuatu', 'Vanuatu', 'Vanuatu', 'Vanuatu');
            $this->zone = new Zone('Oceania', 'Oceania', 'Oceania', 'Oceania');
        })->call($item244);

        $this->addReference('_reference_ProviderCountry244', $item244);
        $this->sanitizeEntityValues($item244);
        $manager->persist($item244);


        $item245 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("WF");
            $this->setCountryCode("+681");
            $this->name = new Name('Wallis and Futuna', 'Wallis y Futuna', 'Wallis y Futuna', 'Wallis and Futuna');
            $this->zone = new Zone('Oceania', 'Oceania', 'Oceania', 'Oceania');
        })->call($item245);

        $this->addReference('_reference_ProviderCountry245', $item245);
        $this->sanitizeEntityValues($item245);
        $manager->persist($item245);


        $item246 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("WS");
            $this->setCountryCode("+685");
            $this->name = new Name('Samoa', 'Samoa', 'Samoa', 'Samoa');
            $this->zone = new Zone('Oceania', 'Oceania', 'Oceania', 'Oceania');
        })->call($item246);

        $this->addReference('_reference_ProviderCountry246', $item246);
        $this->sanitizeEntityValues($item246);
        $manager->persist($item246);


        $item247 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("YE");
            $this->setCountryCode("+967");
            $this->name = new Name('Yemen', 'Yemen', 'Yemen', 'Yemen');
            $this->zone = new Zone('Asia', 'Asia', 'Asia', 'Asia');
        })->call($item247);

        $this->addReference('_reference_ProviderCountry247', $item247);
        $this->sanitizeEntityValues($item247);
        $manager->persist($item247);


        $item248 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("YT");
            $this->setCountryCode("+262");
            $this->name = new Name('Mayotte', 'Mayotte', 'Mayotte', 'Mayotte');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item248);

        $this->addReference('_reference_ProviderCountry248', $item248);
        $this->sanitizeEntityValues($item248);
        $manager->persist($item248);


        $item249 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("ZA");
            $this->setCountryCode("+27");
            $this->name = new Name('South Africa', 'Sudáfrica', 'Sudáfrica', 'South Africa');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item249);

        $this->addReference('_reference_ProviderCountry249', $item249);
        $this->sanitizeEntityValues($item249);
        $manager->persist($item249);


        $item250 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("ZM");
            $this->setCountryCode("+260");
            $this->name = new Name('Zambia', 'Zambia', 'Zambia', 'Zambia');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item250);

        $this->addReference('_reference_ProviderCountry250', $item250);
        $this->sanitizeEntityValues($item250);
        $manager->persist($item250);


        $item251 = $this->createEntityInstance(Country::class);
        (function () use ($fixture) {
            $this->setCode("ZW");
            $this->setCountryCode("+263");
            $this->name = new Name('Zimbabwe', 'Zimbabue', 'Zimbabue', 'Zimbabwe');
            $this->zone = new Zone('Africa', 'Africa', 'Africa', 'Africa');
        })->call($item251);

        $this->addReference('_reference_ProviderCountry251', $item251);
        $this->sanitizeEntityValues($item251);
        $manager->persist($item251);


        $manager->flush();
    }
}
