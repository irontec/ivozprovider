<?php

namespace Ivoz\Provider\Domain\Service\RatingPlan;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Ivoz\Core\Domain\Service\PersistErrorHandlerInterface;
use Doctrine\DBAL\Driver\PDOException;

class PersistErrorHandler implements PersistErrorHandlerInterface
{
    const ON_ERROR_PRIORITY = self::PRIORITY_NORMAL;

    /*
     * Mysql error code list:
     * https://dev.mysql.com/doc/refman/5.5/en/error-messages-server.html
     */
    const MYSQL_ERROR_DUPLICATE_ENTRY = 1062;

    const RATING_PLAN_DUPLICATED_WEIGHT = 40002;
    const RATING_PLAN_DUPLICATED_WEIGHT_NAME = 'weight';

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_ERROR => self::ON_ERROR_PRIORITY,
        ];
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

        $errorMsgPos = stripos(
            $exception->getMessage(),
            self::RATING_PLAN_DUPLICATED_WEIGHT_NAME
        );

        $isDuplicatedWeightError =
            $pdoException->getErrorCode() === self::MYSQL_ERROR_DUPLICATE_ENTRY
            && $errorMsgPos !== false;

        if ($isDuplicatedWeightError) {
            throw new \DomainException(
                "Selected weight is already in use",
                self::RATING_PLAN_DUPLICATED_WEIGHT,
                $exception
            );
        }
    }
}
