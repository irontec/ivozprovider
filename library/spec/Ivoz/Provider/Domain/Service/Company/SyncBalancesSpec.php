<?php

namespace spec\Ivoz\Provider\Domain\Service\Company;

use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Service\Company\CompanyBalanceServiceInterface;
use Ivoz\Provider\Domain\Service\Company\SyncBalances;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Psr\Log\LoggerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use spec\HelperTrait;

class SyncBalancesSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $entityTools;
    protected $logger;
    protected $client;
    protected $companyRepository;

    public function let(
        EntityTools $entityTools,
        LoggerInterface $logger,
        CompanyBalanceServiceInterface $client,
        CompanyRepository $companyRepository
    ) {
        $this->entityTools = $entityTools;
        $this->logger = $logger;
        $this->client = $client;
        $this->companyRepository = $companyRepository;

        $this->beConstructedWith(
            $this->entityTools,
            $this->logger,
            $this->client,
            $this->companyRepository
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SyncBalances::class);
    }

    function it_logs_errors()
    {
        $response = new \stdClass();
        $response->error = 'Message';

        $this
            ->client
            ->getBalances(
                Argument::any(),
                Argument::any()
            )
            ->willReturn($response);

        $this->logger
            ->error(Argument::type('string'))
            ->shouldBeCalled();

        $this->updateCompanies(1, [1]);
    }

    function it_updates_db_balances()
    {
        $companyId = 1;
        $balance = 1000;

        $company = $this->getInstance(
            Company::class,
            [
                'id' => $companyId
            ]
        );

        $companyDto = $this->getTestDouble(
            CompanyDto::class
        );

        $response = new \stdClass();
        $response->error = null;
        $response->result = [
            $companyId => $balance
        ];

        $this
            ->client
            ->getBalances(
                Argument::any(),
                Argument::any()
            )
            ->willReturn($response)
            ->shouldBeCalled();

        $this
            ->companyRepository
            ->find($companyId)
            ->willReturn($company)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->entityToDto($company)
            ->willReturn($companyDto)
            ->shouldBeCalled();

        $companyDto
            ->setBalance($balance)
            ->willReturn($companyDto)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persistDto($companyDto, $company)
            ->shouldBeCalled();

        $this->updateCompanies(1, [1]);
    }
}
