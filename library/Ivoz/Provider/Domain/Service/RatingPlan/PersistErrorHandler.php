<?php

namespace Ivoz\Provider\Domain\Service\RatingPlan;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Ivoz\Core\Domain\Service\PersistErrorHandlerInterface;
use Doctrine\DBAL\Driver\PDOException;

class PersistErrorHandler implements PersistErrorHandlerInterface
{
    /*
     * Mysql error code list:
     * https://dev.mysql.com/doc/refman/5.5/en/error-messages-server.html
     */
    const MYSQL_ERROR_DUPLICATE_ENTRY = 1062;

    const RATING_PLAN_DUPLICATED_WEIGHT = 40002;

    public function __construct()
    {
    }

    public function handle(\Exception $exception)
    {
        if (!$exception instanceof UniqueConstraintViolationException) {
            return;
        }

        $pdoException = $exception->getPrevious();
        if (!$pdoException instanceof PDOException) {
            return;
        }


        $isDuplicatedWeightError =
            $pdoException->getErrorCode() === self::MYSQL_ERROR_DUPLICATE_ENTRY
            && strpos($exception->getMessage(), self::RATING_PLAN_DUPLICATED_WEIGHT);

        if ($isDuplicatedWeightError) {
            throw new \DomainException(
                "Selected weight is already in use",
                self::RATING_PLAN_DUPLICATED_WEIGHT,
                $exception
            );
        }
    }
}
