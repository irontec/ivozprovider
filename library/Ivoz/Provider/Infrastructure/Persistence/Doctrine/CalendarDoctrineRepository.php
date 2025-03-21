<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ivoz\Provider\Domain\Model\Calendar\Calendar;
use Ivoz\Provider\Domain\Model\Calendar\CalendarInterface;
use Ivoz\Provider\Domain\Model\Calendar\CalendarRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * CalendarDoctrineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 *
 * @template-extends ServiceEntityRepository<Calendar>
 */
class CalendarDoctrineRepository extends ServiceEntityRepository implements CalendarRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Calendar::class);
    }

    public function findCompanyCalendar(int $companyId, int $calendarId): ?CalendarInterface
    {
        /** @var CalendarInterface | null $response */
        $response = $this->findOneBy([
            'company' => $companyId,
            'id' => $calendarId
        ]);

        return $response;
    }
}
