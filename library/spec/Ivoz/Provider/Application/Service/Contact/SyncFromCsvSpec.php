<?php

namespace spec\Ivoz\Provider\Application\Service\Contact;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Application\Service\Contact\SyncFromCsv;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Contact\Contact;
use Ivoz\Provider\Domain\Service\Contact\ContactFactory;
use Ivoz\Provider\Domain\Service\Contact\CsvRowsParser;
use Ivoz\Provider\Domain\Service\Contact\CsvStaticValidator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class SyncFromCsvSpec extends ObjectBehavior
{
    use HelperTrait;

    private const CSV = "id,name\n,Ana\n\n1,Juan";

    protected $contactFactory;
    protected $entityTools;
    protected $csvStaticValidator;
    protected $csvRowsParser;
    protected $company;

    public function let(
        ContactFactory $contactFactory,
        EntityTools $entityTools,
        CsvStaticValidator $csvStaticValidator,
        CsvRowsParser $csvRowsParser
    ) {
        $this->contactFactory = $contactFactory;
        $this->entityTools = $entityTools;
        $this->csvStaticValidator = $csvStaticValidator;
        $this->csvRowsParser = $csvRowsParser;

        $this->company = $this->getInstance(Company::class, ['id' => 1]);

        $this
            ->csvRowsParser
            ->parse(self::CSV)
            ->willReturn([
                0 => ['id', 'name'],
                1 => ['', 'Ana'],
                3 => ['1', 'Juan'],
            ]);

        $this->beConstructedWith(
            $this->contactFactory,
            $this->entityTools,
            $this->csvStaticValidator,
            $this->csvRowsParser
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SyncFromCsv::class);
    }

    function it_validates_the_header()
    {
        $this->givenImportedContacts();

        $this
            ->csvStaticValidator
            ->execute(['id', 'name'])
            ->shouldBeCalled();

        $this->execute($this->company, self::CSV);
    }

    function it_creates_and_updates_contacts_by_column_name()
    {
        [$newContact, $existingContact] = $this->givenImportedContacts();

        $this
            ->entityTools
            ->persist($newContact, true)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persist($existingContact, true)
            ->shouldBeCalled();

        $result = $this->execute($this->company, self::CSV);

        $result->getCreatedCount()->shouldBe(1);
        $result->getUpdatedCount()->shouldBe(1);
        $result->getErrors()->shouldBe([]);
    }

    function it_reports_failed_rows_with_their_file_line_and_keeps_the_valid_ones()
    {
        $newContact = $this->getInstance(Contact::class);

        $this
            ->contactFactory
            ->fromMassProvisioningCsv($this->company, ['id' => '', 'name' => 'Ana'])
            ->willReturn($newContact);

        $this
            ->contactFactory
            ->fromMassProvisioningCsv($this->company, ['id' => '1', 'name' => 'Juan'])
            ->willThrow(new \DomainException('Contact 1 not found'));

        $this
            ->entityTools
            ->persist($newContact, true)
            ->shouldBeCalled();

        $result = $this->execute($this->company, self::CSV);

        $result->getCreatedCount()->shouldBe(1);
        $result->getUpdatedCount()->shouldBe(0);
        $result->getErrors()->shouldBe([
            ['line' => 4, 'message' => 'Contact 1 not found'],
        ]);
    }

    function it_reports_invalid_entity_values_as_row_errors()
    {
        $this
            ->contactFactory
            ->fromMassProvisioningCsv(Argument::cetera())
            ->willThrow(new \InvalidArgumentException('Invalid email'));

        $result = $this->execute($this->company, self::CSV);

        $result->getErrors()->shouldBe([
            ['line' => 2, 'message' => 'Invalid email'],
            ['line' => 4, 'message' => 'Invalid email'],
        ]);
    }

    function it_rejects_rows_with_a_different_number_of_columns()
    {
        $this
            ->csvRowsParser
            ->parse('csv')
            ->willReturn([
                0 => ['id', 'name'],
                1 => [''],
            ]);

        $this
            ->contactFactory
            ->fromMassProvisioningCsv(Argument::cetera())
            ->shouldNotBeCalled();

        $result = $this->execute($this->company, 'csv');

        $result->getErrors()->shouldBe([
            ['line' => 2, 'message' => '2 columns were expected but 1 found'],
        ]);
    }

    function it_reports_file_errors_at_line_zero_and_imports_nothing()
    {
        $this
            ->csvStaticValidator
            ->execute(Argument::any())
            ->willThrow(new \DomainException('Unknown column "foo" in the header'));

        $this
            ->contactFactory
            ->fromMassProvisioningCsv(Argument::cetera())
            ->shouldNotBeCalled();

        $result = $this->execute($this->company, self::CSV);

        $result->getCreatedCount()->shouldBe(0);
        $result->getErrors()->shouldBe([
            ['line' => 0, 'message' => 'Unknown column "foo" in the header'],
        ]);
    }

    /**
     * @return Contact[]
     */
    private function givenImportedContacts(): array
    {
        $newContact = $this->getInstance(Contact::class);
        $existingContact = $this->getInstance(Contact::class, ['id' => 1]);

        $this
            ->contactFactory
            ->fromMassProvisioningCsv($this->company, ['id' => '', 'name' => 'Ana'])
            ->willReturn($newContact);

        $this
            ->contactFactory
            ->fromMassProvisioningCsv($this->company, ['id' => '1', 'name' => 'Juan'])
            ->willReturn($existingContact);

        return [$newContact, $existingContact];
    }
}
