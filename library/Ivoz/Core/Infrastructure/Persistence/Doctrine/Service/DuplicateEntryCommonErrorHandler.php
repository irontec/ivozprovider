<?php

namespace Ivoz\Core\Infrastructure\Persistence\Doctrine\Service;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Ivoz\Core\Domain\Service\PersistErrorHandlerInterface;
use Doctrine\DBAL\Driver\PDOException;

class DuplicateEntryCommonErrorHandler implements PersistErrorHandlerInterface
{
    /*
     * Mysql error code list:
     * https://dev.mysql.com/doc/refman/5.5/en/error-messages-server.html
     */
    const MYSQL_ERROR_DUPLICATE_ENTRY = 1062;

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
