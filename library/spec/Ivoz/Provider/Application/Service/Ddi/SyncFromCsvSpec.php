<?php

namespace spec\Ivoz\Provider\Application\Service\Ddi;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Application\Service\Ddi\SyncFromCsv;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Country\Country;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiRepository;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProvider;
use Ivoz\Provider\Domain\Service\Ddi\CsvRowsParser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Log\LoggerInterface;
use spec\HelperTrait;

class SyncFromCsvSpec extends ObjectBehavior
{
    use HelperTrait;

    private const CSV = "944048182\n\n944048183";
    private const ONE_ROW_CSV = '944048182';

    protected $csvRowsParser;
    protected $ddiRepository;
    protected $entityTools;
    protected $logger;
    protected $brand;
    protected $otherBrand;
    protected $country;
    protected $company;
    protected $otherCompany;
    protected $ddiProvider;
    protected $otherDdiProvider;

    public function let(
        CsvRowsParser $csvRowsParser,
        DdiRepository $ddiRepository,
        EntityTools $entityTools,
        LoggerInterface $logger
    ) {
        $this->csvRowsParser = $csvRowsParser;
        $this->ddiRepository = $ddiRepository;
        $this->entityTools = $entityTools;
        $this->logger = $logger;

        $this->brand = $this->getInstance(Brand::class, ['id' => 1]);
        $this->otherBrand = $this->getInstance(Brand::class, ['id' => 9]);
        $this->country = $this->getInstance(Country::class, ['id' => 68]);
        $this->company = $this->getInstance(Company::class, ['id' => 2, 'brand' => $this->brand]);
        $this->otherCompany = $this->getInstance(Company::class, ['id' => 3, 'brand' => $this->brand]);
        $this->ddiProvider = $this->getInstance(DdiProvider::class, ['id' => 5, 'brand' => $this->brand]);
        $this->otherDdiProvider = $this->getInstance(DdiProvider::class, ['id' => 6, 'brand' => $this->brand]);

        $this
            ->csvRowsParser
            ->parse(self::CSV)
            ->willReturn([
                0 => '944048182',
                2 => '944048183',
            ]);

        $this
            ->csvRowsParser
            ->parse(self::ONE_ROW_CSV)
            ->willReturn([
                0 => '944048182',
            ]);

        $this
            ->ddiRepository
            ->findOneByDdiAndCountry(Argument::cetera())
            ->willReturn(null);

        $this->beConstructedWith(
            $this->csvRowsParser,
            $this->ddiRepository,
            $this->entityTools,
            $this->logger
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SyncFromCsv::class);
    }

    function it_creates_new_ddis_with_the_chosen_company_country_and_provider()
    {
        $ddi = $this->givenCreatedDdi('944048182', 2, 5);
        $otherDdi = $this->givenCreatedDdi('944048183', 2, 5);

        $this->entityTools->persist($ddi, true)->shouldBeCalled();
        $this->entityTools->persist($otherDdi, true)->shouldBeCalled();

        $result = $this->execute($this->brand, $this->country, $this->company, $this->ddiProvider, self::CSV);

        $result->getCreatedCount()->shouldBe(2);
        $result->getUpdatedLines()->shouldBe([]);
        $result->getSkippedRows()->shouldBe([]);
        $result->getErrors()->shouldBe([]);
    }

    function it_creates_unassigned_ddis_without_provider_when_none_are_chosen()
    {
        $this->givenCreatedDdi('944048182', null, null);
        $this->givenCreatedDdi('944048183', null, null);

        $this->entityTools->persist(Argument::any(), true)->shouldBeCalledTimes(2);

        $result = $this->execute($this->brand, $this->country, null, null, self::CSV);

        $result->getCreatedCount()->shouldBe(2);
    }

    function it_fills_the_company_and_the_provider_of_an_unassigned_ddi_of_the_brand()
    {
        $ddi = $this->givenExistingDdi($this->brand, null, null);

        $this->expectUpdate($ddi, 2, 5);

        $result = $this->execute($this->brand, $this->country, $this->company, $this->ddiProvider, self::ONE_ROW_CSV);

        $result->getCreatedCount()->shouldBe(0);
        $result->getUpdatedLines()->shouldBe([1]);
        $result->getSkippedRows()->shouldBe([]);
    }

    function it_fills_only_the_provider_when_the_ddi_already_has_the_chosen_company()
    {
        $ddi = $this->givenExistingDdi($this->brand, $this->company, null);

        $this->expectUpdate($ddi, 2, 5);

        $result = $this->execute($this->brand, $this->country, $this->company, $this->ddiProvider, self::ONE_ROW_CSV);

        $result->getUpdatedLines()->shouldBe([1]);
    }

    function it_fills_only_the_company_when_the_ddi_already_has_the_chosen_provider()
    {
        $ddi = $this->givenExistingDdi($this->brand, null, $this->ddiProvider);

        $this->expectUpdate($ddi, 2, 5);

        $result = $this->execute($this->brand, $this->country, $this->company, $this->ddiProvider, self::ONE_ROW_CSV);

        $result->getUpdatedLines()->shouldBe([1]);
    }

    function it_does_not_fill_a_field_that_was_not_chosen()
    {
        $ddi = $this->givenExistingDdi($this->brand, null, null);

        $this->expectUpdate($ddi, 2, null);

        $result = $this->execute($this->brand, $this->country, $this->company, null, self::ONE_ROW_CSV);

        $result->getUpdatedLines()->shouldBe([1]);
    }

    function it_skips_a_ddi_that_already_has_the_chosen_company_and_provider()
    {
        $this->givenExistingDdi($this->brand, $this->company, $this->ddiProvider);

        $this->expectNoChanges();

        $result = $this->execute($this->brand, $this->country, $this->company, $this->ddiProvider, self::ONE_ROW_CSV);

        $result->getUpdatedLines()->shouldBe([]);
        $result->getSkippedRows()->shouldBe([
            ['line' => 1, 'message' => 'Nothing to update'],
        ]);
    }

    function it_skips_an_existing_ddi_when_neither_company_nor_provider_are_chosen()
    {
        $this->givenExistingDdi($this->brand, null, null);

        $this->expectNoChanges();

        $result = $this->execute($this->brand, $this->country, null, null, self::ONE_ROW_CSV);

        $result->getSkippedRows()->shouldBe([
            ['line' => 1, 'message' => 'Nothing to update'],
        ]);
    }

    function it_skips_a_ddi_of_another_client_without_filling_its_provider()
    {
        $this->givenExistingDdi($this->brand, $this->otherCompany, null);

        $this->expectNoChanges();

        $result = $this->execute($this->brand, $this->country, $this->company, $this->ddiProvider, self::ONE_ROW_CSV);

        $result->getSkippedRows()->shouldBe([
            ['line' => 1, 'message' => 'DDI already assigned to another client'],
        ]);
    }

    function it_skips_a_ddi_of_another_provider_without_filling_its_company()
    {
        $this->givenExistingDdi($this->brand, null, $this->otherDdiProvider);

        $this->expectNoChanges();

        $result = $this->execute($this->brand, $this->country, $this->company, $this->ddiProvider, self::ONE_ROW_CSV);

        $result->getSkippedRows()->shouldBe([
            ['line' => 1, 'message' => 'DDI already assigned to another DDI provider'],
        ]);
    }

    function it_skips_an_outbound_only_ddi_when_a_provider_is_chosen()
    {
        $this->givenExistingDdi($this->brand, null, null, DdiInterface::TYPE_OUT);

        $this->expectNoChanges();

        $result = $this->execute($this->brand, $this->country, $this->company, $this->ddiProvider, self::ONE_ROW_CSV);

        $result->getSkippedRows()->shouldBe([
            ['line' => 1, 'message' => 'Outbound only DDIs cannot have a DDI provider'],
        ]);
    }

    function it_fills_the_company_of_an_outbound_only_ddi_when_no_provider_is_chosen()
    {
        $ddi = $this->givenExistingDdi($this->brand, null, null, DdiInterface::TYPE_OUT);

        $this->expectUpdate($ddi, 2, null);

        $result = $this->execute($this->brand, $this->country, $this->company, null, self::ONE_ROW_CSV);

        $result->getUpdatedLines()->shouldBe([1]);
    }

    function it_skips_a_ddi_of_another_brand_without_revealing_its_owner()
    {
        $this->givenExistingDdi($this->otherBrand, $this->otherCompany, $this->otherDdiProvider);

        $this->expectNoChanges();

        $result = $this->execute($this->brand, $this->country, $this->company, $this->ddiProvider, self::ONE_ROW_CSV);

        $result->getSkippedRows()->shouldBe([
            ['line' => 1, 'message' => 'DDI already exists'],
        ]);
    }

    function it_skips_the_rows_repeated_in_the_file()
    {
        $this
            ->csvRowsParser
            ->parse('csv')
            ->willReturn([
                0 => '944048182',
                1 => '944048182',
            ]);

        $ddi = $this->givenCreatedDdi('944048182', 2, 5);
        $this->entityTools->persist($ddi, true)->shouldBeCalledTimes(1);

        $result = $this->execute($this->brand, $this->country, $this->company, $this->ddiProvider, 'csv');

        $result->getCreatedCount()->shouldBe(1);
        $result->getSkippedRows()->shouldBe([
            ['line' => 2, 'message' => 'Repeated in the file'],
        ]);
    }

    function it_reports_invalid_rows_with_their_file_line_and_keeps_the_valid_ones()
    {
        $this
            ->csvRowsParser
            ->parse('csv')
            ->willReturn([
                0 => '+34944048182',
                1 => '944048183',
            ]);

        $this
            ->entityTools
            ->dtoToEntity(Argument::that(
                fn (DdiDto $dto): bool => $dto->getDdi() === '+34944048182'
            ))
            ->willThrow(new \InvalidArgumentException('Value "+34944048182" does not match expression.'));

        $createdDdi = $this->givenCreatedDdi('944048183', 2, 5);
        $this->entityTools->persist($createdDdi, true)->shouldBeCalled();

        $result = $this->execute($this->brand, $this->country, $this->company, $this->ddiProvider, 'csv');

        $result->getCreatedCount()->shouldBe(1);
        $result->getErrors()->shouldBe([
            ['line' => 1, 'message' => 'Value "+34944048182" does not match expression.'],
        ]);
    }

    function it_stops_at_an_unexpected_error_and_reports_the_remaining_rows_as_not_processed()
    {
        $ddi = $this->givenCreatedDdi('944048182', 2, 5);

        $this
            ->entityTools
            ->persist($ddi, true)
            ->willThrow(new \RuntimeException('Connection lost'));

        $this
            ->ddiRepository
            ->findOneByDdiAndCountry('944048183', Argument::any())
            ->shouldNotBeCalled();

        $this
            ->logger
            ->error(
                Argument::containingString('line 1'),
                Argument::withEntry('exception', Argument::type(\RuntimeException::class))
            )
            ->shouldBeCalled();

        $result = $this->execute($this->brand, $this->country, $this->company, $this->ddiProvider, self::CSV);

        $result->getCreatedCount()->shouldBe(0);
        $result->getErrors()->shouldBe([
            ['line' => 1, 'message' => 'Unknown error'],
            ['line' => 3, 'message' => 'Not processed: the import stopped after an unexpected error at line 1'],
        ]);
    }

    function it_reports_file_errors_at_line_zero_and_imports_nothing()
    {
        $this
            ->csvRowsParser
            ->parse('csv')
            ->willThrow(new \DomainException('The file is empty'));

        $this
            ->entityTools
            ->dtoToEntity(Argument::cetera())
            ->shouldNotBeCalled();

        $result = $this->execute($this->brand, $this->country, $this->company, $this->ddiProvider, 'csv');

        $result->getCreatedCount()->shouldBe(0);
        $result->getErrors()->shouldBe([
            ['line' => 0, 'message' => 'The file is empty'],
        ]);
    }

    /**
     * @param int|null $companyId phpspec 7.2 cannot rewrite nullable type hints
     * @param int|null $ddiProviderId
     */
    private function givenCreatedDdi(string $number, $companyId, $ddiProviderId): DdiInterface
    {
        $ddi = $this->getInstance(Ddi::class);

        $this
            ->entityTools
            ->dtoToEntity(Argument::that(
                fn (DdiDto $dto): bool => $dto->getDdi() === $number
                    && $dto->getCountryId() === 68
                    && $dto->getBrandId() === 1
                    && $dto->getCompanyId() === $companyId
                    && $dto->getDdiProviderId() === $ddiProviderId
                    && $dto->getType() === DdiInterface::TYPE_INOUT
            ))
            ->willReturn($ddi);

        return $ddi;
    }

    /**
     * @param Company|null $company
     * @param DdiProvider|null $ddiProvider
     */
    private function givenExistingDdi(
        Brand $brand,
        $company,
        $ddiProvider,
        string $type = DdiInterface::TYPE_INOUT
    ): DdiInterface {
        $ddi = $this->getInstance(
            Ddi::class,
            [
                'id' => 7,
                'ddi' => '944048182',
                'type' => $type,
                'brand' => $brand,
                'company' => $company,
                'ddiProvider' => $ddiProvider,
            ]
        );

        $this
            ->ddiRepository
            ->findOneByDdiAndCountry('944048182', 68)
            ->willReturn($ddi);

        $dto = (new DdiDto(7))
            ->setCompanyId($company?->getId())
            ->setDdiProviderId($ddiProvider?->getId());

        $this->entityTools->entityToDto($ddi)->willReturn($dto);

        return $ddi;
    }

    /**
     * @param int|null $companyId
     * @param int|null $ddiProviderId
     */
    private function expectUpdate(DdiInterface $ddi, $companyId, $ddiProviderId): void
    {
        $this
            ->entityTools
            ->updateEntityByDto(
                $ddi,
                Argument::that(
                    fn (DdiDto $dto): bool => $dto->getCompanyId() === $companyId
                        && $dto->getDdiProviderId() === $ddiProviderId
                )
            )
            ->shouldBeCalled()
            ->willReturn($ddi);

        $this->entityTools->persist($ddi, true)->shouldBeCalled();
    }

    private function expectNoChanges(): void
    {
        $this->entityTools->entityToDto(Argument::any())->shouldNotBeCalled();
        $this->entityTools->updateEntityByDto(Argument::cetera())->shouldNotBeCalled();
        $this->entityTools->dtoToEntity(Argument::any())->shouldNotBeCalled();
        $this->entityTools->persist(Argument::cetera())->shouldNotBeCalled();
    }
}
