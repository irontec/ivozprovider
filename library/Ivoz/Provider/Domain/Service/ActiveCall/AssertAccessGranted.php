<?php

namespace Ivoz\Provider\Domain\Service\ActiveCall;

use Ivoz\Provider\Domain\Model\Administrator\Administrator;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;
use Ivoz\Provider\Domain\Model\Carrier\CarrierRepository;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderRepository;

class AssertAccessGranted
{
    public function __construct(
        private AdministratorRepository $administratorRepository,
        private CompanyRepository $companyRepository,
        private CarrierRepository $carrierRepository,
        private DdiProviderRepository $ddiProviderRepository
    ) {
    }

    /**
     * @param array{username?: string, roles: array<int, string>} $tokenPayload
     * @param array<'trunks' |'users', array<'b'|'c'|'dp'|'cr', int|string|null>> $registerCriteria
     */
    public function execute(
        array $tokenPayload,
        array $registerCriteria
    ): void {
        $role = $tokenPayload['roles'][0] ?? '';

        switch ($role) {
            case Administrator::ROLE_SUPER_ADMIN:
                return;

            case Administrator::ROLE_BRAND_ADMIN:
                $this->assertBrandAdminAccessGranted(
                    $tokenPayload['username'] ?? null,
                    $registerCriteria
                );
                return;
            case Administrator::ROLE_COMPANY_ADMIN:
                $this->assertClientAdminAccessGranted(
                    $tokenPayload['username'] ?? null,
                    $registerCriteria
                );
                return;
        }

        $isSuperAdmin = in_array(
            Administrator::ROLE_SUPER_ADMIN,
            $tokenPayload['roles'] ?? [],
            true
        );

        if ($isSuperAdmin) {
            return;
        }

        throw new \Exception('Access denied');
    }

    /**
     * @param ?string $username
     * @param array<'trunks' |'users', array<'b'|'c'|'dp'|'cr', int|string|null>> $registerCriteria
     */
    private function assertBrandAdminAccessGranted(
        ?string $username,
        array $registerCriteria
    ): void {
        if (is_null($username)) {
            throw new \Exception('Username not found');
        }

        $admin = $this->administratorRepository->findBrandAdminByUsername(
            $username
        );

        if (!$admin) {
            throw new \Exception('Admin not found');
        }

        /** @var array<'b'|'c'|'cr'|'dp', int|null> $channel */
        $channel = current($registerCriteria);

        $brand = $channel['b'] ?? null;
        if (isset($brand)) {
            $this->assertBrand($admin, $brand);
        }

        $company = strval($channel['c'] ?? '');
        if ($company) {
            /** @var array<array-key, string> $companyIds */
            $companyIds = $this->companyRepository->getSupervisedCompanyIdsByAdmin(
                $admin
            );

            $validCompany = in_array(
                $company,
                $companyIds,
                true
            );

            if (!$validCompany) {
                throw new \Exception('Company id is not valid');
            }
        }

        $carrier = strval($channel['cr'] ?? '');
        if ($carrier) {
            $carrierIds = $this
                ->carrierRepository
                ->getCarrierIdsByBrandAdmin(
                    $admin
                );

            $validCarrier = in_array(
                $carrier,
                $carrierIds,
                true
            );

            if (!$validCarrier) {
                throw new \Exception('Carrier id is not valid');
            }
        }

        $ddiProvider = strval($channel['dp'] ?? '');
        if ($ddiProvider) {
            $ddiProviderIds = $this
                ->ddiProviderRepository
                ->getDdiProviderIdsByBrandAdmin(
                    $admin
                );

            $validDdiProvider = in_array(
                $ddiProvider,
                $ddiProviderIds,
                true
            );

            if (!$validDdiProvider) {
                throw new \Exception('DdiProvider id is not valid');
            }
        }
    }


    /**
     * @param ?string $username
     * @param array<'trunks' |'users', array<'b'|'c'|'dp'|'cr', int|string|null>> $registerCriteria
     */
    private function assertClientAdminAccessGranted(
        ?string $username,
        array $registerCriteria
    ): void {

        if (is_null($username)) {
            throw new \Exception('Username not found');
        }

        $admin = $this->administratorRepository->findClientAdminByUsername(
            $username
        );

        if (!$admin) {
            throw new \Exception('Admin not found');
        }

        /** @var array<'b'|'c', int|null> $channel */
        $channel = current($registerCriteria);

        $brand = $channel['b'] ?? -1;
        $this->assertBrand($admin, $brand);

        $company = $channel['c'] ?? -1;
        $companyMatch =
            $company == $admin->getCompany()?->getId();

        if (!$companyMatch) {
            throw new \Exception('Company id is not valid');
        }
    }


    private function assertBrand(
        AdministratorInterface $admin,
        int $brand
    ): void {
        $adminBrand = $admin->getBrand()?->getId();
        $brandMatch = $brand === $adminBrand;

        if (!$brandMatch) {
            throw new \Exception(
                'Brand id ' . $brand . ' is not valid. ' . $adminBrand . ' expected'
            );
        }
    }
}
