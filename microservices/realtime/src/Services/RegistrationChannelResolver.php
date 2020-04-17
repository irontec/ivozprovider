<?php

namespace Services;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;
use Ivoz\Provider\Domain\Model\Carrier\CarrierRepository;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderRepository;

class RegistrationChannelResolver
{
    private $administratorRepository;
    private $companyRepository;
    private $carrierRepository;
    private $ddiProviderRepository;

    public function __construct(
        AdministratorRepository $administratorRepository,
        CompanyRepository $companyRepository,
        CarrierRepository $carrierRepository,
        DdiProviderRepository $ddiProviderRepository
    ) {
        $this->administratorRepository = $administratorRepository;
        $this->companyRepository = $companyRepository;
        $this->carrierRepository = $carrierRepository;
        $this->ddiProviderRepository = $ddiProviderRepository;
    }

    public function criteriaToString(
        array $tokenPayload,
        array $registerCriteria
    ) {
        $this->assertAccessGranted(
            $tokenPayload,
            $registerCriteria
        );

        return $this->toString(
            $registerCriteria
        );
    }

    private function assertAccessGranted(
        array $tokenPayload,
        array $registerCriteria
    ): bool {

        $expTime = $tokenPayload['exp'] ?? 0;
        if ($expTime < time()) {
            throw new \Exception(
                'Expired token'
            );
        }

        $role = $tokenPayload['roles'][0] ?? '';

        switch ($role) {
            case 'ROLE_SUPER_ADMIN':
                return true;

            case 'ROLE_BRAND_ADMIN':
                return $this->assertBrandAdminAccessGranted(
                    $tokenPayload['username'],
                    $registerCriteria
                );

            case 'ROLE_COMPANY_ADMIN':
                return $this->assertClientAdminAccessGranted(
                    $tokenPayload['username'],
                    $registerCriteria
                );
        }

        $isSuperAdmin = in_array(
            'ROLE_SUPER_ADMIN',
            $tokenPayload['roles'] ?? [],
            true
        );

        if ($isSuperAdmin) {
            return true;
        }

        throw new \Exception('Access denied');
    }

    private function assertBrandAdminAccessGranted(
        string $username,
        array $registerCriteria
    ):bool {

        $admin = $this->administratorRepository->findBrandAdminByUsername(
            $username
        );

        if (!$admin) {
            throw new \Exception('Admin not found');
        }

        $channel = current($registerCriteria);

        $brand = $channel['b'] ?? '';
        if (isset($brand)) {
            $this->assertBrand($admin, $brand);
        }

        $company = (string) $channel['c'] ?? '';
        if ($company) {
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

        $carrier = (string) $channel['cr'] ?? '';
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
                throw new \Exception('Company id is not valid');
            }
        }

        $ddiProvider = $channel['dp'] ?? '';
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

        return true;
    }

    private function assertClientAdminAccessGranted(
        string $username,
        array $registerCriteria
    ):bool {

        $admin = $this->administratorRepository->findClientAdminByUsername(
            $username
        );

        if (!$admin) {
            throw new \Exception('Admin not found');
        }

        $channel = current($registerCriteria);

        $brand = $channel['b'] ?? -1;
        $this->assertBrand($admin, $brand);

        $company = $channel['c'] ?? -1;
        $companyMatch =
            $company == $admin->getCompany()->getId();

        if (!$companyMatch) {
            throw new \Exception('Company id is not valid');
        }

        return true;
    }

    private function toString(
        array $registerCriteria
    ) {
        $response = [];
        if (isset($registerCriteria['trunks'])) {
            $criteria = $registerCriteria['trunks'];
            $response[] = 'trunks';
        } else {
            $criteria = $registerCriteria['users'];
            $response[] = 'users';
        }

        foreach ($criteria as $key => $value) {
            $response[] = $key . $value;
        }
        $response[] = '*';

        return implode(
            ':',
            $response
        );
    }

    private function assertBrand(
        AdministratorInterface $admin,
        int $brand
    ) {
        $brandMatch =
            $brand == $admin->getBrand()->getId();

        if (!$brandMatch) {
            throw new \Exception(
                'Brand id ' . $brand . ' is not valid'
            );
        }
    }
}
