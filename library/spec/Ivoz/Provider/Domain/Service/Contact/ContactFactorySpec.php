<?php

namespace spec\Ivoz\Provider\Domain\Service\Contact;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Contact\Contact;
use Ivoz\Provider\Domain\Model\Contact\ContactDto;
use Ivoz\Provider\Domain\Model\Contact\ContactRepository;
use Ivoz\Provider\Domain\Model\Country\Country;
use Ivoz\Provider\Domain\Model\Country\CountryRepository;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Service\Contact\ContactFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class ContactFactorySpec extends ObjectBehavior
{
    use HelperTrait;

    private const COMPANY_COUNTRY_ID = 68;

    protected $contactRepository;
    protected $countryRepository;
    protected $entityTools;
    protected $company;

    public function let(
        ContactRepository $contactRepository,
        CountryRepository $countryRepository,
        EntityTools $entityTools
    ) {
        $this->contactRepository = $contactRepository;
        $this->countryRepository = $countryRepository;
        $this->entityTools = $entityTools;

        $this->company = $this->getInstance(
            Company::class,
            [
                'id' => 1,
                'country' => $this->getInstance(
                    Country::class,
                    ['id' => self::COMPANY_COUNTRY_ID]
                ),
            ]
        );

        $this->beConstructedWith(
            $this->contactRepository,
            $this->countryRepository,
            $this->entityTools
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ContactFactory::class);
    }

    function it_creates_a_contact_when_the_id_is_empty()
    {
        $this
            ->contactRepository
            ->find(Argument::any())
            ->shouldNotBeCalled();

        $this->expectContact(function (ContactDto $dto): bool {
            return $dto->getCompanyId() === 1
                && $dto->getName() === 'Juan'
                && $dto->getLastname() === 'Pérez'
                && $dto->getEmail() === null
                && $dto->getOtherPhone() === 'Fax 2010';
        }, null);

        $this->fromMassProvisioningCsv(
            $this->company,
            [
                'id' => '',
                'name' => 'Juan',
                'lastname' => 'Pérez',
                'email' => '',
                'otherPhone' => 'Fax 2010',
            ]
        );
    }

    function it_resolves_phone_countries_by_iso_code()
    {
        $this
            ->countryRepository
            ->findOneByCode('FR')
            ->willReturn(
                $this->getInstance(Country::class, ['id' => 75])
            );

        $this->expectContact(function (ContactDto $dto): bool {
            return $dto->getWorkPhone() === '144000000'
                && $dto->getWorkPhoneCountryId() === 75;
        }, null);

        $this->fromMassProvisioningCsv(
            $this->company,
            [
                'name' => 'Ana',
                'workPhoneCountry' => 'FR',
                'workPhone' => '144000000',
            ]
        );
    }

    function it_uses_the_company_country_for_phones_without_country()
    {
        $this->expectContact(function (ContactDto $dto): bool {
            return $dto->getWorkPhoneCountryId() === self::COMPANY_COUNTRY_ID
                && $dto->getMobilePhoneCountryId() === self::COMPANY_COUNTRY_ID;
        }, null);

        $this->fromMassProvisioningCsv(
            $this->company,
            [
                'name' => 'Ana',
                'workPhoneCountry' => '',
                'workPhone' => '944048182',
                'mobilePhone' => '600000000',
            ]
        );
    }

    function it_rejects_unknown_country_codes()
    {
        $this
            ->countryRepository
            ->findOneByCode('XX')
            ->willReturn(null);

        $this
            ->shouldThrow(new \DomainException('Country XX not found'))
            ->during(
                'fromMassProvisioningCsv',
                [$this->company, ['name' => 'Ana', 'workPhoneCountry' => 'XX', 'workPhone' => '1']]
            );
    }

    function it_requires_a_name_to_create_a_contact()
    {
        $this
            ->shouldThrow(new \DomainException('Name is required to create a contact'))
            ->during(
                'fromMassProvisioningCsv',
                [$this->company, ['id' => '', 'lastname' => 'Pérez']]
            );
    }

    function it_does_not_allow_emptying_the_name()
    {
        $this->givenContact(1, null);

        $this
            ->shouldThrow(new \DomainException('Name cannot be empty'))
            ->during(
                'fromMassProvisioningCsv',
                [$this->company, ['id' => '1', 'name' => '']]
            );
    }

    function it_rejects_ids_that_do_not_exist()
    {
        $this
            ->contactRepository
            ->find(9999)
            ->willReturn(null);

        $this
            ->entityTools
            ->entityToDto(Argument::any())
            ->shouldNotBeCalled();

        $this
            ->shouldThrow(new \DomainException('Contact 9999 not found'))
            ->during(
                'fromMassProvisioningCsv',
                [$this->company, ['id' => '9999', 'name' => 'Ana']]
            );
    }

    function it_rejects_contacts_of_other_clients_with_the_same_message()
    {
        $this
            ->contactRepository
            ->find(4)
            ->willReturn(
                $this->getInstance(
                    Contact::class,
                    [
                        'id' => 4,
                        'company' => $this->getInstance(Company::class, ['id' => 2]),
                    ]
                )
            );

        $this
            ->entityTools
            ->entityToDto(Argument::any())
            ->shouldNotBeCalled();

        $this
            ->shouldThrow(new \DomainException('Contact 4 not found'))
            ->during(
                'fromMassProvisioningCsv',
                [$this->company, ['id' => '4', 'name' => 'Ana']]
            );
    }

    function it_only_updates_the_columns_in_the_header()
    {
        $contact = $this->givenContact(1, null);

        $this->expectContact(function (ContactDto $dto): bool {
            return $dto->getName() === 'New name'
                && $dto->getLastname() === 'Current lastname'
                && $dto->getEmail() === 'current@example.com'
                && $dto->getWorkPhone() === '944000001'
                && $dto->getWorkPhoneCountryId() === 70;
        }, $contact);

        $this->fromMassProvisioningCsv(
            $this->company,
            ['id' => '1', 'name' => 'New name']
        );
    }

    function it_clears_the_fields_of_empty_columns()
    {
        $contact = $this->givenContact(1, null);

        $this->expectContact(function (ContactDto $dto): bool {
            return $dto->getEmail() === null
                && $dto->getOtherPhone() === null
                && $dto->getWorkPhone() === null;
        }, $contact);

        $this->fromMassProvisioningCsv(
            $this->company,
            ['id' => '1', 'email' => '', 'otherPhone' => '', 'workPhone' => '']
        );
    }

    function it_only_updates_the_phones_of_contacts_linked_to_a_user()
    {
        $contact = $this->givenContact(
            2,
            $this->getInstance(User::class, ['id' => 1])
        );

        $this->expectContact(function (ContactDto $dto): bool {
            return $dto->getName() === 'Current name'
                && $dto->getLastname() === 'Current lastname'
                && $dto->getEmail() === 'current@example.com'
                && $dto->getOtherPhone() === '101'
                && $dto->getWorkPhone() === '944000333'
                && $dto->getMobilePhone() === '600000333';
        }, $contact);

        $this->fromMassProvisioningCsv(
            $this->company,
            [
                'id' => '2',
                'name' => '',
                'lastname' => 'Ignored',
                'email' => 'ignored@example.com',
                'otherPhone' => '',
                'workPhone' => '944000333',
                'mobilePhone' => '600000333',
            ]
        );
    }

    /**
     * @param User|null $user
     */
    private function givenContact(int $id, $user): Contact
    {
        $contact = $this->getInstance(
            Contact::class,
            [
                'id' => $id,
                'company' => $this->company,
                'user' => $user,
            ]
        );

        $this
            ->contactRepository
            ->find($id)
            ->willReturn($contact);

        $contactDto = (new ContactDto($id))
            ->setCompanyId(1)
            ->setName('Current name')
            ->setLastname('Current lastname')
            ->setEmail('current@example.com')
            ->setOtherPhone('101')
            ->setWorkPhone('944000001')
            ->setWorkPhoneCountryId(70);

        $this
            ->entityTools
            ->entityToDto($contact)
            ->willReturn($contactDto);

        return $contact;
    }

    /**
     * @param Contact|null $contact
     */
    private function expectContact(callable $dtoMatcher, $contact): void
    {
        $this
            ->entityTools
            ->dtoToEntity(
                Argument::that($dtoMatcher),
                $contact
            )
            ->shouldBeCalled()
            ->willReturn(
                $contact ?? $this->getInstance(Contact::class)
            );
    }
}
