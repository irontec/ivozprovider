<?php

namespace spec\Ivoz\Provider\Domain\Service\Company;

use Ivoz\Provider\Domain\Model\BalanceMovement\BalanceMovementDto;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Service\Company\CompanyBalanceServiceInterface;
use Ivoz\Provider\Domain\Service\Company\DecrementBalance;
use Ivoz\Provider\Domain\Service\Company\SyncBalances;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Symfony\Bridge\Monolog\Logger;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;

class DecrementBalanceSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var CompanyBalanceServiceInterface
     */
    protected $client;

    /**
     * @var CompanyRepository
     */
    protected $companyRepository;

    /**
     * @var SyncBalances
     */
    protected $syncBalanceService;

    /**
     * @var string
     */
    protected $lastError;

    /**
     * IncrementBalance constructor.
     *
     * @param EntityTools $entityTools
     * @param Logger $logger
     * @param CompanyBalanceServiceInterface $client
     * @param CompanyRepository $companyRepository
     * @param SyncBalances $syncBalanceService
     */
    public function let(
        EntityTools $entityTools,
        Logger $logger,
        CompanyBalanceServiceInterface $client,
        CompanyRepository $companyRepository,
        SyncBalances $syncBalanceService
    ) {
        $this->entityTools = $entityTools;
        $this->logger = $logger;
        $this->client = $client;
        $this->companyRepository = $companyRepository;
        $this->syncBalanceService = $syncBalanceService;

        $this->beConstructedWith(
            $this->entityTools,
            $this->logger,
            $this->client,
            $this->companyRepository,
            $this->syncBalanceService
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(DecrementBalance::class);
    }

    function it_decreases_balance(
        CompanyInterface $company,
        BrandInterface $brand
    ) {
        $this->prepareExecution(
            $company,
            $brand
        );

        $this
            ->syncBalanceService
            ->updateCompanies(
                Argument::type('numeric'),
                Argument::type('array')
            )
            ->shouldBeCalled();

        $this->execute(
            1,
            10.15
        );
    }

    function it_creates_balance_movement(
        CompanyInterface $company,
        BrandInterface $brand
    ) {
        $this->prepareExecution(
            $company,
            $brand
        );

        $this
            ->entityTools
            ->persistDto(
                Argument::type(BalanceMovementDto::class),
                null,
                true
            )
            ->shouldBeCalled();

        $this->execute(
            1,
            10.15
        );
    }

    protected function prepareExecution(
        CompanyInterface $company,
        BrandInterface $brand
    ) {
        $this
            ->logger
            ->info(Argument::any())
            ->willReturn(null);

        $this
            ->companyRepository
            ->find(Argument::type('numeric'))
            ->willReturn($company);

        $this
            ->client
            ->decrementBalance(
                $company,
                Argument::type('float')
            )
            ->willReturn([
                'success' => true
            ]);

        $company
            ->getBrand()
            ->willReturn($brand);

        $company
            ->getId()
            ->willReturn(2);

        $brand
            ->getId()
            ->willReturn(1);

        $this
            ->client
            ->getBalance(
                Argument::type('numeric'),
                Argument::type('numeric')
            )
            ->willReturn(100.45);
    }
}
