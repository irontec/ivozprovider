<?php

namespace spec\Ivoz\Provider\Application\Service\User;

use Ivoz\Provider\Application\Service\User\ExportToCsv;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\User\UserRepository;
use Ivoz\Provider\Domain\Service\User\CsvRowFormatter;
use Ivoz\Provider\Domain\Service\User\CsvRowsWriter;
use Ivoz\Provider\Domain\Service\User\CsvStaticValidator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class ExportToCsvSpec extends ObjectBehavior
{
    use HelperTrait;

    private const ALICE = ['Alice', 'Allison', 'alice@example.com', 'alice_t21', '', 'YealinkT21P_E2', '', '301', '', '', ''];
    private const BOB = ['Bob', 'Bobson', '', '', '', '', '', '', '', '', ''];

    protected $userRepository;
    protected $csvRowFormatter;
    protected $csvStaticValidator;
    protected $csvRowsWriter;
    protected $company;
    protected $alice;
    protected $bob;

    public function let(
        UserRepository $userRepository,
        CsvRowFormatter $csvRowFormatter,
        CsvStaticValidator $csvStaticValidator,
        CsvRowsWriter $csvRowsWriter
    ) {
        $this->userRepository = $userRepository;
        $this->csvRowFormatter = $csvRowFormatter;
        $this->csvStaticValidator = $csvStaticValidator;
        $this->csvRowsWriter = $csvRowsWriter;

        $this->company = $this->getInstance(Company::class, ['id' => 2]);
        $this->alice = $this->getInstance(User::class, ['id' => 10]);
        $this->bob = $this->getInstance(User::class, ['id' => 11]);

        $this
            ->userRepository
            ->findByCompany(2)
            ->willReturn([$this->alice, $this->bob]);

        $this->csvRowFormatter->execute($this->alice)->willReturn(self::ALICE);
        $this->csvRowFormatter->execute($this->bob)->willReturn(self::BOB);

        $this->beConstructedWith(
            $this->userRepository,
            $this->csvRowFormatter,
            $this->csvStaticValidator,
            $this->csvRowsWriter
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ExportToCsv::class);
    }

    function it_writes_the_import_header_followed_by_one_row_per_user()
    {
        $this
            ->csvStaticValidator
            ->execute([self::ALICE, self::BOB])
            ->shouldBeCalled();

        $this
            ->csvRowsWriter
            ->execute([
                CsvStaticValidator::COLUMNS,
                self::ALICE,
                self::BOB,
            ])
            ->willReturn('csv file');

        $this
            ->execute($this->company)
            ->shouldBe('csv file');
    }

    function it_refuses_a_file_the_importer_would_reject()
    {
        $exception = new \DomainException('Duplicated full name found: Alice Allison');

        $this
            ->csvStaticValidator
            ->execute(Argument::any())
            ->willThrow($exception);

        $this
            ->csvRowsWriter
            ->execute(Argument::any())
            ->shouldNotBeCalled();

        $this
            ->shouldThrow($exception)
            ->during('execute', [$this->company]);
    }

    function it_returns_only_the_header_for_a_client_without_users()
    {
        $this
            ->userRepository
            ->findByCompany(2)
            ->willReturn([]);

        $this
            ->csvStaticValidator
            ->execute([])
            ->shouldBeCalled();

        $this
            ->csvRowsWriter
            ->execute([CsvStaticValidator::COLUMNS])
            ->willReturn('header only');

        $this
            ->execute($this->company)
            ->shouldBe('header only');
    }
}
