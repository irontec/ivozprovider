<?php

namespace Ivoz\Provider\Application\Service\ActiveCall;

use Ivoz\Provider\Domain\Model\Administrator\Administrator;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;
use Ivoz\Provider\Domain\Service\ActiveCall\AssertAccessGranted;

const INBOUND = 'inbound';
const OUTBOUND = 'outbound';
const DIRECTION = [INBOUND, OUTBOUND];


class RegistrationChannelResolver
{
    public function __construct(
        private AdministratorRepository $administratorRepository,
        private AssertAccessGranted $assertAccessGranted
    ) {
    }

    /**
     * @param array<'b'|'c'|'cr'|'dp'|'direction', int|string|null>|null $filters
     * @param array{username: string, roles: array<int, string>} $tokenPayload
     */
    public function execute(?array $filters, array $tokenPayload): string
    {
        $defaultCriteria = $this->getDefaultCriteria($tokenPayload);

        $role = $tokenPayload['roles'][0];

        $trunksRoles = [
            Administrator::ROLE_BRAND_ADMIN,
            Administrator::ROLE_SUPER_ADMIN
        ];

        if (in_array($role, $trunksRoles)) {
            $direction = $filters['direction'] ?? null;
            $cr = $filters['cr'] ?? null;
            $dp = $filters['dp'] ?? null;

            if ($direction === INBOUND && is_null($cr)) {
                $cr = '*';
            }

            if ($direction === OUTBOUND && is_null($cr)) {
                $dp = '*';
            }

            $defaultCriteria['trunks']['b'] = $filters['b'] ?? null;
            $defaultCriteria['trunks']['c'] = $filters['c'] ?? null;
            $defaultCriteria['trunks']['cr'] = $cr;
            $defaultCriteria['trunks']['dp'] = $dp;
        }

        return $this->criteriaToString(
            $tokenPayload,
            $defaultCriteria
        );
    }

    /**
     * @param array{username: string, roles: array<int, string>} $tokenPayload
     * @return array<'trunks'|'users', array<'b'|'c', int>>
     */
    private function getDefaultCriteria(array $tokenPayload): array
    {
        $username = $tokenPayload['username'] ?? null;

        if (!$username) {
            throw new \DomainException(
                'Username not found in token payload'
            );
        }

        $role = $tokenPayload['roles'][0] ?? '';
        switch ($role) {
            case 'ROLE_COMPANY_ADMIN':
                $admin = $this->administratorRepository->findClientAdminByUsername(
                    $username
                );
                break;
            case 'ROLE_BRAND_ADMIN':
                $admin = $this->administratorRepository->findBrandAdminByUsername(
                    $username
                );
                break;
            case 'ROLE_SUPER_ADMIN':
                $admin = $this->administratorRepository->findPlatformAdminByUsername(
                    $username
                );
                break;
            default:
                throw new \DomainException('Unknown admin type ' . $role);
        }

        if (!$admin) {
            throw new \DomainException(
                sprintf(
                    'User %s not found',
                    $username
                )
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

    /**
     * @param array{username?: string, roles: array<int, string>} $tokenPayload
     * @param array<'trunks' |'users', array<'b'|'c'|'dp'|'cr', int|string|null>> $registerCriteria
     * @return string
     */
    private function criteriaToString(
        array $tokenPayload,
        array $registerCriteria
    ): string {
        $this->assertAccessGranted->execute(
            $tokenPayload,
            $registerCriteria
        );

        return $this->toString(
            $registerCriteria
        );
    }

    /**
     * @param array<'trunks' |'users', array<'b'|'c'|'dp'|'cr', int|string|null>> $registerCriteria
     */
    private function toString(
        array $registerCriteria
    ): string {
        $response = [];
        if (isset($registerCriteria['trunks'])) {
            $criteria = $registerCriteria['trunks'];
            $response[] = 'trunks';
        } else {
            $criteria = $registerCriteria['users'];
            $response[] = 'users';
        }

        foreach ($criteria as $key => $value) {
            if (is_null($value)) {
                $response[] = '*';
                continue;
            }
            $response[] = $key . $value;
        }
        $response[] = '*';

        return implode(
            ':',
            $response
        );
    }
}
