<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Repository\DoctrineRepository;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\User\UserRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * UserDoctrineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 *
 * @extends DoctrineRepository<UserInterface, UserDto>
 */
class UserDoctrineRepository extends DoctrineRepository implements UserRepository
{
    public function __construct(
        ManagerRegistry $registry,
        EntityPersisterInterface $entityPersister,
    ) {
        parent::__construct(
            $registry,
            User::class,
            $entityPersister,
        );
    }

    /**
     * @param string | int $id
     * @return UserInterface[]
     */
    public function findByBossAssistantId($id): array
    {
        return $this->findBy([
            'bossAssistant' => $id
        ]);
    }

    /**
     * Used by client API access controls
     * @return int[]
     */
    public function getSupervisedUserIdsByAdmin(AdministratorInterface $admin): array
    {
        $companyIds = $admin->isBrandAdmin()
            ? $this->getCompanyIdsByBrandAdmin($admin)
            : [ $admin->getCompany()?->getId() ];

        $qb = $this->createQueryBuilder('self');
        $expression = $qb->expr();

        $qb
            ->select('self.id')
            ->where(
                $expression->in('self.company', $companyIds)
            );

        $result = $qb->getQuery()->getScalarResult();

        $ids = array_column($result, 'id');

        return array_map(
            fn($id) => (int) $id,
            $ids
        );
    }

    /**
     * @return UserInterface[]
     */
    public function getUserAssistantCandidates(UserInterface $user): array
    {
        $company = $user->getCompany();

        $qb = $this->createQueryBuilder('self');
        $expression = $qb->expr();

        $query = $qb
            ->where(
                $expression->eq('self.company', $company->getid())
            )->andWhere(
                $expression->neq('self.id', $user->getid())
            )->andWhere(
                $expression->eq('self.isBoss', 0)
            )->getQuery();

        return $query->getResult();
    }

    /**
     * @return int[]
     */
    public function getBrandUsersIdsOrderByTerminalExpireDate(int $brandId, string $order = 'DESC'): array
    {
        $query = $this->getBrandUsersIdsOrderByTerminalExpireDateQuery(
            $brandId,
            $order,
            'LEFT'
        );

        $connection = $this
            ->getEntityManager()
            ->getConnection();

        $results = $connection->fetchAll($query);

        $ids = array_column(
            $results,
            'userId'
        );

        return array_map(
            fn($id) => (int) $id,
            $ids
        );
    }

    /**
     * @return UserInterface | null
     */
    public function findOneByCompanyAndName(
        int $companyId,
        string $name,
        string $lastName
    ) {
        $qb = $this->createQueryBuilder('self');

        $criteria = [
            ['company', 'eq', $companyId],
            ['name', 'eq', $name],
            ['lastname', 'eq', $lastName]
        ];

        $qb
            ->select('self')
            ->addCriteria(
                CriteriaHelper::fromArray($criteria)
            );

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param int[] $excludeIds
     * @return UserInterface[]
     */
    public function findCompanyUsersExcludingIds(
        int $companyId,
        array $excludeIds
    ): array {
        $qb = $this->createQueryBuilder('self');
        $expr = $qb->expr();

        $qb
            ->select('self')
            ->where(
                $expr->eq('self.company', $companyId)
            );

        if (!empty($excludeIds)) {
            $qb
                ->andWhere(
                    $expr->notIn('self.id', $excludeIds)
                );
        }


        return $qb->getQuery()->getResult();
    }

    /**
     * @return UserInterface | null
     */
    public function findOneByEmail(
        string $email
    ) {
        return $this->findOneBy([
            'email' => $email
        ]);
    }


    public function findOneByTerminalId(?int $terminalId): ?UserInterface
    {
        $user = $this->findOneBy([
            'terminal' => $terminalId
        ]);

        return $user;
    }

    public function findOneByExtensionId(?int $extensionId): ?UserInterface
    {
        $user = $this->findOneBy([
            'extension' => $extensionId
        ]);

        return $user;
    }

    private function getBrandUsersIdsOrderByTerminalExpireDateQuery(
        int $brandId,
        string $order,
        string $join = 'INNER'
    ): string {
        $query =
            'SELECT U.id as userId, U.companyId, T.id as terminalId, D.domain, K.domain, K.expires FROM Users U'
            . " %s JOIN Terminals T ON U.terminalId = T.id"
            . ' %s JOIN Domains D ON T.domainId = D.id'
            . ' %s JOIN kam_users_location K ON K.username = T.name AND K.domain = D.domain'
            . ' WHERE U.companyId IN (SELECT id FROM Companies WHERE brandId = %d) '
            . ' ORDER BY expires %s';

        return sprintf(
            $query,
            $join,
            $join,
            $join,
            $brandId,
            $order
        );
    }

    /**
     * @return int[]
     */
    protected function getCompanyIdsByBrandAdmin(AdministratorInterface $admin): array
    {
        $qb = $this->_em
            ->createQueryBuilder()
            ->select('self.id')
            ->from(Company::class, 'self');
        $expression = $qb->expr();

        $qb->where(
            $expression->eq('self.brand', $admin->getBrand()->getId())
        );
        $result = $qb->getQuery()->getScalarResult();

        $ids = array_column($result, 'id');

        return array_map(
            fn($id) => (int) $id,
            $ids
        );
    }

    /**
     * @param array<string, mixed> $criteria
     */
    public function count(array $criteria): int
    {
        return parent::count($criteria);
    }

    public function findLatestAddedByCompany(int $companyId): array
    {
        $qb = $this->createQueryBuilder('self');

        $result = $qb
            ->select('self, extension, outgoingDdi')
            ->leftJoin('self.outgoingDdi', 'outgoingDdi')
            ->leftJoin('self.extension', 'extension')
            ->where('self.company=:company')
            ->orderBy('self.id', 'DESC')
            ->setParameter('company', $companyId)
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
        return $result;
    }

    /**
     * @return UserInterface[]
     */
    public function findByCompanyUsingDefaultLocation(int $companyId): array
    {
        return $this->findBy([
            'company' => $companyId,
            'useDefaultLocation' => 1,
        ]);
    }
}
