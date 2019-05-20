<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
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
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Country::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);


        $item1 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("AD");
            $this->setCountryCode("+376");
            $this->setName(new Name('Andorra', 'Andorra'));
            $this->setZone(new Zone('Europe', 'Andorra'));
        })->call($item1);

        $this->addReference('_reference_ProviderCountry1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);


        $item2 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("AE");
            $this->setCountryCode("+971");
            $this->setName(new Name('United Arab Emirates', 'Emiratos Árabes Unidos'));
            $this->setZone(new Zone('Asia', 'Emiratos Árabes Unidos'));
        })->call($item2);

        $this->addReference('_reference_ProviderCountry2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);


        $item3 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("AF");
            $this->setCountryCode("+93");
            $this->setName(new Name('Afghanistan', 'Afganistán'));
            $this->setZone(new Zone('Asia', 'Afganistán'));
        })->call($item3);

        $this->addReference('_reference_ProviderCountry3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);


        $item4 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("AG");
            $this->setCountryCode("+1268");
            $this->setName(new Name('Antigua and Barbuda', 'Antigua y Barbuda'));
            $this->setZone(new Zone('North america', 'Antigua y Barbuda'));
        })->call($item4);

        $this->addReference('_reference_ProviderCountry4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);


        $item5 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("AI");
            $this->setCountryCode("+1264");
            $this->setName(new Name('Anguilla', 'Anguila'));
            $this->setZone(new Zone('North america', 'Anguila'));
        })->call($item5);

        $this->addReference('_reference_ProviderCountry5', $item5);
        $this->sanitizeEntityValues($item5);
        $manager->persist($item5);


        $item6 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("AL");
            $this->setCountryCode("+355");
            $this->setName(new Name('Albania', 'Albania'));
            $this->setZone(new Zone('Europe', 'Albania'));
        })->call($item6);

        $this->addReference('_reference_ProviderCountry6', $item6);
        $this->sanitizeEntityValues($item6);
        $manager->persist($item6);


        $item7 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("AM");
            $this->setCountryCode("+374");
            $this->setName(new Name('Armenia', 'Armenia'));
            $this->setZone(new Zone('Asia', 'Armenia'));
        })->call($item7);

        $this->addReference('_reference_ProviderCountry7', $item7);
        $this->sanitizeEntityValues($item7);
        $manager->persist($item7);


        $item8 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("AO");
            $this->setCountryCode("+244");
            $this->setName(new Name('Angola', 'Angola'));
            $this->setZone(new Zone('Africa', 'Angola'));
        })->call($item8);

        $this->addReference('_reference_ProviderCountry8', $item8);
        $this->sanitizeEntityValues($item8);
        $manager->persist($item8);


        $item9 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("AQ");
            $this->setCountryCode("+672");
            $this->setName(new Name('Antarctica', 'Antártida'));
            $this->setZone(new Zone('Antarctica', 'Antártida'));
        })->call($item9);

        $this->addReference('_reference_ProviderCountry9', $item9);
        $this->sanitizeEntityValues($item9);
        $manager->persist($item9);


        $item10 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("AR");
            $this->setCountryCode("+54");
            $this->setName(new Name('Argentina', 'Argentina'));
            $this->setZone(new Zone('South america', 'Argentina'));
        })->call($item10);

        $this->addReference('_reference_ProviderCountry10', $item10);
        $this->sanitizeEntityValues($item10);
        $manager->persist($item10);


        $item11 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("AS");
            $this->setCountryCode("+1684");
            $this->setName(new Name('American Samoa', 'Samoa Americana'));
            $this->setZone(new Zone('Oceania', 'Samoa Americana'));
        })->call($item11);

        $this->addReference('_reference_ProviderCountry11', $item11);
        $this->sanitizeEntityValues($item11);
        $manager->persist($item11);


        $item12 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("AT");
            $this->setCountryCode("+43");
            $this->setName(new Name('Austria', 'Austria'));
            $this->setZone(new Zone('Europe', 'Austria'));
        })->call($item12);

        $this->addReference('_reference_ProviderCountry12', $item12);
        $this->sanitizeEntityValues($item12);
        $manager->persist($item12);


        $item13 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("AU");
            $this->setCountryCode("+61");
            $this->setName(new Name('Australia', 'Australia'));
            $this->setZone(new Zone('Oceania', 'Australia'));
        })->call($item13);

        $this->addReference('_reference_ProviderCountry13', $item13);
        $this->sanitizeEntityValues($item13);
        $manager->persist($item13);


        $item14 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("AW");
            $this->setCountryCode("+297");
            $this->setName(new Name('Aruba', 'Aruba'));
            $this->setZone(new Zone('North america', 'Aruba'));
        })->call($item14);

        $this->addReference('_reference_ProviderCountry14', $item14);
        $this->sanitizeEntityValues($item14);
        $manager->persist($item14);


        $item15 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("AX");
            $this->setCountryCode("+358");
            $this->setName(new Name('Åland Islands', 'Islas de Åland'));
            $this->setZone(new Zone('Europe', 'Islas de Åland'));
        })->call($item15);

        $this->addReference('_reference_ProviderCountry15', $item15);
        $this->sanitizeEntityValues($item15);
        $manager->persist($item15);


        $item16 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("AZ");
            $this->setCountryCode("+994");
            $this->setName(new Name('Azerbaijan', 'Azerbayán'));
            $this->setZone(new Zone('Asia', 'Azerbayán'));
        })->call($item16);

        $this->addReference('_reference_ProviderCountry16', $item16);
        $this->sanitizeEntityValues($item16);
        $manager->persist($item16);


        $item17 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("BA");
            $this->setCountryCode("+387");
            $this->setName(new Name('Bosnia and Herzegovina', 'Bosnia y Herzegovina'));
            $this->setZone(new Zone('Europe', 'Bosnia y Herzegovina'));
        })->call($item17);

        $this->addReference('_reference_ProviderCountry17', $item17);
        $this->sanitizeEntityValues($item17);
        $manager->persist($item17);


        $item18 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("BB");
            $this->setCountryCode("+1246");
            $this->setName(new Name('Barbados', 'Barbados'));
            $this->setZone(new Zone('North america', 'Barbados'));
        })->call($item18);

        $this->addReference('_reference_ProviderCountry18', $item18);
        $this->sanitizeEntityValues($item18);
        $manager->persist($item18);


        $item19 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("BD");
            $this->setCountryCode("+880");
            $this->setName(new Name('Bangladesh', 'Bangladesh'));
            $this->setZone(new Zone('Asia', 'Bangladesh'));
        })->call($item19);

        $this->addReference('_reference_ProviderCountry19', $item19);
        $this->sanitizeEntityValues($item19);
        $manager->persist($item19);


        $item20 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("BE");
            $this->setCountryCode("+32");
            $this->setName(new Name('Belgium', 'Bélgica'));
            $this->setZone(new Zone('Europe', 'Bélgica'));
        })->call($item20);

        $this->addReference('_reference_ProviderCountry20', $item20);
        $this->sanitizeEntityValues($item20);
        $manager->persist($item20);


        $item21 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("BF");
            $this->setCountryCode("+226");
            $this->setName(new Name('Burkina Faso', 'Burkina Faso'));
            $this->setZone(new Zone('Africa', 'Burkina Faso'));
        })->call($item21);

        $this->addReference('_reference_ProviderCountry21', $item21);
        $this->sanitizeEntityValues($item21);
        $manager->persist($item21);


        $item22 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("BG");
            $this->setCountryCode("+359");
            $this->setName(new Name('Bulgaria', 'Bulgaria'));
            $this->setZone(new Zone('Europe', 'Bulgaria'));
        })->call($item22);

        $this->addReference('_reference_ProviderCountry22', $item22);
        $this->sanitizeEntityValues($item22);
        $manager->persist($item22);


        $item23 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("BH");
            $this->setCountryCode("+973");
            $this->setName(new Name('Bahrain', 'Bahrein'));
            $this->setZone(new Zone('Asia', 'Bahrein'));
        })->call($item23);

        $this->addReference('_reference_ProviderCountry23', $item23);
        $this->sanitizeEntityValues($item23);
        $manager->persist($item23);


        $item24 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("BI");
            $this->setCountryCode("+257");
            $this->setName(new Name('Burundi', 'Burundi'));
            $this->setZone(new Zone('Africa', 'Burundi'));
        })->call($item24);

        $this->addReference('_reference_ProviderCountry24', $item24);
        $this->sanitizeEntityValues($item24);
        $manager->persist($item24);


        $item25 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("BJ");
            $this->setCountryCode("+229");
            $this->setName(new Name('Benin', 'Benín'));
            $this->setZone(new Zone('Africa', 'Benín'));
        })->call($item25);

        $this->addReference('_reference_ProviderCountry25', $item25);
        $this->sanitizeEntityValues($item25);
        $manager->persist($item25);


        $item26 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("BL");
            $this->setCountryCode("+590");
            $this->setName(new Name('Saint Barthélemy', 'San Bartolomé'));
            $this->setZone(new Zone('North america', 'San Bartolomé'));
        })->call($item26);

        $this->addReference('_reference_ProviderCountry26', $item26);
        $this->sanitizeEntityValues($item26);
        $manager->persist($item26);


        $item27 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("BM");
            $this->setCountryCode("+1441");
            $this->setName(new Name('Bermuda Islands', 'Islas Bermudas'));
            $this->setZone(new Zone('North america', 'Islas Bermudas'));
        })->call($item27);

        $this->addReference('_reference_ProviderCountry27', $item27);
        $this->sanitizeEntityValues($item27);
        $manager->persist($item27);


        $item28 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("BN");
            $this->setCountryCode("+673");
            $this->setName(new Name('Brunei', 'Brunéi'));
            $this->setZone(new Zone('Asia', 'Brunéi'));
        })->call($item28);

        $this->addReference('_reference_ProviderCountry28', $item28);
        $this->sanitizeEntityValues($item28);
        $manager->persist($item28);


        $item29 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("BO");
            $this->setCountryCode("+591");
            $this->setName(new Name('Bolivia', 'Bolivia'));
            $this->setZone(new Zone('South america', 'Bolivia'));
        })->call($item29);

        $this->addReference('_reference_ProviderCountry29', $item29);
        $this->sanitizeEntityValues($item29);
        $manager->persist($item29);


        $item30 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("BQ");
            $this->setCountryCode("+599");
            $this->setName(new Name('Bonaire', 'Bonaire'));
            $this->setZone(new Zone('South america', 'Bonaire'));
        })->call($item30);

        $this->addReference('_reference_ProviderCountry30', $item30);
        $this->sanitizeEntityValues($item30);
        $manager->persist($item30);


        $item31 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("BR");
            $this->setCountryCode("+55");
            $this->setName(new Name('Brazil', 'Brasil'));
            $this->setZone(new Zone('South america', 'Brasil'));
        })->call($item31);

        $this->addReference('_reference_ProviderCountry31', $item31);
        $this->sanitizeEntityValues($item31);
        $manager->persist($item31);


        $item32 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("BS");
            $this->setCountryCode("+1242");
            $this->setName(new Name('Bahamas', 'Bahamas'));
            $this->setZone(new Zone('North america', 'Bahamas'));
        })->call($item32);

        $this->addReference('_reference_ProviderCountry32', $item32);
        $this->sanitizeEntityValues($item32);
        $manager->persist($item32);


        $item33 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("BT");
            $this->setCountryCode("+975");
            $this->setName(new Name('Bhutan', 'Bhután'));
            $this->setZone(new Zone('Asia', 'Bhután'));
        })->call($item33);

        $this->addReference('_reference_ProviderCountry33', $item33);
        $this->sanitizeEntityValues($item33);
        $manager->persist($item33);


        $item34 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("BV");
            $this->setCountryCode("+47");
            $this->setName(new Name('Bouvet Island', 'Isla Bouvet'));
            $this->setZone(new Zone('Antarctica', 'Isla Bouvet'));
        })->call($item34);

        $this->addReference('_reference_ProviderCountry34', $item34);
        $this->sanitizeEntityValues($item34);
        $manager->persist($item34);


        $item35 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("BW");
            $this->setCountryCode("+267");
            $this->setName(new Name('Botswana', 'Botsuana'));
            $this->setZone(new Zone('Africa', 'Botsuana'));
        })->call($item35);

        $this->addReference('_reference_ProviderCountry35', $item35);
        $this->sanitizeEntityValues($item35);
        $manager->persist($item35);


        $item36 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("BY");
            $this->setCountryCode("+375");
            $this->setName(new Name('Belarus', 'Bielorrusia'));
            $this->setZone(new Zone('Europe', 'Bielorrusia'));
        })->call($item36);

        $this->addReference('_reference_ProviderCountry36', $item36);
        $this->sanitizeEntityValues($item36);
        $manager->persist($item36);


        $item37 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("BZ");
            $this->setCountryCode("+501");
            $this->setName(new Name('Belize', 'Belice'));
            $this->setZone(new Zone('North america', 'Belice'));
        })->call($item37);

        $this->addReference('_reference_ProviderCountry37', $item37);
        $this->sanitizeEntityValues($item37);
        $manager->persist($item37);


        $item38 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("CA");
            $this->setCountryCode("+1");
            $this->setName(new Name('Canada', 'Canadá'));
            $this->setZone(new Zone('North america', 'Canadá'));
        })->call($item38);

        $this->addReference('_reference_ProviderCountry38', $item38);
        $this->sanitizeEntityValues($item38);
        $manager->persist($item38);


        $item39 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("CC");
            $this->setCountryCode("+61");
            $this->setName(new Name('Cocos (Keeling) Islands', 'Islas Cocos (Keeling)'));
            $this->setZone(new Zone('Asia', 'Islas Cocos (Keeling)'));
        })->call($item39);

        $this->addReference('_reference_ProviderCountry39', $item39);
        $this->sanitizeEntityValues($item39);
        $manager->persist($item39);


        $item40 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("CD");
            $this->setCountryCode("+243");
            $this->setName(new Name('Congo', 'Congo'));
            $this->setZone(new Zone('Africa', 'Congo'));
        })->call($item40);

        $this->addReference('_reference_ProviderCountry40', $item40);
        $this->sanitizeEntityValues($item40);
        $manager->persist($item40);


        $item41 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("CF");
            $this->setCountryCode("+236");
            $this->setName(new Name('Central African Republic', 'República Centroafricana'));
            $this->setZone(new Zone('Africa', 'República Centroafricana'));
        })->call($item41);

        $this->addReference('_reference_ProviderCountry41', $item41);
        $this->sanitizeEntityValues($item41);
        $manager->persist($item41);


        $item42 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("CG");
            $this->setCountryCode("+242");
            $this->setName(new Name('Congo', 'Congo'));
            $this->setZone(new Zone('Africa', 'Congo'));
        })->call($item42);

        $this->addReference('_reference_ProviderCountry42', $item42);
        $this->sanitizeEntityValues($item42);
        $manager->persist($item42);


        $item43 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("CH");
            $this->setCountryCode("+41");
            $this->setName(new Name('Switzerland', 'Suiza'));
            $this->setZone(new Zone('Europe', 'Suiza'));
        })->call($item43);

        $this->addReference('_reference_ProviderCountry43', $item43);
        $this->sanitizeEntityValues($item43);
        $manager->persist($item43);


        $item44 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("CI");
            $this->setCountryCode("+225");
            $this->setName(new Name('Ivory Coast', 'Costa de Marfil'));
            $this->setZone(new Zone('Africa', 'Costa de Marfil'));
        })->call($item44);

        $this->addReference('_reference_ProviderCountry44', $item44);
        $this->sanitizeEntityValues($item44);
        $manager->persist($item44);


        $item45 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("CK");
            $this->setCountryCode("+682");
            $this->setName(new Name('Cook Islands', 'Islas Cook'));
            $this->setZone(new Zone('Oceania', 'Islas Cook'));
        })->call($item45);

        $this->addReference('_reference_ProviderCountry45', $item45);
        $this->sanitizeEntityValues($item45);
        $manager->persist($item45);


        $item46 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("CL");
            $this->setCountryCode("+56");
            $this->setName(new Name('Chile', 'Chile'));
            $this->setZone(new Zone('South america', 'Chile'));
        })->call($item46);

        $this->addReference('_reference_ProviderCountry46', $item46);
        $this->sanitizeEntityValues($item46);
        $manager->persist($item46);


        $item47 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("CM");
            $this->setCountryCode("+237");
            $this->setName(new Name('Cameroon', 'Camerún'));
            $this->setZone(new Zone('Africa', 'Camerún'));
        })->call($item47);

        $this->addReference('_reference_ProviderCountry47', $item47);
        $this->sanitizeEntityValues($item47);
        $manager->persist($item47);


        $item48 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("CN");
            $this->setCountryCode("+86");
            $this->setName(new Name('China', 'China'));
            $this->setZone(new Zone('Asia', 'China'));
        })->call($item48);

        $this->addReference('_reference_ProviderCountry48', $item48);
        $this->sanitizeEntityValues($item48);
        $manager->persist($item48);


        $item49 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("CO");
            $this->setCountryCode("+57");
            $this->setName(new Name('Colombia', 'Colombia'));
            $this->setZone(new Zone('South america', 'Colombia'));
        })->call($item49);

        $this->addReference('_reference_ProviderCountry49', $item49);
        $this->sanitizeEntityValues($item49);
        $manager->persist($item49);


        $item50 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("CR");
            $this->setCountryCode("+506");
            $this->setName(new Name('Costa Rica', 'Costa Rica'));
            $this->setZone(new Zone('North america', 'Costa Rica'));
        })->call($item50);

        $this->addReference('_reference_ProviderCountry50', $item50);
        $this->sanitizeEntityValues($item50);
        $manager->persist($item50);


        $item51 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("CU");
            $this->setCountryCode("+53");
            $this->setName(new Name('Cuba', 'Cuba'));
            $this->setZone(new Zone('North america', 'Cuba'));
        })->call($item51);

        $this->addReference('_reference_ProviderCountry51', $item51);
        $this->sanitizeEntityValues($item51);
        $manager->persist($item51);


        $item52 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("CV");
            $this->setCountryCode("+238");
            $this->setName(new Name('Cape Verde', 'Cabo Verde'));
            $this->setZone(new Zone('Africa', 'Cabo Verde'));
        })->call($item52);

        $this->addReference('_reference_ProviderCountry52', $item52);
        $this->sanitizeEntityValues($item52);
        $manager->persist($item52);


        $item53 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("CW");
            $this->setCountryCode("+599");
            $this->setName(new Name('Curaçao', 'Curaçao'));
            $this->setZone(new Zone('South america', 'Curaçao'));
        })->call($item53);

        $this->addReference('_reference_ProviderCountry53', $item53);
        $this->sanitizeEntityValues($item53);
        $manager->persist($item53);


        $item54 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("CX");
            $this->setCountryCode("+61");
            $this->setName(new Name('Christmas Island', 'Isla de Navidad'));
            $this->setZone(new Zone('Asia', 'Isla de Navidad'));
        })->call($item54);

        $this->addReference('_reference_ProviderCountry54', $item54);
        $this->sanitizeEntityValues($item54);
        $manager->persist($item54);


        $item55 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("CY");
            $this->setCountryCode("+357");
            $this->setName(new Name('Cyprus', 'Chipre'));
            $this->setZone(new Zone('Asia', 'Chipre'));
        })->call($item55);

        $this->addReference('_reference_ProviderCountry55', $item55);
        $this->sanitizeEntityValues($item55);
        $manager->persist($item55);


        $item56 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("CZ");
            $this->setCountryCode("+420");
            $this->setName(new Name('Czech Republic', 'República Checa'));
            $this->setZone(new Zone('Europe', 'República Checa'));
        })->call($item56);

        $this->addReference('_reference_ProviderCountry56', $item56);
        $this->sanitizeEntityValues($item56);
        $manager->persist($item56);


        $item57 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("DE");
            $this->setCountryCode("+49");
            $this->setName(new Name('Germany', 'Alemania'));
            $this->setZone(new Zone('Europe', 'Alemania'));
        })->call($item57);

        $this->addReference('_reference_ProviderCountry57', $item57);
        $this->sanitizeEntityValues($item57);
        $manager->persist($item57);


        $item58 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("DJ");
            $this->setCountryCode("+253");
            $this->setName(new Name('Djibouti', 'Yibuti'));
            $this->setZone(new Zone('Africa', 'Yibuti'));
        })->call($item58);

        $this->addReference('_reference_ProviderCountry58', $item58);
        $this->sanitizeEntityValues($item58);
        $manager->persist($item58);


        $item59 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("DK");
            $this->setCountryCode("+45");
            $this->setName(new Name('Denmark', 'Dinamarca'));
            $this->setZone(new Zone('Europe', 'Dinamarca'));
        })->call($item59);

        $this->addReference('_reference_ProviderCountry59', $item59);
        $this->sanitizeEntityValues($item59);
        $manager->persist($item59);


        $item60 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("DM");
            $this->setCountryCode("+1767");
            $this->setName(new Name('Dominica', 'Dominica'));
            $this->setZone(new Zone('North america', 'Dominica'));
        })->call($item60);

        $this->addReference('_reference_ProviderCountry60', $item60);
        $this->sanitizeEntityValues($item60);
        $manager->persist($item60);


        $item61 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("DO");
            $this->setCountryCode("+1809");
            $this->setName(new Name('Dominican Republic', 'República Dominicana'));
            $this->setZone(new Zone('North america', 'República Dominicana'));
        })->call($item61);

        $this->addReference('_reference_ProviderCountry61', $item61);
        $this->sanitizeEntityValues($item61);
        $manager->persist($item61);


        $item64 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("DZ");
            $this->setCountryCode("+213");
            $this->setName(new Name('Algeria', 'Algeria'));
            $this->setZone(new Zone('Africa', 'Algeria'));
        })->call($item64);

        $this->addReference('_reference_ProviderCountry64', $item64);
        $this->sanitizeEntityValues($item64);
        $manager->persist($item64);


        $item65 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("EC");
            $this->setCountryCode("+593");
            $this->setName(new Name('Ecuador', 'Ecuador'));
            $this->setZone(new Zone('South america', 'Ecuador'));
        })->call($item65);

        $this->addReference('_reference_ProviderCountry65', $item65);
        $this->sanitizeEntityValues($item65);
        $manager->persist($item65);


        $item66 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("EE");
            $this->setCountryCode("+372");
            $this->setName(new Name('Estonia', 'Estonia'));
            $this->setZone(new Zone('Europe', 'Estonia'));
        })->call($item66);

        $this->addReference('_reference_ProviderCountry66', $item66);
        $this->sanitizeEntityValues($item66);
        $manager->persist($item66);


        $item67 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("EG");
            $this->setCountryCode("+20");
            $this->setName(new Name('Egypt', 'Egipto'));
            $this->setZone(new Zone('Africa', 'Egipto'));
        })->call($item67);

        $this->addReference('_reference_ProviderCountry67', $item67);
        $this->sanitizeEntityValues($item67);
        $manager->persist($item67);


        $item68 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("EH");
            $this->setCountryCode("+212");
            $this->setName(new Name('Western Sahara', 'Sahara Occidental'));
            $this->setZone(new Zone('Africa', 'Sahara Occidental'));
        })->call($item68);

        $this->addReference('_reference_ProviderCountry68', $item68);
        $this->sanitizeEntityValues($item68);
        $manager->persist($item68);


        $item69 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("ER");
            $this->setCountryCode("+291");
            $this->setName(new Name('Eritrea', 'Eritrea'));
            $this->setZone(new Zone('Africa', 'Eritrea'));
        })->call($item69);

        $this->addReference('_reference_ProviderCountry69', $item69);
        $this->sanitizeEntityValues($item69);
        $manager->persist($item69);


        $item70 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("ES");
            $this->setCountryCode("+34");
            $this->setName(new Name('Spain', 'España'));
            $this->setZone(new Zone('Europe', 'Europa'));
        })->call($item70);

        $this->addReference('_reference_ProviderCountry70', $item70);
        $this->sanitizeEntityValues($item70);
        $manager->persist($item70);


        $item71 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("ET");
            $this->setCountryCode("+251");
            $this->setName(new Name('Ethiopia', 'Etiopía'));
            $this->setZone(new Zone('Africa', 'Etiopía'));
        })->call($item71);

        $this->addReference('_reference_ProviderCountry71', $item71);
        $this->sanitizeEntityValues($item71);
        $manager->persist($item71);


        $item72 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("FI");
            $this->setCountryCode("+358");
            $this->setName(new Name('Finland', 'Finlandia'));
            $this->setZone(new Zone('Europe', 'Finlandia'));
        })->call($item72);

        $this->addReference('_reference_ProviderCountry72', $item72);
        $this->sanitizeEntityValues($item72);
        $manager->persist($item72);


        $item73 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("FJ");
            $this->setCountryCode("+679");
            $this->setName(new Name('Fiji', 'Fiyi'));
            $this->setZone(new Zone('Oceania', 'Fiyi'));
        })->call($item73);

        $this->addReference('_reference_ProviderCountry73', $item73);
        $this->sanitizeEntityValues($item73);
        $manager->persist($item73);


        $item74 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("FK");
            $this->setCountryCode("+500");
            $this->setName(new Name('Falkland Islands (Malvinas)', 'Islas Malvinas'));
            $this->setZone(new Zone('South america', 'Islas Malvinas'));
        })->call($item74);

        $this->addReference('_reference_ProviderCountry74', $item74);
        $this->sanitizeEntityValues($item74);
        $manager->persist($item74);


        $item75 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("FM");
            $this->setCountryCode("+691");
            $this->setName(new Name('Estados Federados de', 'Micronesia'));
            $this->setZone(new Zone('Oceania', 'Micronesia'));
        })->call($item75);

        $this->addReference('_reference_ProviderCountry75', $item75);
        $this->sanitizeEntityValues($item75);
        $manager->persist($item75);


        $item76 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("FO");
            $this->setCountryCode("+298");
            $this->setName(new Name('Faroe Islands', 'Islas Feroe'));
            $this->setZone(new Zone('Europe', 'Islas Feroe'));
        })->call($item76);

        $this->addReference('_reference_ProviderCountry76', $item76);
        $this->sanitizeEntityValues($item76);
        $manager->persist($item76);


        $item77 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("FR");
            $this->setCountryCode("+33");
            $this->setName(new Name('France', 'Francia'));
            $this->setZone(new Zone('Europe', 'Francia'));
        })->call($item77);

        $this->addReference('_reference_ProviderCountry77', $item77);
        $this->sanitizeEntityValues($item77);
        $manager->persist($item77);


        $item78 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("GA");
            $this->setCountryCode("+241");
            $this->setName(new Name('Gabon', 'Gabón'));
            $this->setZone(new Zone('Africa', 'Gabón'));
        })->call($item78);

        $this->addReference('_reference_ProviderCountry78', $item78);
        $this->sanitizeEntityValues($item78);
        $manager->persist($item78);


        $item79 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("GB");
            $this->setCountryCode("+44");
            $this->setName(new Name('United Kingdom', 'Reino Unido'));
            $this->setZone(new Zone('Europe', 'Europa'));
        })->call($item79);

        $this->addReference('_reference_ProviderCountry79', $item79);
        $this->sanitizeEntityValues($item79);
        $manager->persist($item79);


        $item80 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("GD");
            $this->setCountryCode("+1473");
            $this->setName(new Name('Grenada', 'Granada'));
            $this->setZone(new Zone('North america', 'Granada'));
        })->call($item80);

        $this->addReference('_reference_ProviderCountry80', $item80);
        $this->sanitizeEntityValues($item80);
        $manager->persist($item80);


        $item81 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("GE");
            $this->setCountryCode("+995");
            $this->setName(new Name('Georgia', 'Georgia'));
            $this->setZone(new Zone('Asia', 'Georgia'));
        })->call($item81);

        $this->addReference('_reference_ProviderCountry81', $item81);
        $this->sanitizeEntityValues($item81);
        $manager->persist($item81);


        $item82 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("GF");
            $this->setCountryCode("+594");
            $this->setName(new Name('French Guiana', 'Guayana Francesa'));
            $this->setZone(new Zone('South america', 'Guayana Francesa'));
        })->call($item82);

        $this->addReference('_reference_ProviderCountry82', $item82);
        $this->sanitizeEntityValues($item82);
        $manager->persist($item82);


        $item83 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("GG");
            $this->setCountryCode("+44");
            $this->setName(new Name('Guernsey', 'Guernsey'));
            $this->setZone(new Zone('Europe', 'Guernsey'));
        })->call($item83);

        $this->addReference('_reference_ProviderCountry83', $item83);
        $this->sanitizeEntityValues($item83);
        $manager->persist($item83);


        $item84 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("GH");
            $this->setCountryCode("+233");
            $this->setName(new Name('Ghana', 'Ghana'));
            $this->setZone(new Zone('Africa', 'Ghana'));
        })->call($item84);

        $this->addReference('_reference_ProviderCountry84', $item84);
        $this->sanitizeEntityValues($item84);
        $manager->persist($item84);


        $item85 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("GI");
            $this->setCountryCode("+350");
            $this->setName(new Name('Gibraltar', 'Gibraltar'));
            $this->setZone(new Zone('Europe', 'Gibraltar'));
        })->call($item85);

        $this->addReference('_reference_ProviderCountry85', $item85);
        $this->sanitizeEntityValues($item85);
        $manager->persist($item85);


        $item86 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("GL");
            $this->setCountryCode("+299");
            $this->setName(new Name('Greenland', 'Groenlandia'));
            $this->setZone(new Zone('North america', 'Groenlandia'));
        })->call($item86);

        $this->addReference('_reference_ProviderCountry86', $item86);
        $this->sanitizeEntityValues($item86);
        $manager->persist($item86);


        $item87 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("GM");
            $this->setCountryCode("+220");
            $this->setName(new Name('Gambia', 'Gambia'));
            $this->setZone(new Zone('Africa', 'Gambia'));
        })->call($item87);

        $this->addReference('_reference_ProviderCountry87', $item87);
        $this->sanitizeEntityValues($item87);
        $manager->persist($item87);


        $item88 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("GN");
            $this->setCountryCode("+224");
            $this->setName(new Name('Guinea', 'Guinea'));
            $this->setZone(new Zone('Africa', 'Guinea'));
        })->call($item88);

        $this->addReference('_reference_ProviderCountry88', $item88);
        $this->sanitizeEntityValues($item88);
        $manager->persist($item88);


        $item89 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("GP");
            $this->setCountryCode("+590");
            $this->setName(new Name('Guadeloupe', 'Guadalupe'));
            $this->setZone(new Zone('North america', 'Guadalupe'));
        })->call($item89);

        $this->addReference('_reference_ProviderCountry89', $item89);
        $this->sanitizeEntityValues($item89);
        $manager->persist($item89);


        $item90 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("GQ");
            $this->setCountryCode("+240");
            $this->setName(new Name('Equatorial Guinea', 'Guinea Ecuatorial'));
            $this->setZone(new Zone('Africa', 'Guinea Ecuatorial'));
        })->call($item90);

        $this->addReference('_reference_ProviderCountry90', $item90);
        $this->sanitizeEntityValues($item90);
        $manager->persist($item90);


        $item91 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("GR");
            $this->setCountryCode("+30");
            $this->setName(new Name('Greece', 'Grecia'));
            $this->setZone(new Zone('Europe', 'Grecia'));
        })->call($item91);

        $this->addReference('_reference_ProviderCountry91', $item91);
        $this->sanitizeEntityValues($item91);
        $manager->persist($item91);


        $item92 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("GS");
            $this->setCountryCode("+500");
            $this->setName(new Name('South Georgia and the South Sandwich Islands', 'Islas Georgias del Sur y Sandwich del Sur'));
            $this->setZone(new Zone('Antarctica', 'Islas Georgias del Sur y Sandwich del Sur'));
        })->call($item92);

        $this->addReference('_reference_ProviderCountry92', $item92);
        $this->sanitizeEntityValues($item92);
        $manager->persist($item92);


        $item93 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("GT");
            $this->setCountryCode("+502");
            $this->setName(new Name('Guatemala', 'Guatemala'));
            $this->setZone(new Zone('North america', 'Guatemala'));
        })->call($item93);

        $this->addReference('_reference_ProviderCountry93', $item93);
        $this->sanitizeEntityValues($item93);
        $manager->persist($item93);


        $item94 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("GU");
            $this->setCountryCode("+1671");
            $this->setName(new Name('Guam', 'Guam'));
            $this->setZone(new Zone('Oceania', 'Guam'));
        })->call($item94);

        $this->addReference('_reference_ProviderCountry94', $item94);
        $this->sanitizeEntityValues($item94);
        $manager->persist($item94);


        $item95 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("GW");
            $this->setCountryCode("+245");
            $this->setName(new Name('Guinea-Bissau', 'Guinea-Bissau'));
            $this->setZone(new Zone('Africa', 'Guinea-Bissau'));
        })->call($item95);

        $this->addReference('_reference_ProviderCountry95', $item95);
        $this->sanitizeEntityValues($item95);
        $manager->persist($item95);


        $item96 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("GY");
            $this->setCountryCode("+592");
            $this->setName(new Name('Guyana', 'Guyana'));
            $this->setZone(new Zone('South america', 'Guyana'));
        })->call($item96);

        $this->addReference('_reference_ProviderCountry96', $item96);
        $this->sanitizeEntityValues($item96);
        $manager->persist($item96);


        $item97 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("HK");
            $this->setCountryCode("+852");
            $this->setName(new Name('Hong Kong', 'Hong kong'));
            $this->setZone(new Zone('Asia', 'Hong kong'));
        })->call($item97);

        $this->addReference('_reference_ProviderCountry97', $item97);
        $this->sanitizeEntityValues($item97);
        $manager->persist($item97);


        $item98 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("HM");
            $this->setCountryCode("+672");
            $this->setName(new Name('Heard Island and McDonald Islands', 'Islas Heard y McDonald'));
            $this->setZone(new Zone('Antarctica', 'Islas Heard y McDonald'));
        })->call($item98);

        $this->addReference('_reference_ProviderCountry98', $item98);
        $this->sanitizeEntityValues($item98);
        $manager->persist($item98);


        $item99 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("HN");
            $this->setCountryCode("+504");
            $this->setName(new Name('Honduras', 'Honduras'));
            $this->setZone(new Zone('North america', 'Honduras'));
        })->call($item99);

        $this->addReference('_reference_ProviderCountry99', $item99);
        $this->sanitizeEntityValues($item99);
        $manager->persist($item99);


        $item100 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("HR");
            $this->setCountryCode("+385");
            $this->setName(new Name('Croatia', 'Croacia'));
            $this->setZone(new Zone('Europe', 'Croacia'));
        })->call($item100);

        $this->addReference('_reference_ProviderCountry100', $item100);
        $this->sanitizeEntityValues($item100);
        $manager->persist($item100);


        $item101 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("HT");
            $this->setCountryCode("+509");
            $this->setName(new Name('Haiti', 'Haití'));
            $this->setZone(new Zone('North america', 'Haití'));
        })->call($item101);

        $this->addReference('_reference_ProviderCountry101', $item101);
        $this->sanitizeEntityValues($item101);
        $manager->persist($item101);


        $item102 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("HU");
            $this->setCountryCode("+36");
            $this->setName(new Name('Hungary', 'Hungría'));
            $this->setZone(new Zone('Europe', 'Hungría'));
        })->call($item102);

        $this->addReference('_reference_ProviderCountry102', $item102);
        $this->sanitizeEntityValues($item102);
        $manager->persist($item102);


        $item103 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("ID");
            $this->setCountryCode("+62");
            $this->setName(new Name('Indonesia', 'Indonesia'));
            $this->setZone(new Zone('Asia', 'Indonesia'));
        })->call($item103);

        $this->addReference('_reference_ProviderCountry103', $item103);
        $this->sanitizeEntityValues($item103);
        $manager->persist($item103);


        $item104 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("IE");
            $this->setCountryCode("+353");
            $this->setName(new Name('Ireland', 'Irlanda'));
            $this->setZone(new Zone('Europe', 'Irlanda'));
        })->call($item104);

        $this->addReference('_reference_ProviderCountry104', $item104);
        $this->sanitizeEntityValues($item104);
        $manager->persist($item104);


        $item105 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("IL");
            $this->setCountryCode("+972");
            $this->setName(new Name('Israel', 'Israel'));
            $this->setZone(new Zone('Asia', 'Israel'));
        })->call($item105);

        $this->addReference('_reference_ProviderCountry105', $item105);
        $this->sanitizeEntityValues($item105);
        $manager->persist($item105);


        $item106 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("IM");
            $this->setCountryCode("+44");
            $this->setName(new Name('Isle of Man', 'Isla de Man'));
            $this->setZone(new Zone('Europe', 'Isla de Man'));
        })->call($item106);

        $this->addReference('_reference_ProviderCountry106', $item106);
        $this->sanitizeEntityValues($item106);
        $manager->persist($item106);


        $item107 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("IN");
            $this->setCountryCode("+91");
            $this->setName(new Name('India', 'India'));
            $this->setZone(new Zone('Asia', 'India'));
        })->call($item107);

        $this->addReference('_reference_ProviderCountry107', $item107);
        $this->sanitizeEntityValues($item107);
        $manager->persist($item107);


        $item108 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("IO");
            $this->setCountryCode("+246");
            $this->setName(new Name('British Indian Ocean Territory', 'Territorio Británico del Océano Índico'));
            $this->setZone(new Zone('Asia', 'Territorio Británico del Océano Índico'));
        })->call($item108);

        $this->addReference('_reference_ProviderCountry108', $item108);
        $this->sanitizeEntityValues($item108);
        $manager->persist($item108);


        $item109 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("IQ");
            $this->setCountryCode("+964");
            $this->setName(new Name('Iraq', 'Irak'));
            $this->setZone(new Zone('Asia', 'Irak'));
        })->call($item109);

        $this->addReference('_reference_ProviderCountry109', $item109);
        $this->sanitizeEntityValues($item109);
        $manager->persist($item109);


        $item110 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("IR");
            $this->setCountryCode("+98");
            $this->setName(new Name('Iran', 'Irán'));
            $this->setZone(new Zone('Asia', 'Irán'));
        })->call($item110);

        $this->addReference('_reference_ProviderCountry110', $item110);
        $this->sanitizeEntityValues($item110);
        $manager->persist($item110);


        $item111 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("IS");
            $this->setCountryCode("+354");
            $this->setName(new Name('Iceland', 'Islandia'));
            $this->setZone(new Zone('Europe', 'Islandia'));
        })->call($item111);

        $this->addReference('_reference_ProviderCountry111', $item111);
        $this->sanitizeEntityValues($item111);
        $manager->persist($item111);


        $item112 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("IT");
            $this->setCountryCode("+39");
            $this->setName(new Name('Italy', 'Italia'));
            $this->setZone(new Zone('Europe', 'Italia'));
        })->call($item112);

        $this->addReference('_reference_ProviderCountry112', $item112);
        $this->sanitizeEntityValues($item112);
        $manager->persist($item112);


        $item113 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("JE");
            $this->setCountryCode("+44");
            $this->setName(new Name('Jersey', 'Jersey'));
            $this->setZone(new Zone('Europe', 'Jersey'));
        })->call($item113);

        $this->addReference('_reference_ProviderCountry113', $item113);
        $this->sanitizeEntityValues($item113);
        $manager->persist($item113);


        $item114 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("JM");
            $this->setCountryCode("+1876");
            $this->setName(new Name('Jamaica', 'Jamaica'));
            $this->setZone(new Zone('North america', 'Jamaica'));
        })->call($item114);

        $this->addReference('_reference_ProviderCountry114', $item114);
        $this->sanitizeEntityValues($item114);
        $manager->persist($item114);


        $item115 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("JO");
            $this->setCountryCode("+962");
            $this->setName(new Name('Jordan', 'Jordania'));
            $this->setZone(new Zone('Asia', 'Jordania'));
        })->call($item115);

        $this->addReference('_reference_ProviderCountry115', $item115);
        $this->sanitizeEntityValues($item115);
        $manager->persist($item115);


        $item116 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("JP");
            $this->setCountryCode("+81");
            $this->setName(new Name('Japan', 'Japón'));
            $this->setZone(new Zone('Asia', 'Japón'));
        })->call($item116);

        $this->addReference('_reference_ProviderCountry116', $item116);
        $this->sanitizeEntityValues($item116);
        $manager->persist($item116);


        $item117 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("KE");
            $this->setCountryCode("+254");
            $this->setName(new Name('Kenya', 'Kenia'));
            $this->setZone(new Zone('Africa', 'Kenia'));
        })->call($item117);

        $this->addReference('_reference_ProviderCountry117', $item117);
        $this->sanitizeEntityValues($item117);
        $manager->persist($item117);


        $item118 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("KG");
            $this->setCountryCode("+996");
            $this->setName(new Name('Kyrgyzstan', 'Kirgizstán'));
            $this->setZone(new Zone('Asia', 'Kirgizstán'));
        })->call($item118);

        $this->addReference('_reference_ProviderCountry118', $item118);
        $this->sanitizeEntityValues($item118);
        $manager->persist($item118);


        $item119 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("KH");
            $this->setCountryCode("+855");
            $this->setName(new Name('Cambodia', 'Camboya'));
            $this->setZone(new Zone('Asia', 'Camboya'));
        })->call($item119);

        $this->addReference('_reference_ProviderCountry119', $item119);
        $this->sanitizeEntityValues($item119);
        $manager->persist($item119);


        $item120 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("KI");
            $this->setCountryCode("+686");
            $this->setName(new Name('Kiribati', 'Kiribati'));
            $this->setZone(new Zone('Oceania', 'Kiribati'));
        })->call($item120);

        $this->addReference('_reference_ProviderCountry120', $item120);
        $this->sanitizeEntityValues($item120);
        $manager->persist($item120);


        $item121 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("KM");
            $this->setCountryCode("+269");
            $this->setName(new Name('Comoros', 'Comoras'));
            $this->setZone(new Zone('Africa', 'Comoras'));
        })->call($item121);

        $this->addReference('_reference_ProviderCountry121', $item121);
        $this->sanitizeEntityValues($item121);
        $manager->persist($item121);


        $item122 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("KN");
            $this->setCountryCode("+1869");
            $this->setName(new Name('Saint Kitts and Nevis', 'San Cristóbal y Nieves'));
            $this->setZone(new Zone('North america', 'San Cristóbal y Nieves'));
        })->call($item122);

        $this->addReference('_reference_ProviderCountry122', $item122);
        $this->sanitizeEntityValues($item122);
        $manager->persist($item122);


        $item123 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("KP");
            $this->setCountryCode("+850");
            $this->setName(new Name('North Korea', 'Corea del Norte'));
            $this->setZone(new Zone('Asia', 'Corea del Norte'));
        })->call($item123);

        $this->addReference('_reference_ProviderCountry123', $item123);
        $this->sanitizeEntityValues($item123);
        $manager->persist($item123);


        $item124 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("KR");
            $this->setCountryCode("+82");
            $this->setName(new Name('South Korea', 'Corea del Sur'));
            $this->setZone(new Zone('Asia', 'Corea del Sur'));
        })->call($item124);

        $this->addReference('_reference_ProviderCountry124', $item124);
        $this->sanitizeEntityValues($item124);
        $manager->persist($item124);


        $item125 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("KW");
            $this->setCountryCode("+965");
            $this->setName(new Name('Kuwait', 'Kuwait'));
            $this->setZone(new Zone('Asia', 'Kuwait'));
        })->call($item125);

        $this->addReference('_reference_ProviderCountry125', $item125);
        $this->sanitizeEntityValues($item125);
        $manager->persist($item125);


        $item126 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("KY");
            $this->setCountryCode("+1345");
            $this->setName(new Name('Cayman Islands', 'Islas Caimán'));
            $this->setZone(new Zone('North america', 'Islas Caimán'));
        })->call($item126);

        $this->addReference('_reference_ProviderCountry126', $item126);
        $this->sanitizeEntityValues($item126);
        $manager->persist($item126);


        $item127 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("KZ");
            $this->setCountryCode("+7");
            $this->setName(new Name('Kazakhstan', 'Kazajistán'));
            $this->setZone(new Zone('Asia', 'Kazajistán'));
        })->call($item127);

        $this->addReference('_reference_ProviderCountry127', $item127);
        $this->sanitizeEntityValues($item127);
        $manager->persist($item127);


        $item128 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("LA");
            $this->setCountryCode("+856");
            $this->setName(new Name('Laos', 'Laos'));
            $this->setZone(new Zone('Asia', 'Laos'));
        })->call($item128);

        $this->addReference('_reference_ProviderCountry128', $item128);
        $this->sanitizeEntityValues($item128);
        $manager->persist($item128);


        $item129 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("LB");
            $this->setCountryCode("+961");
            $this->setName(new Name('Lebanon', 'Líbano'));
            $this->setZone(new Zone('Asia', 'Líbano'));
        })->call($item129);

        $this->addReference('_reference_ProviderCountry129', $item129);
        $this->sanitizeEntityValues($item129);
        $manager->persist($item129);


        $item130 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("LC");
            $this->setCountryCode("+1758");
            $this->setName(new Name('Saint Lucia', 'Santa Lucía'));
            $this->setZone(new Zone('North america', 'Santa Lucía'));
        })->call($item130);

        $this->addReference('_reference_ProviderCountry130', $item130);
        $this->sanitizeEntityValues($item130);
        $manager->persist($item130);


        $item131 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("LI");
            $this->setCountryCode("+423");
            $this->setName(new Name('Liechtenstein', 'Liechtenstein'));
            $this->setZone(new Zone('Europe', 'Liechtenstein'));
        })->call($item131);

        $this->addReference('_reference_ProviderCountry131', $item131);
        $this->sanitizeEntityValues($item131);
        $manager->persist($item131);


        $item132 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("LK");
            $this->setCountryCode("+94");
            $this->setName(new Name('Sri Lanka', 'Sri lanka'));
            $this->setZone(new Zone('Asia', 'Sri lanka'));
        })->call($item132);

        $this->addReference('_reference_ProviderCountry132', $item132);
        $this->sanitizeEntityValues($item132);
        $manager->persist($item132);


        $item133 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("LR");
            $this->setCountryCode("+231");
            $this->setName(new Name('Liberia', 'Liberia'));
            $this->setZone(new Zone('Africa', 'Liberia'));
        })->call($item133);

        $this->addReference('_reference_ProviderCountry133', $item133);
        $this->sanitizeEntityValues($item133);
        $manager->persist($item133);


        $item134 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("LS");
            $this->setCountryCode("+266");
            $this->setName(new Name('Lesotho', 'Lesoto'));
            $this->setZone(new Zone('Africa', 'Lesoto'));
        })->call($item134);

        $this->addReference('_reference_ProviderCountry134', $item134);
        $this->sanitizeEntityValues($item134);
        $manager->persist($item134);


        $item135 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("LT");
            $this->setCountryCode("+370");
            $this->setName(new Name('Lithuania', 'Lituania'));
            $this->setZone(new Zone('Europe', 'Lituania'));
        })->call($item135);

        $this->addReference('_reference_ProviderCountry135', $item135);
        $this->sanitizeEntityValues($item135);
        $manager->persist($item135);


        $item136 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("LU");
            $this->setCountryCode("+352");
            $this->setName(new Name('Luxembourg', 'Luxemburgo'));
            $this->setZone(new Zone('Europe', 'Luxemburgo'));
        })->call($item136);

        $this->addReference('_reference_ProviderCountry136', $item136);
        $this->sanitizeEntityValues($item136);
        $manager->persist($item136);


        $item137 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("LV");
            $this->setCountryCode("+371");
            $this->setName(new Name('Latvia', 'Letonia'));
            $this->setZone(new Zone('Europe', 'Letonia'));
        })->call($item137);

        $this->addReference('_reference_ProviderCountry137', $item137);
        $this->sanitizeEntityValues($item137);
        $manager->persist($item137);


        $item138 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("LY");
            $this->setCountryCode("+218");
            $this->setName(new Name('Libya', 'Libia'));
            $this->setZone(new Zone('Africa', 'Libia'));
        })->call($item138);

        $this->addReference('_reference_ProviderCountry138', $item138);
        $this->sanitizeEntityValues($item138);
        $manager->persist($item138);


        $item139 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("MA");
            $this->setCountryCode("+212");
            $this->setName(new Name('Morocco', 'Marruecos'));
            $this->setZone(new Zone('Africa', 'Marruecos'));
        })->call($item139);

        $this->addReference('_reference_ProviderCountry139', $item139);
        $this->sanitizeEntityValues($item139);
        $manager->persist($item139);


        $item140 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("MC");
            $this->setCountryCode("+377");
            $this->setName(new Name('Monaco', 'Mónaco'));
            $this->setZone(new Zone('Europe', 'Mónaco'));
        })->call($item140);

        $this->addReference('_reference_ProviderCountry140', $item140);
        $this->sanitizeEntityValues($item140);
        $manager->persist($item140);


        $item141 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("MD");
            $this->setCountryCode("+373");
            $this->setName(new Name('Moldova', 'Moldavia'));
            $this->setZone(new Zone('Europe', 'Moldavia'));
        })->call($item141);

        $this->addReference('_reference_ProviderCountry141', $item141);
        $this->sanitizeEntityValues($item141);
        $manager->persist($item141);


        $item142 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("ME");
            $this->setCountryCode("+382");
            $this->setName(new Name('Montenegro', 'Montenegro'));
            $this->setZone(new Zone('Europe', 'Montenegro'));
        })->call($item142);

        $this->addReference('_reference_ProviderCountry142', $item142);
        $this->sanitizeEntityValues($item142);
        $manager->persist($item142);


        $item143 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("MF");
            $this->setCountryCode("+1599");
            $this->setName(new Name('Saint Martin (French part)', 'San Martín (Francia)'));
            $this->setZone(new Zone('North america', 'San Martín (Francia)'));
        })->call($item143);

        $this->addReference('_reference_ProviderCountry143', $item143);
        $this->sanitizeEntityValues($item143);
        $manager->persist($item143);


        $item144 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("MG");
            $this->setCountryCode("+261");
            $this->setName(new Name('Madagascar', 'Madagascar'));
            $this->setZone(new Zone('Africa', 'Madagascar'));
        })->call($item144);

        $this->addReference('_reference_ProviderCountry144', $item144);
        $this->sanitizeEntityValues($item144);
        $manager->persist($item144);


        $item145 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("MH");
            $this->setCountryCode("+692");
            $this->setName(new Name('Marshall Islands', 'Islas Marshall'));
            $this->setZone(new Zone('Oceania', 'Islas Marshall'));
        })->call($item145);

        $this->addReference('_reference_ProviderCountry145', $item145);
        $this->sanitizeEntityValues($item145);
        $manager->persist($item145);


        $item146 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("MK");
            $this->setCountryCode("+389");
            $this->setName(new Name('Macedonia', 'Macedônia'));
            $this->setZone(new Zone('Europe', 'Macedônia'));
        })->call($item146);

        $this->addReference('_reference_ProviderCountry146', $item146);
        $this->sanitizeEntityValues($item146);
        $manager->persist($item146);


        $item147 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("ML");
            $this->setCountryCode("+223");
            $this->setName(new Name('Mali', 'Mali'));
            $this->setZone(new Zone('Africa', 'Mali'));
        })->call($item147);

        $this->addReference('_reference_ProviderCountry147', $item147);
        $this->sanitizeEntityValues($item147);
        $manager->persist($item147);


        $item148 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("MM");
            $this->setCountryCode("+95");
            $this->setName(new Name('Myanmar', 'Birmania'));
            $this->setZone(new Zone('Asia', 'Birmania'));
        })->call($item148);

        $this->addReference('_reference_ProviderCountry148', $item148);
        $this->sanitizeEntityValues($item148);
        $manager->persist($item148);


        $item149 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("MN");
            $this->setCountryCode("+976");
            $this->setName(new Name('Mongolia', 'Mongolia'));
            $this->setZone(new Zone('Asia', 'Mongolia'));
        })->call($item149);

        $this->addReference('_reference_ProviderCountry149', $item149);
        $this->sanitizeEntityValues($item149);
        $manager->persist($item149);


        $item150 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("MO");
            $this->setCountryCode("+853");
            $this->setName(new Name('Macao', 'Macao'));
            $this->setZone(new Zone('Asia', 'Macao'));
        })->call($item150);

        $this->addReference('_reference_ProviderCountry150', $item150);
        $this->sanitizeEntityValues($item150);
        $manager->persist($item150);


        $item151 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("MP");
            $this->setCountryCode("+1670");
            $this->setName(new Name('Northern Mariana Islands', 'Islas Marianas del Norte'));
            $this->setZone(new Zone('Oceania', 'Islas Marianas del Norte'));
        })->call($item151);

        $this->addReference('_reference_ProviderCountry151', $item151);
        $this->sanitizeEntityValues($item151);
        $manager->persist($item151);


        $item152 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("MQ");
            $this->setCountryCode("+596");
            $this->setName(new Name('Martinique', 'Martinica'));
            $this->setZone(new Zone('North america', 'Martinica'));
        })->call($item152);

        $this->addReference('_reference_ProviderCountry152', $item152);
        $this->sanitizeEntityValues($item152);
        $manager->persist($item152);


        $item153 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("MR");
            $this->setCountryCode("+222");
            $this->setName(new Name('Mauritania', 'Mauritania'));
            $this->setZone(new Zone('Africa', 'Mauritania'));
        })->call($item153);

        $this->addReference('_reference_ProviderCountry153', $item153);
        $this->sanitizeEntityValues($item153);
        $manager->persist($item153);


        $item154 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("MS");
            $this->setCountryCode("+1664");
            $this->setName(new Name('Montserrat', 'Montserrat'));
            $this->setZone(new Zone('North america', 'Montserrat'));
        })->call($item154);

        $this->addReference('_reference_ProviderCountry154', $item154);
        $this->sanitizeEntityValues($item154);
        $manager->persist($item154);


        $item155 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("MT");
            $this->setCountryCode("+356");
            $this->setName(new Name('Malta', 'Malta'));
            $this->setZone(new Zone('Europe', 'Malta'));
        })->call($item155);

        $this->addReference('_reference_ProviderCountry155', $item155);
        $this->sanitizeEntityValues($item155);
        $manager->persist($item155);


        $item156 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("MU");
            $this->setCountryCode("+230");
            $this->setName(new Name('Mauritius', 'Mauricio'));
            $this->setZone(new Zone('Africa', 'Mauricio'));
        })->call($item156);

        $this->addReference('_reference_ProviderCountry156', $item156);
        $this->sanitizeEntityValues($item156);
        $manager->persist($item156);


        $item157 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("MV");
            $this->setCountryCode("+960");
            $this->setName(new Name('Maldives', 'Islas Maldivas'));
            $this->setZone(new Zone('Asia', 'Islas Maldivas'));
        })->call($item157);

        $this->addReference('_reference_ProviderCountry157', $item157);
        $this->sanitizeEntityValues($item157);
        $manager->persist($item157);


        $item158 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("MW");
            $this->setCountryCode("+265");
            $this->setName(new Name('Malawi', 'Malawi'));
            $this->setZone(new Zone('Africa', 'Malawi'));
        })->call($item158);

        $this->addReference('_reference_ProviderCountry158', $item158);
        $this->sanitizeEntityValues($item158);
        $manager->persist($item158);


        $item159 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("MX");
            $this->setCountryCode("+52");
            $this->setName(new Name('Mexico', 'México'));
            $this->setZone(new Zone('North america', 'México'));
        })->call($item159);

        $this->addReference('_reference_ProviderCountry159', $item159);
        $this->sanitizeEntityValues($item159);
        $manager->persist($item159);


        $item160 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("MY");
            $this->setCountryCode("+60");
            $this->setName(new Name('Malaysia', 'Malasia'));
            $this->setZone(new Zone('Asia', 'Malasia'));
        })->call($item160);

        $this->addReference('_reference_ProviderCountry160', $item160);
        $this->sanitizeEntityValues($item160);
        $manager->persist($item160);


        $item161 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("MZ");
            $this->setCountryCode("+258");
            $this->setName(new Name('Mozambique', 'Mozambique'));
            $this->setZone(new Zone('Africa', 'Mozambique'));
        })->call($item161);

        $this->addReference('_reference_ProviderCountry161', $item161);
        $this->sanitizeEntityValues($item161);
        $manager->persist($item161);


        $item162 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("NA");
            $this->setCountryCode("+264");
            $this->setName(new Name('Namibia', 'Namibia'));
            $this->setZone(new Zone('Africa', 'Namibia'));
        })->call($item162);

        $this->addReference('_reference_ProviderCountry162', $item162);
        $this->sanitizeEntityValues($item162);
        $manager->persist($item162);


        $item163 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("NC");
            $this->setCountryCode("+687");
            $this->setName(new Name('New Caledonia', 'Nueva Caledonia'));
            $this->setZone(new Zone('Oceania', 'Nueva Caledonia'));
        })->call($item163);

        $this->addReference('_reference_ProviderCountry163', $item163);
        $this->sanitizeEntityValues($item163);
        $manager->persist($item163);


        $item164 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("NE");
            $this->setCountryCode("+227");
            $this->setName(new Name('Niger', 'Niger'));
            $this->setZone(new Zone('Africa', 'Niger'));
        })->call($item164);

        $this->addReference('_reference_ProviderCountry164', $item164);
        $this->sanitizeEntityValues($item164);
        $manager->persist($item164);


        $item165 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("NF");
            $this->setCountryCode("+672");
            $this->setName(new Name('Norfolk Island', 'Isla Norfolk'));
            $this->setZone(new Zone('Oceania', 'Isla Norfolk'));
        })->call($item165);

        $this->addReference('_reference_ProviderCountry165', $item165);
        $this->sanitizeEntityValues($item165);
        $manager->persist($item165);


        $item166 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("NG");
            $this->setCountryCode("+234");
            $this->setName(new Name('Nigeria', 'Nigeria'));
            $this->setZone(new Zone('Africa', 'Nigeria'));
        })->call($item166);

        $this->addReference('_reference_ProviderCountry166', $item166);
        $this->sanitizeEntityValues($item166);
        $manager->persist($item166);


        $item167 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("NI");
            $this->setCountryCode("+505");
            $this->setName(new Name('Nicaragua', 'Nicaragua'));
            $this->setZone(new Zone('North america', 'Nicaragua'));
        })->call($item167);

        $this->addReference('_reference_ProviderCountry167', $item167);
        $this->sanitizeEntityValues($item167);
        $manager->persist($item167);


        $item168 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("NL");
            $this->setCountryCode("+31");
            $this->setName(new Name('Netherlands', 'Países Bajos'));
            $this->setZone(new Zone('Europe', 'Países Bajos'));
        })->call($item168);

        $this->addReference('_reference_ProviderCountry168', $item168);
        $this->sanitizeEntityValues($item168);
        $manager->persist($item168);


        $item169 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("NO");
            $this->setCountryCode("+47");
            $this->setName(new Name('Norway', 'Noruega'));
            $this->setZone(new Zone('Europe', 'Noruega'));
        })->call($item169);

        $this->addReference('_reference_ProviderCountry169', $item169);
        $this->sanitizeEntityValues($item169);
        $manager->persist($item169);


        $item170 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("NP");
            $this->setCountryCode("+977");
            $this->setName(new Name('Nepal', 'Nepal'));
            $this->setZone(new Zone('Asia', 'Nepal'));
        })->call($item170);

        $this->addReference('_reference_ProviderCountry170', $item170);
        $this->sanitizeEntityValues($item170);
        $manager->persist($item170);


        $item171 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("NR");
            $this->setCountryCode("+674");
            $this->setName(new Name('Nauru', 'Nauru'));
            $this->setZone(new Zone('Oceania', 'Nauru'));
        })->call($item171);

        $this->addReference('_reference_ProviderCountry171', $item171);
        $this->sanitizeEntityValues($item171);
        $manager->persist($item171);


        $item172 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("NU");
            $this->setCountryCode("+683");
            $this->setName(new Name('Niue', 'Niue'));
            $this->setZone(new Zone('Oceania', 'Niue'));
        })->call($item172);

        $this->addReference('_reference_ProviderCountry172', $item172);
        $this->sanitizeEntityValues($item172);
        $manager->persist($item172);


        $item173 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("NZ");
            $this->setCountryCode("+64");
            $this->setName(new Name('New Zealand', 'Nueva Zelanda'));
            $this->setZone(new Zone('Oceania', 'Nueva Zelanda'));
        })->call($item173);

        $this->addReference('_reference_ProviderCountry173', $item173);
        $this->sanitizeEntityValues($item173);
        $manager->persist($item173);


        $item174 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("OM");
            $this->setCountryCode("+968");
            $this->setName(new Name('Oman', 'Omán'));
            $this->setZone(new Zone('Asia', 'Omán'));
        })->call($item174);

        $this->addReference('_reference_ProviderCountry174', $item174);
        $this->sanitizeEntityValues($item174);
        $manager->persist($item174);


        $item175 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("PA");
            $this->setCountryCode("+507");
            $this->setName(new Name('Panama', 'Panamá'));
            $this->setZone(new Zone('North america', 'Panamá'));
        })->call($item175);

        $this->addReference('_reference_ProviderCountry175', $item175);
        $this->sanitizeEntityValues($item175);
        $manager->persist($item175);


        $item176 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("PE");
            $this->setCountryCode("+51");
            $this->setName(new Name('Peru', 'Perú'));
            $this->setZone(new Zone('South america', 'Perú'));
        })->call($item176);

        $this->addReference('_reference_ProviderCountry176', $item176);
        $this->sanitizeEntityValues($item176);
        $manager->persist($item176);


        $item177 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("PF");
            $this->setCountryCode("+689");
            $this->setName(new Name('French Polynesia', 'Polinesia Francesa'));
            $this->setZone(new Zone('Oceania', 'Polinesia Francesa'));
        })->call($item177);

        $this->addReference('_reference_ProviderCountry177', $item177);
        $this->sanitizeEntityValues($item177);
        $manager->persist($item177);


        $item178 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("PG");
            $this->setCountryCode("+675");
            $this->setName(new Name('Papua New Guinea', 'Papúa Nueva Guinea'));
            $this->setZone(new Zone('Oceania', 'Papúa Nueva Guinea'));
        })->call($item178);

        $this->addReference('_reference_ProviderCountry178', $item178);
        $this->sanitizeEntityValues($item178);
        $manager->persist($item178);


        $item179 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("PH");
            $this->setCountryCode("+63");
            $this->setName(new Name('Philippines', 'Filipinas'));
            $this->setZone(new Zone('Asia', 'Filipinas'));
        })->call($item179);

        $this->addReference('_reference_ProviderCountry179', $item179);
        $this->sanitizeEntityValues($item179);
        $manager->persist($item179);


        $item180 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("PK");
            $this->setCountryCode("+92");
            $this->setName(new Name('Pakistan', 'Pakistán'));
            $this->setZone(new Zone('Asia', 'Pakistán'));
        })->call($item180);

        $this->addReference('_reference_ProviderCountry180', $item180);
        $this->sanitizeEntityValues($item180);
        $manager->persist($item180);


        $item181 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("PL");
            $this->setCountryCode("+48");
            $this->setName(new Name('Poland', 'Polonia'));
            $this->setZone(new Zone('Europe', 'Polonia'));
        })->call($item181);

        $this->addReference('_reference_ProviderCountry181', $item181);
        $this->sanitizeEntityValues($item181);
        $manager->persist($item181);


        $item182 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("PM");
            $this->setCountryCode("+508");
            $this->setName(new Name('Saint Pierre and Miquelon', 'San Pedro y Miquelón'));
            $this->setZone(new Zone('North america', 'San Pedro y Miquelón'));
        })->call($item182);

        $this->addReference('_reference_ProviderCountry182', $item182);
        $this->sanitizeEntityValues($item182);
        $manager->persist($item182);


        $item183 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("PN");
            $this->setCountryCode("+870");
            $this->setName(new Name('Pitcairn Islands', 'Islas Pitcairn'));
            $this->setZone(new Zone('Oceania', 'Islas Pitcairn'));
        })->call($item183);

        $this->addReference('_reference_ProviderCountry183', $item183);
        $this->sanitizeEntityValues($item183);
        $manager->persist($item183);


        $item184 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("PR");
            $this->setCountryCode("+1");
            $this->setName(new Name('Puerto Rico', 'Puerto Rico'));
            $this->setZone(new Zone('North america', 'Puerto Rico'));
        })->call($item184);

        $this->addReference('_reference_ProviderCountry184', $item184);
        $this->sanitizeEntityValues($item184);
        $manager->persist($item184);


        $item185 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("PS");
            $this->setCountryCode("+970");
            $this->setName(new Name('Palestine', 'Palestina'));
            $this->setZone(new Zone('Asia', 'Palestina'));
        })->call($item185);

        $this->addReference('_reference_ProviderCountry185', $item185);
        $this->sanitizeEntityValues($item185);
        $manager->persist($item185);


        $item186 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("PT");
            $this->setCountryCode("+351");
            $this->setName(new Name('Portugal', 'Portugal'));
            $this->setZone(new Zone('Europe', 'Portugal'));
        })->call($item186);

        $this->addReference('_reference_ProviderCountry186', $item186);
        $this->sanitizeEntityValues($item186);
        $manager->persist($item186);


        $item187 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("PW");
            $this->setCountryCode("+680");
            $this->setName(new Name('Palau', 'Palau'));
            $this->setZone(new Zone('Oceania', 'Palau'));
        })->call($item187);

        $this->addReference('_reference_ProviderCountry187', $item187);
        $this->sanitizeEntityValues($item187);
        $manager->persist($item187);


        $item188 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("PY");
            $this->setCountryCode("+595");
            $this->setName(new Name('Paraguay', 'Paraguay'));
            $this->setZone(new Zone('South america', 'Paraguay'));
        })->call($item188);

        $this->addReference('_reference_ProviderCountry188', $item188);
        $this->sanitizeEntityValues($item188);
        $manager->persist($item188);


        $item189 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("QA");
            $this->setCountryCode("+974");
            $this->setName(new Name('Qatar', 'Qatar'));
            $this->setZone(new Zone('Asia', 'Qatar'));
        })->call($item189);

        $this->addReference('_reference_ProviderCountry189', $item189);
        $this->sanitizeEntityValues($item189);
        $manager->persist($item189);


        $item190 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("RE");
            $this->setCountryCode("+262");
            $this->setName(new Name('Réunion', 'Reunión'));
            $this->setZone(new Zone('Africa', 'Reunión'));
        })->call($item190);

        $this->addReference('_reference_ProviderCountry190', $item190);
        $this->sanitizeEntityValues($item190);
        $manager->persist($item190);


        $item191 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("RO");
            $this->setCountryCode("+40");
            $this->setName(new Name('Romania', 'Rumanía'));
            $this->setZone(new Zone('Europe', 'Rumanía'));
        })->call($item191);

        $this->addReference('_reference_ProviderCountry191', $item191);
        $this->sanitizeEntityValues($item191);
        $manager->persist($item191);


        $item192 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("RS");
            $this->setCountryCode("+381");
            $this->setName(new Name('Serbia', 'Serbia'));
            $this->setZone(new Zone('Europe', 'Serbia'));
        })->call($item192);

        $this->addReference('_reference_ProviderCountry192', $item192);
        $this->sanitizeEntityValues($item192);
        $manager->persist($item192);


        $item193 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("RU");
            $this->setCountryCode("+7");
            $this->setName(new Name('Russia', 'Rusia'));
            $this->setZone(new Zone('Europe', 'Rusia'));
        })->call($item193);

        $this->addReference('_reference_ProviderCountry193', $item193);
        $this->sanitizeEntityValues($item193);
        $manager->persist($item193);


        $item194 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("RW");
            $this->setCountryCode("+250");
            $this->setName(new Name('Rwanda', 'Ruanda'));
            $this->setZone(new Zone('Africa', 'Ruanda'));
        })->call($item194);

        $this->addReference('_reference_ProviderCountry194', $item194);
        $this->sanitizeEntityValues($item194);
        $manager->persist($item194);


        $item195 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("SA");
            $this->setCountryCode("+966");
            $this->setName(new Name('Saudi Arabia', 'Arabia Saudita'));
            $this->setZone(new Zone('Asia', 'Arabia Saudita'));
        })->call($item195);

        $this->addReference('_reference_ProviderCountry195', $item195);
        $this->sanitizeEntityValues($item195);
        $manager->persist($item195);


        $item196 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("SB");
            $this->setCountryCode("+677");
            $this->setName(new Name('Solomon Islands', 'Islas Salomón'));
            $this->setZone(new Zone('Oceania', 'Islas Salomón'));
        })->call($item196);

        $this->addReference('_reference_ProviderCountry196', $item196);
        $this->sanitizeEntityValues($item196);
        $manager->persist($item196);


        $item197 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("SC");
            $this->setCountryCode("+248");
            $this->setName(new Name('Seychelles', 'Seychelles'));
            $this->setZone(new Zone('Africa', 'Seychelles'));
        })->call($item197);

        $this->addReference('_reference_ProviderCountry197', $item197);
        $this->sanitizeEntityValues($item197);
        $manager->persist($item197);


        $item198 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("SD");
            $this->setCountryCode("+249");
            $this->setName(new Name('Sudan', 'Sudán'));
            $this->setZone(new Zone('Africa', 'Sudán'));
        })->call($item198);

        $this->addReference('_reference_ProviderCountry198', $item198);
        $this->sanitizeEntityValues($item198);
        $manager->persist($item198);


        $item199 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("SE");
            $this->setCountryCode("+46");
            $this->setName(new Name('Sweden', 'Suecia'));
            $this->setZone(new Zone('Europe', 'Suecia'));
        })->call($item199);

        $this->addReference('_reference_ProviderCountry199', $item199);
        $this->sanitizeEntityValues($item199);
        $manager->persist($item199);


        $item200 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("SG");
            $this->setCountryCode("+65");
            $this->setName(new Name('Singapore', 'Singapur'));
            $this->setZone(new Zone('Asia', 'Singapur'));
        })->call($item200);

        $this->addReference('_reference_ProviderCountry200', $item200);
        $this->sanitizeEntityValues($item200);
        $manager->persist($item200);


        $item201 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("SH");
            $this->setCountryCode("+290");
            $this->setName(new Name('Ascensión y Tristán de Acuña', 'Santa Elena'));
            $this->setZone(new Zone('Africa', 'Santa Elena'));
        })->call($item201);

        $this->addReference('_reference_ProviderCountry201', $item201);
        $this->sanitizeEntityValues($item201);
        $manager->persist($item201);


        $item202 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("SI");
            $this->setCountryCode("+386");
            $this->setName(new Name('Slovenia', 'Eslovenia'));
            $this->setZone(new Zone('Europe', 'Eslovenia'));
        })->call($item202);

        $this->addReference('_reference_ProviderCountry202', $item202);
        $this->sanitizeEntityValues($item202);
        $manager->persist($item202);


        $item203 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("SJ");
            $this->setCountryCode("+47");
            $this->setName(new Name('Svalbard and Jan Mayen', 'Svalbard y Jan Mayen'));
            $this->setZone(new Zone('Europe', 'Svalbard y Jan Mayen'));
        })->call($item203);

        $this->addReference('_reference_ProviderCountry203', $item203);
        $this->sanitizeEntityValues($item203);
        $manager->persist($item203);


        $item204 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("SK");
            $this->setCountryCode("+421");
            $this->setName(new Name('Slovakia', 'Eslovaquia'));
            $this->setZone(new Zone('Europe', 'Eslovaquia'));
        })->call($item204);

        $this->addReference('_reference_ProviderCountry204', $item204);
        $this->sanitizeEntityValues($item204);
        $manager->persist($item204);


        $item205 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("SL");
            $this->setCountryCode("+232");
            $this->setName(new Name('Sierra Leone', 'Sierra Leona'));
            $this->setZone(new Zone('Africa', 'Sierra Leona'));
        })->call($item205);

        $this->addReference('_reference_ProviderCountry205', $item205);
        $this->sanitizeEntityValues($item205);
        $manager->persist($item205);


        $item206 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("SM");
            $this->setCountryCode("+378");
            $this->setName(new Name('San Marino', 'San Marino'));
            $this->setZone(new Zone('Europe', 'San Marino'));
        })->call($item206);

        $this->addReference('_reference_ProviderCountry206', $item206);
        $this->sanitizeEntityValues($item206);
        $manager->persist($item206);


        $item207 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("SN");
            $this->setCountryCode("+221");
            $this->setName(new Name('Senegal', 'Senegal'));
            $this->setZone(new Zone('Africa', 'Senegal'));
        })->call($item207);

        $this->addReference('_reference_ProviderCountry207', $item207);
        $this->sanitizeEntityValues($item207);
        $manager->persist($item207);


        $item208 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("SO");
            $this->setCountryCode("+252");
            $this->setName(new Name('Somalia', 'Somalia'));
            $this->setZone(new Zone('Africa', 'Somalia'));
        })->call($item208);

        $this->addReference('_reference_ProviderCountry208', $item208);
        $this->sanitizeEntityValues($item208);
        $manager->persist($item208);


        $item209 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("SR");
            $this->setCountryCode("+597");
            $this->setName(new Name('Suriname', 'Surinám'));
            $this->setZone(new Zone('South america', 'Surinám'));
        })->call($item209);

        $this->addReference('_reference_ProviderCountry209', $item209);
        $this->sanitizeEntityValues($item209);
        $manager->persist($item209);


        $item210 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("SS");
            $this->setCountryCode("+211");
            $this->setName(new Name('South Sudan', 'Sudán del Sur'));
            $this->setZone(new Zone('Africa', 'Sudán del Sur'));
        })->call($item210);

        $this->addReference('_reference_ProviderCountry210', $item210);
        $this->sanitizeEntityValues($item210);
        $manager->persist($item210);


        $item211 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("ST");
            $this->setCountryCode("+239");
            $this->setName(new Name('Sao Tome and Principe', 'Santo Tomé y Príncipe'));
            $this->setZone(new Zone('Africa', 'Santo Tomé y Príncipe'));
        })->call($item211);

        $this->addReference('_reference_ProviderCountry211', $item211);
        $this->sanitizeEntityValues($item211);
        $manager->persist($item211);


        $item212 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("SV");
            $this->setCountryCode("+503");
            $this->setName(new Name('El Salvador', 'El Salvador'));
            $this->setZone(new Zone('North america', 'El Salvador'));
        })->call($item212);

        $this->addReference('_reference_ProviderCountry212', $item212);
        $this->sanitizeEntityValues($item212);
        $manager->persist($item212);


        $item213 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("SX");
            $this->setCountryCode("+1721");
            $this->setName(new Name('Sint Maarten (Dutch part)', 'Sint Maarten (parte neerlandesa)'));
            $this->setZone(new Zone('North america', 'Sint Maarten (parte neerlandesa)'));
        })->call($item213);

        $this->addReference('_reference_ProviderCountry213', $item213);
        $this->sanitizeEntityValues($item213);
        $manager->persist($item213);


        $item214 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("SY");
            $this->setCountryCode("+963");
            $this->setName(new Name('Syria', 'Siria'));
            $this->setZone(new Zone('Asia', 'Siria'));
        })->call($item214);

        $this->addReference('_reference_ProviderCountry214', $item214);
        $this->sanitizeEntityValues($item214);
        $manager->persist($item214);


        $item215 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("SZ");
            $this->setCountryCode("+268");
            $this->setName(new Name('Swaziland', 'Swazilandia'));
            $this->setZone(new Zone('Africa', 'Swazilandia'));
        })->call($item215);

        $this->addReference('_reference_ProviderCountry215', $item215);
        $this->sanitizeEntityValues($item215);
        $manager->persist($item215);


        $item216 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("TC");
            $this->setCountryCode("+1649");
            $this->setName(new Name('Turks and Caicos Islands', 'Islas Turcas y Caicos'));
            $this->setZone(new Zone('North america', 'Islas Turcas y Caicos'));
        })->call($item216);

        $this->addReference('_reference_ProviderCountry216', $item216);
        $this->sanitizeEntityValues($item216);
        $manager->persist($item216);


        $item217 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("TD");
            $this->setCountryCode("+235");
            $this->setName(new Name('Chad', 'Chad'));
            $this->setZone(new Zone('Africa', 'Chad'));
        })->call($item217);

        $this->addReference('_reference_ProviderCountry217', $item217);
        $this->sanitizeEntityValues($item217);
        $manager->persist($item217);


        $item218 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("TF");
            $this->setCountryCode("+262");
            $this->setName(new Name('French Southern Territories', 'Territorios Australes y Antárticas Franceses'));
            $this->setZone(new Zone('Antarctica', 'Territorios Australes y Antárticas Franceses'));
        })->call($item218);

        $this->addReference('_reference_ProviderCountry218', $item218);
        $this->sanitizeEntityValues($item218);
        $manager->persist($item218);


        $item219 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("TG");
            $this->setCountryCode("+228");
            $this->setName(new Name('Togo', 'Togo'));
            $this->setZone(new Zone('Africa', 'Togo'));
        })->call($item219);

        $this->addReference('_reference_ProviderCountry219', $item219);
        $this->sanitizeEntityValues($item219);
        $manager->persist($item219);


        $item220 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("TH");
            $this->setCountryCode("+66");
            $this->setName(new Name('Thailand', 'Tailandia'));
            $this->setZone(new Zone('Asia', 'Tailandia'));
        })->call($item220);

        $this->addReference('_reference_ProviderCountry220', $item220);
        $this->sanitizeEntityValues($item220);
        $manager->persist($item220);


        $item221 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("TJ");
            $this->setCountryCode("+992");
            $this->setName(new Name('Tajikistan', 'Tadjikistán'));
            $this->setZone(new Zone('Asia', 'Tadjikistán'));
        })->call($item221);

        $this->addReference('_reference_ProviderCountry221', $item221);
        $this->sanitizeEntityValues($item221);
        $manager->persist($item221);


        $item222 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("TK");
            $this->setCountryCode("+690");
            $this->setName(new Name('Tokelau', 'Tokelau'));
            $this->setZone(new Zone('Oceania', 'Tokelau'));
        })->call($item222);

        $this->addReference('_reference_ProviderCountry222', $item222);
        $this->sanitizeEntityValues($item222);
        $manager->persist($item222);


        $item223 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("TL");
            $this->setCountryCode("+670");
            $this->setName(new Name('East Timor', 'Timor Oriental'));
            $this->setZone(new Zone('Asia', 'Timor Oriental'));
        })->call($item223);

        $this->addReference('_reference_ProviderCountry223', $item223);
        $this->sanitizeEntityValues($item223);
        $manager->persist($item223);


        $item224 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("TM");
            $this->setCountryCode("+993");
            $this->setName(new Name('Turkmenistan', 'Turkmenistán'));
            $this->setZone(new Zone('Asia', 'Turkmenistán'));
        })->call($item224);

        $this->addReference('_reference_ProviderCountry224', $item224);
        $this->sanitizeEntityValues($item224);
        $manager->persist($item224);


        $item225 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("TN");
            $this->setCountryCode("+216");
            $this->setName(new Name('Tunisia', 'Tunez'));
            $this->setZone(new Zone('Africa', 'Tunez'));
        })->call($item225);

        $this->addReference('_reference_ProviderCountry225', $item225);
        $this->sanitizeEntityValues($item225);
        $manager->persist($item225);


        $item226 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("TO");
            $this->setCountryCode("+676");
            $this->setName(new Name('Tonga', 'Tonga'));
            $this->setZone(new Zone('Oceania', 'Tonga'));
        })->call($item226);

        $this->addReference('_reference_ProviderCountry226', $item226);
        $this->sanitizeEntityValues($item226);
        $manager->persist($item226);


        $item227 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("TR");
            $this->setCountryCode("+90");
            $this->setName(new Name('Turkey', 'Turquía'));
            $this->setZone(new Zone('Europe', 'Turquía'));
        })->call($item227);

        $this->addReference('_reference_ProviderCountry227', $item227);
        $this->sanitizeEntityValues($item227);
        $manager->persist($item227);


        $item228 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("TT");
            $this->setCountryCode("+1868");
            $this->setName(new Name('Trinidad and Tobago', 'Trinidad y Tobago'));
            $this->setZone(new Zone('North america', 'Trinidad y Tobago'));
        })->call($item228);

        $this->addReference('_reference_ProviderCountry228', $item228);
        $this->sanitizeEntityValues($item228);
        $manager->persist($item228);


        $item229 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("TV");
            $this->setCountryCode("+688");
            $this->setName(new Name('Tuvalu', 'Tuvalu'));
            $this->setZone(new Zone('Oceania', 'Tuvalu'));
        })->call($item229);

        $this->addReference('_reference_ProviderCountry229', $item229);
        $this->sanitizeEntityValues($item229);
        $manager->persist($item229);


        $item230 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("TW");
            $this->setCountryCode("+886");
            $this->setName(new Name('Taiwan', 'Taiwán'));
            $this->setZone(new Zone('Asia', 'Taiwán'));
        })->call($item230);

        $this->addReference('_reference_ProviderCountry230', $item230);
        $this->sanitizeEntityValues($item230);
        $manager->persist($item230);


        $item231 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("TZ");
            $this->setCountryCode("+255");
            $this->setName(new Name('Tanzania', 'Tanzania'));
            $this->setZone(new Zone('Africa', 'Tanzania'));
        })->call($item231);

        $this->addReference('_reference_ProviderCountry231', $item231);
        $this->sanitizeEntityValues($item231);
        $manager->persist($item231);


        $item232 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("UA");
            $this->setCountryCode("+380");
            $this->setName(new Name('Ukraine', 'Ucrania'));
            $this->setZone(new Zone('Europe', 'Ucrania'));
        })->call($item232);

        $this->addReference('_reference_ProviderCountry232', $item232);
        $this->sanitizeEntityValues($item232);
        $manager->persist($item232);


        $item233 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("UG");
            $this->setCountryCode("+256");
            $this->setName(new Name('Uganda', 'Uganda'));
            $this->setZone(new Zone('Africa', 'Uganda'));
        })->call($item233);

        $this->addReference('_reference_ProviderCountry233', $item233);
        $this->sanitizeEntityValues($item233);
        $manager->persist($item233);


        $item234 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("UM");
            $this->setCountryCode("+1");
            $this->setName(new Name('United States Minor Outlying Islands', 'Islas Ultramarinas Menores de Estados Unidos'));
            $this->setZone(new Zone('Oceania', 'Islas Ultramarinas Menores de Estados Unidos'));
        })->call($item234);

        $this->addReference('_reference_ProviderCountry234', $item234);
        $this->sanitizeEntityValues($item234);
        $manager->persist($item234);


        $item235 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("US");
            $this->setCountryCode("+1");
            $this->setName(new Name('United States of America', 'Estados Unidos de América'));
            $this->setZone(new Zone('North america', 'Estados Unidos de América'));
        })->call($item235);

        $this->addReference('_reference_ProviderCountry235', $item235);
        $this->sanitizeEntityValues($item235);
        $manager->persist($item235);


        $item236 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("UY");
            $this->setCountryCode("+598");
            $this->setName(new Name('Uruguay', 'Uruguay'));
            $this->setZone(new Zone('South america', 'Uruguay'));
        })->call($item236);

        $this->addReference('_reference_ProviderCountry236', $item236);
        $this->sanitizeEntityValues($item236);
        $manager->persist($item236);


        $item237 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("UZ");
            $this->setCountryCode("+998");
            $this->setName(new Name('Uzbekistan', 'Uzbekistán'));
            $this->setZone(new Zone('Asia', 'Uzbekistán'));
        })->call($item237);

        $this->addReference('_reference_ProviderCountry237', $item237);
        $this->sanitizeEntityValues($item237);
        $manager->persist($item237);


        $item238 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("VA");
            $this->setCountryCode("+39");
            $this->setName(new Name('Vatican City State', 'Ciudad del Vaticano'));
            $this->setZone(new Zone('Europe', 'Ciudad del Vaticano'));
        })->call($item238);

        $this->addReference('_reference_ProviderCountry238', $item238);
        $this->sanitizeEntityValues($item238);
        $manager->persist($item238);


        $item239 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("VC");
            $this->setCountryCode("+1784");
            $this->setName(new Name('Saint Vincent and the Grenadines', 'San Vicente y las Granadinas'));
            $this->setZone(new Zone('North america', 'San Vicente y las Granadinas'));
        })->call($item239);

        $this->addReference('_reference_ProviderCountry239', $item239);
        $this->sanitizeEntityValues($item239);
        $manager->persist($item239);


        $item240 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("VE");
            $this->setCountryCode("+58");
            $this->setName(new Name('Venezuela', 'Venezuela'));
            $this->setZone(new Zone('South america', 'Venezuela'));
        })->call($item240);

        $this->addReference('_reference_ProviderCountry240', $item240);
        $this->sanitizeEntityValues($item240);
        $manager->persist($item240);


        $item241 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("VG");
            $this->setCountryCode("+1284");
            $this->setName(new Name('Virgin Islands', 'Islas Vírgenes Británicas'));
            $this->setZone(new Zone('North america', 'Islas Vírgenes Británicas'));
        })->call($item241);

        $this->addReference('_reference_ProviderCountry241', $item241);
        $this->sanitizeEntityValues($item241);
        $manager->persist($item241);


        $item242 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("VI");
            $this->setCountryCode("+1340");
            $this->setName(new Name('United States Virgin Islands', 'Islas Vírgenes de los Estados Unidos'));
            $this->setZone(new Zone('North america', 'Islas Vírgenes de los Estados Unidos'));
        })->call($item242);

        $this->addReference('_reference_ProviderCountry242', $item242);
        $this->sanitizeEntityValues($item242);
        $manager->persist($item242);


        $item243 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("VN");
            $this->setCountryCode("+84");
            $this->setName(new Name('Vietnam', 'Vietnam'));
            $this->setZone(new Zone('Asia', 'Vietnam'));
        })->call($item243);

        $this->addReference('_reference_ProviderCountry243', $item243);
        $this->sanitizeEntityValues($item243);
        $manager->persist($item243);


        $item244 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("VU");
            $this->setCountryCode("+678");
            $this->setName(new Name('Vanuatu', 'Vanuatu'));
            $this->setZone(new Zone('Oceania', 'Vanuatu'));
        })->call($item244);

        $this->addReference('_reference_ProviderCountry244', $item244);
        $this->sanitizeEntityValues($item244);
        $manager->persist($item244);


        $item245 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("WF");
            $this->setCountryCode("+681");
            $this->setName(new Name('Wallis and Futuna', 'Wallis y Futuna'));
            $this->setZone(new Zone('Oceania', 'Wallis y Futuna'));
        })->call($item245);

        $this->addReference('_reference_ProviderCountry245', $item245);
        $this->sanitizeEntityValues($item245);
        $manager->persist($item245);


        $item246 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("WS");
            $this->setCountryCode("+685");
            $this->setName(new Name('Samoa', 'Samoa'));
            $this->setZone(new Zone('Oceania', 'Samoa'));
        })->call($item246);

        $this->addReference('_reference_ProviderCountry246', $item246);
        $this->sanitizeEntityValues($item246);
        $manager->persist($item246);


        $item247 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("YE");
            $this->setCountryCode("+967");
            $this->setName(new Name('Yemen', 'Yemen'));
            $this->setZone(new Zone('Asia', 'Yemen'));
        })->call($item247);

        $this->addReference('_reference_ProviderCountry247', $item247);
        $this->sanitizeEntityValues($item247);
        $manager->persist($item247);


        $item248 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("YT");
            $this->setCountryCode("+262");
            $this->setName(new Name('Mayotte', 'Mayotte'));
            $this->setZone(new Zone('Africa', 'Mayotte'));
        })->call($item248);

        $this->addReference('_reference_ProviderCountry248', $item248);
        $this->sanitizeEntityValues($item248);
        $manager->persist($item248);


        $item249 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("ZA");
            $this->setCountryCode("+27");
            $this->setName(new Name('South Africa', 'Sudáfrica'));
            $this->setZone(new Zone('Africa', 'Sudáfrica'));
        })->call($item249);

        $this->addReference('_reference_ProviderCountry249', $item249);
        $this->sanitizeEntityValues($item249);
        $manager->persist($item249);


        $item250 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("ZM");
            $this->setCountryCode("+260");
            $this->setName(new Name('Zambia', 'Zambia'));
            $this->setZone(new Zone('Africa', 'Zambia'));
        })->call($item250);

        $this->addReference('_reference_ProviderCountry250', $item250);
        $this->sanitizeEntityValues($item250);
        $manager->persist($item250);


        $item251 = $this->createEntityInstance(Country::class);
        (function () {
            $this->setCode("ZW");
            $this->setCountryCode("+263");
            $this->setName(new Name('Zimbabwe', 'Zimbabue'));
            $this->setZone(new Zone('Africa', 'Zimbabue'));
        })->call($item251);

        $this->addReference('_reference_ProviderCountry251', $item251);
        $this->sanitizeEntityValues($item251);
        $manager->persist($item251);


        $manager->flush();
    }
}
