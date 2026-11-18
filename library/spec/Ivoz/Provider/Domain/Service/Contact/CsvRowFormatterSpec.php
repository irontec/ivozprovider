<?php

namespace spec\Ivoz\Provider\Domain\Service\Contact;

use Ivoz\Provider\Domain\Model\Contact\ContactDto;
use Ivoz\Provider\Domain\Model\Country\Country;
use Ivoz\Provider\Domain\Model\Country\CountryRepository;
use Ivoz\Provider\Domain\Service\Contact\CsvRowFormatter;
use Ivoz\Provider\Domain\Service\Contact\CsvStaticValidator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class CsvRowFormatterSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $countryRepository;

    public function let(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;

        $this->beConstructedWith($this->countryRepository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CsvRowFormatter::class);
    }

    function it_formats_the_import_columns_in_order_with_iso_countries()
    {
        $this
            ->countryRepository
            ->find(68)
            ->willReturn($this->getInstance(Country::class, ['id' => 68, 'code' => 'ES']));

        $this
            ->countryRepository
            ->find(73)
            ->willReturn($this->getInstance(Country::class, ['id' => 73, 'code' => 'FR']));

        $contactDto = (new ContactDto(7))
            ->setName('Ana')
            ->setLastname('García')
            ->setEmail('ana@example.com')
            ->setWorkPhone('944048182')
            ->setWorkPhoneE164('+34944048182')
            ->setWorkPhoneCountryId(68)
            ->setMobilePhone('600000000')
            ->setMobilePhoneE164('+33600000000')
            ->setMobilePhoneCountryId(73)
            ->setOtherPhone('Fax 2010')
            ->setUserId(3);

        $row = $this->execute($contactDto);

        $row->shouldBe([
            'id' => 7,
            'name' => 'Ana',
            'lastname' => 'García',
            'email' => 'ana@example.com',
            'workPhoneCountry' => 'ES',
            'workPhone' => '944048182',
            'mobilePhoneCountry' => 'FR',
            'mobilePhone' => '600000000',
            'otherPhone' => 'Fax 2010',
        ]);
        $row->shouldHaveKeysInOrder(CsvStaticValidator::COLUMNS);
    }

    function it_leaves_missing_values_empty()
    {
        $this
            ->countryRepository
            ->find(Argument::any())
            ->shouldNotBeCalled();

        $contactDto = (new ContactDto(8))
            ->setName('Juan');

        $this
            ->execute($contactDto)
            ->shouldBe([
                'id' => 8,
                'name' => 'Juan',
                'lastname' => '',
                'email' => '',
                'workPhoneCountry' => '',
                'workPhone' => '',
                'mobilePhoneCountry' => '',
                'mobilePhone' => '',
                'otherPhone' => '',
            ]);
    }

    public function getMatchers(): array
    {
        return [
            'haveKeysInOrder' => function (array $subject, array $keys): bool {
                return array_keys($subject) === $keys;
            },
        ];
    }
}
