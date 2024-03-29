<?php

namespace Ivoz\Ast\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ivoz\Ast\Domain\Model\VoicemailMessage\VoicemailMessage;
use Ivoz\Ast\Domain\Model\VoicemailMessage\VoicemailMessageInterface;
use Ivoz\Ast\Domain\Model\VoicemailMessage\VoicemailMessageRepository;
use Ivoz\Core\Infrastructure\Domain\Service\DoctrineQueryRunner;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use Generator;

/**
 * VoicemailMessageDoctrineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VoicemailMessageDoctrineRepository extends ServiceEntityRepository implements VoicemailMessageRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private DoctrineQueryRunner $queryRunner
    ) {
        parent::__construct($registry, VoicemailMessage::class);
    }

    /**
     * This method expects results to be marked as parsed as soon as they're used:
     * a.k.a it does not apply any query offset, just a limit
     *
     * @inheritdoc
     * @see VoicemailMessageDoctrineRepository::getUnparsedMessagesGeneratorWithoutOffset
     */
    public function getUnparsedMessagesGeneratorWithoutOffset(int $batchSize, array $order = null): Generator
    {
        $qb = $this->createQueryBuilder('self');
        $qb->addCriteria(CriteriaHelper::fromArray([
            'or' => [
                ['parsed', 'eq', '0'],
                ['parsed', 'isNull'],
            ],
        ]));
        $qb->setMaxResults($batchSize);

        if ($order) {
            $qb->orderBy(...$order);
        }

        $continue =  true;
        while ($continue) {
            $query = $qb->getQuery();
            $results = $query->getResult();
            $continue = count($results) === $batchSize;

            yield $results;
        }
    }
}
