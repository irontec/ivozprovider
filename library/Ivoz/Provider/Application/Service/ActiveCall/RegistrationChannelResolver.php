<?php

namespace Ivoz\Provider\Application\Service\ActiveCall;

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
        if (!$this->filtersMakeSense($filters)) {
            return "trunks:-1";
        }

        $criteria = $defaultCriteria = $this->getDefaultCriteria(
            $tokenPayload
        );
        $filteringTrunks = isset($defaultCriteria['trunks']);

        if ($filteringTrunks) {
            $criteria = $this->getTrunksCriteria(
                $filters,
                $defaultCriteria
            );
        }

        $this->assertAccessGranted->execute(
            $tokenPayload,
            $criteria
        );

        return $this->toString(
            $criteria
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
     * @param array<'b'|'c'|'cr'|'dp'|'direction', int|string|null>|null $filters
     */
    private function filtersMakeSense(?array $filters): bool
    {
        $direction = $filters['direction'] ?? null;
        $cr = $filters['cr'] ?? null;
        $dp = $filters['dp'] ?? null;

        $notAbleCarrierAndProvider = $cr && $dp;
        $notAbleInboundWithCarrier = $direction === 'inbound' && $cr;
        $notAbleOutboundWithDdiProvider = $direction === 'outbound' && $dp;

        if ($notAbleCarrierAndProvider || $notAbleInboundWithCarrier || $notAbleOutboundWithDdiProvider) {
            return false;
        }

        return true;
    }

    /**
     * @param array<'b'|'c'|'cr'|'dp'|'direction', int|string|null>|null $filters
     * @param array<'trunks'|'users', array<'b'|'c', int>> $defaultCriteria
     * @return array<'trunks', array<'b'|'c'|'dp'|'cr'|'crOrDpPositionKeeper', int|string|null>>
     */
    private function getTrunksCriteria(?array $filters, array $defaultCriteria): array
    {
        /** @var array<'trunks', array<'b'|'c'|'dp'|'cr', int|string|null>> $criteria */
        $criteria = array_merge($defaultCriteria);

        /** @var 'inbound' | 'outbound' | null $direction */
        $direction = $filters['direction'] ?? null;
        $cr = $filters['cr'] ?? null;
        $dp = $filters['dp'] ?? null;

        $criteria['trunks']['b'] = $filters['b'] ?? '*';
        $criteria['trunks']['c'] = $filters['c'] ?? '*';

        if ($direction === 'inbound' || $dp) {
            $criteria['trunks']['dp'] = $dp
                ? $dp
                : '*';
        } elseif ($direction === 'outbound' || $cr) {
            $criteria['trunks']['cr'] = $cr
                ? $cr
                : '*';
        } else {
            $criteria['trunks']['crOrDpPositionKeeper'] = '*';
        }

        return $criteria;
    }

    /**
     * @param array<'trunks' |'users', array<'b'|'c'|'dp'|'cr'|'crOrDpPositionKeeper', int|string|null>> $registerCriteria
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
            $carrierOrDdiProvider = in_array($key, ['cr', 'dp'], true);

            $keepKey = $value !== '*' || $carrierOrDdiProvider;
            if ($keepKey) {
                $value = $key . $value;
            }

            $response[] = $value;
        }

        // callid *
        $response[] = "*";

        return implode(
            ':',
            $response
        );
    }
}
