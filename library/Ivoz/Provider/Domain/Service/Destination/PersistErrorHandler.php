<?php

namespace Ivoz\Provider\Domain\Service\Destination;

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
    const UNIQUE_PREFIX_CONSTRAINT_NAME = 'prefix';

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

        $isDuplicatedEmailError =
            $pdoException->getErrorCode() === self::MYSQL_ERROR_DUPLICATE_ENTRY
            && strpos($exception->getMessage(), self::UNIQUE_PREFIX_CONSTRAINT_NAME);

        if ($isDuplicatedEmailError) {
            throw new \DomainException(
                'Duplicated prefix',
                2202,
                $exception
            );
        }
    }
}
