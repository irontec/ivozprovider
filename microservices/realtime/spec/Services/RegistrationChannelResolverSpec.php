<?php

namespace spec\Services;

use Doctrine\DBAL\Exception\ConnectionLost;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Driver\Mysqli\Exception\ConnectionFailed;
use Doctrine\DBAL\Query;
use Ivoz\Provider\Domain\Model\Administrator\Administrator;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Domain\Model\Carrier\CarrierRepository;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProvider;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderRepository;
use PhpSpec\Exception\Example\FailureException;
use Services\RegistrationChannelResolver;
use PhpSpec\ObjectBehavior;
use spec\HelperTrait;

class RegistrationChannelResolverSpec extends ObjectBehavior
{
    use HelperTrait;

    /** @var EntityManagerInterface */
    private $em;

    private $connection;
    /** @var  AdministratorRepository */
    private $administratorRepository;
    /** @var  CompanyRepository */
    private $companyRepository;
    /** @var  CarrierRepository */
    private $carrierRepository;
    /** @var  DdiProviderRepository */
    private $ddiProviderRepository;

    function let()
    {
        $this->em = $this->getTestDouble(
            EntityManagerInterface::class,
            false
        );

        $this->connection = $this->getTestDouble(
            \Doctrine\DBAL\Connection::class,
            false
        );

        $this->administratorRepository = $this->getTestDouble(
            AdministratorRepository::class
        );

        $this->companyRepository = $this->getTestDouble(
            CompanyRepository::class
        );

        $this->carrierRepository = $this->getTestDouble(
            CarrierRepository::class
        );

        $this->ddiProviderRepository = $this->getTestDouble(
            DdiProviderRepository::class
        );

        $this->beConstructedWith(
            $this->em,
            $this->administratorRepository,
            $this->companyRepository,
            $this->carrierRepository,
            $this->ddiProviderRepository
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(
            RegistrationChannelResolver::class
        );
    }

    function it_reconnectes_if_necessary()
    {
        $this
            ->em
            ->getConnection()
            ->willReturn($this->connection)
            ->shouldBeCalled();

        $this
            ->connection
            ->executeStatement('SELECT 1')
            ->willThrow(
                new ConnectionLost(
                    new ConnectionFailed('something'),
                    new Query('my query', [], [])
                )
            )
            ->shouldBeCalled();

        $this
            ->connection
            ->close()
            ->shouldBeCalled();

        $this
            ->connection
            ->connect()
            ->shouldBeCalled();

        $this->criteriaToString(
            $this->getTokenPayload(),
            $this->getTrunksRegisterPayload(
                'trunks'
            )
        );
    }

    function it_should_grant_access_to_trunks_to_super_admins()
    {
        $this->prepareEm();

        $subscribe = $this->criteriaToString(
            $this->getTokenPayload(),
            $this->getTrunksRegisterPayload(
                'trunks'
            )
        );

        $current = $subscribe->getWrappedObject();

        $expected = 'trunks:*';
        if ($current !== $expected) {
            throw new FailureException(
                $expected . ' was expected, ' . $current . ' found'
            );
        }
    }

    function it_should_grant_access_to_users_to_super_admins()
    {
        $this->prepareEm();

        $subscribe = $this->criteriaToString(
            $this->getTokenPayload(),
            $this->getTrunksRegisterPayload(
                'users'
            )
        );

        $current = $subscribe->getWrappedObject();

        $expected = 'users:*';
        if ($current !== $expected) {
            throw new FailureException(
                $expected . ' was expected, ' . $current . ' found'
            );
        }
    }

    function it_should_apply_filters()
    {
        $this->prepareEm();

        $subscribe = $this->criteriaToString(
            $this->getTokenPayload(),
            $this->getTrunksRegisterPayload(
                'trunks',
                1,
                2,
                3
            )
        );

        $current = $subscribe->getWrappedObject();

        $expected = 'trunks:b1:c2:cr3:*';
        if ($current !== $expected) {
            throw new FailureException(
                $expected . ' was expected, ' . $current . ' found'
            );
        }
    }

    function it_should_validate_filters_if_brand_admin()
    {
        $this->prepareEm();

        $tokenPayload = $this->getTokenPayload(
            'ROLE_BRAND_ADMIN'
        );
        $filters = [
            'trunks',
            1,
            2,
            3,
            null
        ];

        $this->prepareRepositories(
            $tokenPayload,
            $filters
        );

        // Happy path
        $subscribe = $this->criteriaToString(
            $tokenPayload,
            $this->getTrunksRegisterPayload(...$filters)
        );

        $current = $subscribe->getWrappedObject();

        $expected = 'trunks:b1:c2:cr3:*';
        if ($current !== $expected) {
            throw new FailureException(
                $expected . ' was expected, ' . $current . ' found'
            );
        }

        //Validation error
        $filters[1] = 2;
        $this
            ->shouldThrow(\Exception::class)
            ->during(
                'criteriaToString',
                [
                    $tokenPayload,
                    $this->getTrunksRegisterPayload(...$filters)
                ]
            );
    }

    function it_should_validate_filters_if_company_admin()
    {
        $this->prepareEm();

        $tokenPayload = $this->getTokenPayload(
            'ROLE_COMPANY_ADMIN'
        );
        $filters = [
            'trunks',
            1,
            2,
            null,
            null
        ];

        $this->prepareRepositories(
            $tokenPayload,
            $filters
        );

        // Happy path
        $subscribe = $this->criteriaToString(
            $tokenPayload,
            $this->getTrunksRegisterPayload(...$filters)
        );

        $current = $subscribe->getWrappedObject();

        $expected = 'trunks:b1:c2:*';
        if ($current !== $expected) {
            throw new FailureException(
                $expected . ' was expected, ' . $current . ' found'
            );
        }

        //Validation error
        $filters[1] = 2;
        $this
            ->shouldThrow(\Exception::class)
            ->during(
                'criteriaToString',
                [
                    $tokenPayload,
                    $this->getTrunksRegisterPayload(...$filters)
                ]
            );
    }

    private function prepareEm()
    {
        $this
            ->em
            ->getConnection()
            ->willReturn($this->connection)
            ->shouldBeCalled();

        $this
            ->connection
            ->executeStatement('SELECT 1')
            ->shouldBeCalled();
    }

    private function prepareRepositories(
        $tokenPayload,
        $filters
    ) {
        $username = $tokenPayload['username'];
        [
            ,
            $brandId,
            $companyId,
            $carrierId,
            $ddiProviderId
        ] = $filters;

        $brand = $brandId
            ? $this->getInstance(Brand::class, ['id' => $brandId])
            : null;

        $company = $companyId
            ? $this->getInstance(Company::class, ['id' => $companyId])
            : null;

        $admin = $this->getInstance(
            Administrator::class,
            [
                'username' => $username,
                'brand' => $brand,
                'company' => $company
            ]
        );

        if ($company) {
            $this
                ->companyRepository
                ->getSupervisedCompanyIdsByAdmin($admin)
                ->willReturn([(string) $companyId]);
        }

        $carrier = $carrierId
            ? $this->getInstance(Carrier::class, ['id' => $carrierId])
            : null;

        if ($carrier) {
            $this
                ->carrierRepository
                ->getCarrierIdsByBrandAdmin($admin)
                ->willReturn([(string) $carrierId])
                ->shouldBeCalled();
        }

        $ddiProvider = $ddiProviderId
            ? $this->getInstance(DdiProvider::class, ['id' => $ddiProviderId])
            : null;

        if ($ddiProvider) {
            $this
                ->ddiProviderRepository
                ->getDdiProviderIdsByBrandAdmin($admin)
                ->willReturn([$ddiProviderId])
                ->shouldBeCalled();
        }

        switch ($tokenPayload['roles'][0]) {
            case 'ROLE_BRAND_ADMIN':
                $this
                    ->administratorRepository
                    ->findBrandAdminByUsername(
                        $username
                    )
                    ->willReturn($admin)
                    ->shouldBeCalled();

                break;

            case 'ROLE_COMPANY_ADMIN':
                $this
                    ->administratorRepository
                    ->findClientAdminByUsername(
                        $username
                    )
                    ->willReturn($admin)
                    ->shouldBeCalled();
        }
    }

    private function getTokenPayload(string $role = 'ROLE_SUPER_ADMIN')
    {
        $username = 'god_admin';
        switch ($role) {
            case 'ROLE_BRAND_ADMIN':
                $username = 'brand_admin';
                break;
            case 'ROLE_COMPANY_ADMIN':
                $username = 'company_admin';
                break;
        }

        return [
            'exp' => time() + 1000,
            'roles' => [$role],
            'username' => $username
        ];
    }

    private function getTrunksRegisterPayload(
        string $channel,
        int $brand = null,
        int $company = null,
        int $carrier = null,
        int $ddiProvider = null
    ): array {

        $filters = [];

        if ($brand) {
            $filters['b'] = $brand;
        }

        if ($company) {
            $filters['c'] = $company;
        }

        if ($carrier) {
            $filters['cr'] = $carrier;
        }

        if ($ddiProvider) {
            $filters['dp'] = $ddiProvider;
        }

        return [
            $channel => $filters
        ];
    }
}
