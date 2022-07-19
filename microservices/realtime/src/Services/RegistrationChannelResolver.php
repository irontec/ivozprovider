<?php

namespace Services;

use Doctrine\DBAL\Exception\ConnectionLost;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;
use Ivoz\Provider\Domain\Model\Carrier\CarrierRepository;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderRepository;

class RegistrationChannelResolver
{
    private $em;
    private $administratorRepository;
    private $companyRepository;
    private $carrierRepository;
    private $ddiProviderRepository;

    public function __construct(
        EntityManagerInterface $em,
        AdministratorRepository $administratorRepository,
        CompanyRepository $companyRepository,
        CarrierRepository $carrierRepository,
        DdiProviderRepository $ddiProviderRepository
    ) {
        $this->em = $em;
        $this->administratorRepository = $administratorRepository;
        $this->companyRepository = $companyRepository;
        $this->carrierRepository = $carrierRepository;
        $this->ddiProviderRepository = $ddiProviderRepository;
    }

    /**
     * @param array{username?: string, roles: array<int, string>} $tokenPayload
     * @return array[array-key, array['b'|'c', int]]
     */
    public function getDefaultCriteria(array $tokenPayload): array
    {
        $this->testDbConnnection();
        $username = $tokenPayload['username'] ?? null;
        if (!$username) {
            throw new \DomainException(
                'User not found'
            );
        }

        $admin = $this->administratorRepository->findClientAdminByUsername(
            $username
        );

        if (!$admin) {
            throw new \DomainException(
                'User not found'
            );
        }

        $brandId = $admin->getBrand()?->getId();
        $clientId = $admin->getCompany()?->getId();

        $criteria = [];
        if ($brandId) {
            $criteria['b'] = $brandId;
        }

        if ($clientId) {
            $criteria['c'] = $clientId;
        }

        $role = $tokenPayload['roles'][0] ?? '';
        if ($role === 'ROLE_COMPANY_ADMIN') {
            return [
                'users' => $criteria,
            ];
        }

        return ['trunks' => $criteria];
    }

    public function criteriaToString(
        array $tokenPayload,
        array $registerCriteria
    ): string {
        $this->testDbConnnection();
        $this->assertAccessGranted(
            $tokenPayload,
            $registerCriteria
        );

        return $this->toString(
            $registerCriteria
        );
    }

    private function testDbConnnection()
    {
        $connection = $this->em->getConnection();
        try {
            $this->administratorRepository->find(0);
        } catch (ConnectionLost $e) {
            $connection->close();
            $connection->connect();
        }
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
    ): bool {

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

        $company = strval($channel['c'] ?? '');
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

        return true;
    }

    private function assertClientAdminAccessGranted(
        string $username,
        array $registerCriteria
    ): bool {

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
        $adminBrand = $admin->getBrand()->getId();
        $brandMatch = $brand === $adminBrand;

        if (!$brandMatch) {
            throw new \Exception(
                'Brand id ' . $brand . ' is not valid. ' . $adminBrand . ' expected'
            );
        }
    }
}
