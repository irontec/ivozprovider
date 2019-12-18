<?php

namespace Ivoz\Core\Infrastructure\Persistence\Doctrine\Service;

use Doctrine\DBAL\Driver\PDOException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Ivoz\Core\Domain\Service\CommonPersistErrorHandlerInterface;

class DuplicateEntryCommonErrorHandler implements CommonPersistErrorHandlerInterface
{
    const ON_ERROR_PRIORITY = self::PRIORITY_LOW;

    /*
     * Mysql error code list:
     * https://dev.mysql.com/doc/refman/5.5/en/error-messages-server.html
     */
    const MYSQL_ERROR_DUPLICATE_ENTRY = 1062;

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_ERROR => self::ON_ERROR_PRIORITY,
        ];
    }

    public function handle(\Throwable $exception)
    {
        if (!$exception instanceof UniqueConstraintViolationException) {
            return;
        }

        $pdoException = $exception->getPrevious();
        if (!$pdoException instanceof PDOException) {
            return;
        }

        $isDuplicatedError = $pdoException->getErrorCode() === self::MYSQL_ERROR_DUPLICATE_ENTRY;

        if ($isDuplicatedError) {
            throw new \DomainException(
                'Duplicated value found',
                0,
                $exception
            );
        }
    }
}
